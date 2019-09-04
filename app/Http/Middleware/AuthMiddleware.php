<?php declare(strict_types=1);


namespace App\Http\Middleware;

use App\Bean\AuthManger;
use App\Exception\AuthException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use function explode;

/**
 * Class AuthMiddleware
 * @Bean()
 */
class AuthMiddleware implements MiddlewareInterface
{

    /**
     * @Inject()
     * @var AuthManger
     */
    protected $auth;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: 拦截没有权限的访问
        $authority = $request->getHeader('Authorization');
        if (empty($authority)) {
            throw new AuthException('Authentication: Login Failed', 401);
        }
        $authority = explode(' ', $authority[0]);
        if (($authority[0] !== 'Bearer') || !$this->auth->authenticateToken($authority[1])) {
            throw new AuthException('Authentication: Session Invalid', 401);
        }
        return $handler->handle($request);
    }

}