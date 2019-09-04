<?php declare(strict_types=1);


namespace App\Bean;

use App\Contract\AccountTypeInterface;
use App\Exception\AuthException;
use App\Helper\TokenParserHelper;
use Exception;
use Firebase\JWT\ExpiredException;
use InvalidArgumentException;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Context\Context;
use Swoft\Redis\Pool;
use function json_encode;

/**
 * Class AuthSession
 * @package App\Bean
 * @Bean()
 */
class AuthManger
{
    /**
     * @var string User personal information credentials
     */
    protected $identity = '';

    /**
     * @var int Creation time
     */
    protected $createTime = 0;
    /**
     * @var int
     */
    protected $expirationTime = 0;
    /**
     * @var array Expand data, define it yourself
     */
    protected $extendedData = [];
    /**
     * @var string
     */
    protected $prefix = 'swoft.token.';
    /**
     * @var int
     */
    protected $sessionDuration = 86400;
    /**
     * @var TokenParserHelper
     */
    private $tokenParser;
    /**
     * @var bool 开启缓存
     */
    protected $cacheEnable = true;

    private $cache;


    public function getSessionDuration(): int
    {
        return $this->sessionDuration;
    }

    public function setSessionDuration($time)
    {
        $this->sessionDuration = $time;
    }

    /**
     * @return AuthSession|mixed
     */
    public function getSession()
    {
        return Context::mustGet()->getResponse()->getHeaderLine('Authorization');
    }

    public function setSession(AuthSession $session)
    {
        return Context::mustGet()->getResponse()->withAttribute('Authorization', $session);
    }

    public function genSession(string $accountTypeName, string $identity, array $data = []): AuthSession
    {
        $startTime = time();
        $exp       = $startTime + (int)$this->sessionDuration;
        $session   = AuthSession::new();
        $session->setExtendedData($data)
            ->setExpirationTime($exp)
            ->setCreateTime($startTime)
            ->setIdentity($identity)
            ->setAccountTypeName($accountTypeName);
        $token = $this->getTokenParser()->getToken($session);
        $session->setToken($token);
        return $session;
    }

    public function getTokenParser()
    {
        $tokenParser       = \Bean(TokenParserHelper::class);
        $this->tokenParser = $tokenParser;
        return $this->tokenParser;
    }

    public function getCacheClient()
    {
        $cache = \Bean(Pool::class);
        if (!$cache instanceof Pool) {
            throw new AuthException('CacheClient need implements Swoft\Redis\Redis');
        }
        $this->cache = $cache;
        return $this->cache;
    }

    /**
     * @param string $identity
     * @param array $extendedData
     * @return string
     */
    protected function getCacheKey(string $identity, array $extendedData): string
    {
        if (empty($extendedData)) {
            return $this->prefix . $identity;
        }
        $str = json_encode($extendedData);
        return $this->prefix . $identity . '.' . md5($str);
    }

    /**
     * @param string $name
     * @return mixed|object|string|null
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function getAccountType(string $name)
    {
        $account = \Bean($name);
        if (!$account instanceof AccountTypeInterface) {
            return null;
        }
        return $account;
    }

    public function login(string $accountTypeName, array $data): AuthSession
    {
        if (!$account = $this->getAccountType($accountTypeName)) {
            throw new AuthException('Authentication: Invalid Account Type', 400);
        }
        $result = $account->login($data);
        if (!$result instanceof AuthResult || $result->getIdentity() === '') {
            throw new AuthException('Authentication: Invalid Account or credential', 400);
        }

        $session = $this->setCache($accountTypeName, $result);

        return $session;
    }

    /**
     * 设置redis缓存
     * @param string $accountTypeName
     * @param AuthResult $result
     * @return AuthSession
     * @throws AuthException
     */
    public function setCache(string $accountTypeName, AuthResult $result)
    {
        $session = $this->genSession($accountTypeName, $result->getIdentity(), $result->getExtendedData());
        $this->setSession($session);
        if ($this->cacheEnable === true) {
            try {
                $this->getCacheClient()
                    ->set($this->getCacheKey($session->getIdentity(), $session->getExtendedData()), $session->getToken(), $this->getSessionDuration());
            } catch (InvalidArgumentException $e) {
                $err = sprintf('%s Invalid Argument : %s', $session->getIdentity(), $e->getMessage());
                throw new AuthException('Postdata: Not provided', $err);
            }
        }
        return $session;
    }

    public function delCache(string $token): bool
    {
        try {
            /** @var AuthSession $session */
            $session = $this->getTokenParser()->getSession($token);
        } catch (ExpiredException $e) {
            throw new AuthException('Authentication: Session Expired', 403);
        } catch (Exception $e) {
            throw new AuthException('Authentication: Login Failed', 401);
        }
        if ($this->cacheEnable === true) {
            try {
                $this->getCacheClient()
                    ->del($this->getCacheKey($session->getIdentity(), $session->getExtendedData()));
            } catch (InvalidArgumentException $e) {
                $err = sprintf('Identity : %s ,err : %s', $session->getIdentity(), $e->getMessage());
                throw new AuthException('Postdata: Not provided', $err);
            }
        }

        return true;
    }

    public function delCacheById(string $identity, array $extData = []): bool
    {
        try {
            $this->getCacheClient()
                ->del($this->getCacheKey($identity, $extData));
        } catch (InvalidArgumentException $e) {
            throw new AuthException('Postdata: Not provided', $e);
        }

        return true;
    }

    public function authenticateToken(string $token): bool
    {
        try {
            /** @var AuthSession $session */
            $session = $this->getTokenParser()->getSession($token);
        } catch (ExpiredException $e) {
            throw new AuthException('Authentication: Session Expired', 403);
        } catch (Exception $e) {
            throw new AuthException('Authentication: Login Failed', 401);
        }
        if (!$session) {
            return false;
        }
        if ($session->getExpirationTime() < time()) {
            throw new AuthException('Authentication: Session Expired', 403);
        }
        if (!$account = $this->getAccountType($session->getAccountTypeName())) {
            throw new AuthException('Authentication: Session Invalid', 401);
        }
        if (!$account->authenticate($session->getIdentity())) {
            throw new AuthException('Authentication: Login Failed', 401);
        }
        if ($this->cacheEnable === true) {
            try {
                $cache = $this->getCacheClient()
                    ->get($this->getCacheKey($session->getIdentity(), $session->getExtendedData()));
                if (!$cache || $cache !== $token) {
                    throw new AuthException('Authentication: Login Failed', 401);
                }
            } catch (InvalidArgumentException $e) {
                $err = sprintf('Identity : %s ,err : %s', $session->getIdentity(), $e->getMessage());
                throw new Exception('Postdata: Not provided', $err);
            }
        }
        $this->setSession($session);
        return true;
    }
}