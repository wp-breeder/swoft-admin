<?php declare(strict_types=1);


namespace App\Bean;

use ReflectionException as ReflectionExceptionAlias;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Concern\PrototypeTrait;
use Swoft\Bean\Exception\ContainerException as ContainerExceptionAlias;

/**
 * Class AuthSession
 * @package App\Bean
 * @Bean(scope=Bean::PROTOTYPE)
 */
class AuthSession
{
    use PrototypeTrait;

    /**
     * @var string User personal information credentials
     */
    protected $identity = '';
    /**
     * @var string Login method name
     */
    protected $accountTypeName = '';
    /**
     * @var string Authentication credentials
     */
    protected $token = '';
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
     * Create a new AuthSession.
     * @param array $items
     * @return AuthSession
     * @throws ReflectionExceptionAlias
     * @throws ContainerExceptionAlias
     */
    public static function new(array $items = []): self
    {
        $self        = self::__instance();
        return $self;
    }
    
    public function getIdentity(): string
    {
        return $this->identity;
    }
    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;
        return $this;
    }
    public function getAccountTypeName(): string
    {
        return $this->accountTypeName;
    }
    public function setAccountTypeName(string $accountTypeName): self
    {
        $this->accountTypeName = $accountTypeName;
        return $this;
    }
    public function getToken(): string
    {
        return $this->token;
    }
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }
    public function getCreateTime(): int
    {
        return $this->createTime;
    }
    public function setCreateTime(int $createTime): self
    {
        $this->createTime = $createTime;
        return $this;
    }
    public function getExpirationTime(): int
    {
        return $this->expirationTime;
    }
    public function setExpirationTime(int $expirationTime): self
    {
        $this->expirationTime = $expirationTime;
        return $this;
    }
    public function getExtendedData(): array
    {
        return (array)$this->extendedData;
    }
    public function setExtendedData(array $extendedData): self
    {
        $this->extendedData = $extendedData;
        return $this;
    }
}