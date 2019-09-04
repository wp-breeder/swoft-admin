<?php declare(strict_types=1);


namespace App\Helper;

use App\Bean\AuthSession;
use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Http\Message\Request;
use function Bean;

/**
 * 操作token的一些帮助方法
 * Class tokenHelper
 */
class TokenHelper
{

    /**
     * 获取http头的token
     * @param Request $request
     * @return string
     */
    public static function getToken(Request $request)
    {
        $token = $request->getHeader('Authorization');
        $token = explode(' ', $token[0])[1];

        return $token;
    }

    /**
     * @param Request $request
     * @return int
     * @throws ContainerException
     * @throws ReflectionException
     */
    public static function getUid(Request $request)
    {
        $token       = self::getToken($request);
        $tokenParser = Bean(TokenParserHelper::class);
        /** @var AuthSession $session */
        $session = $tokenParser->getSession($token);

        return (int)$session->getIdentity();
    }
}