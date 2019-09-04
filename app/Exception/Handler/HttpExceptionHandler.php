<?php declare(strict_types=1);

namespace App\Exception\Handler;

use const APP_DEBUG;
use function get_class;
use ReflectionException;
use function sprintf;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use Throwable;

/**
 * Class HttpExceptionHandler
 *
 * @ExceptionHandler(\Throwable::class)
 */
class HttpExceptionHandler extends AbstractHttpErrorHandler
{
    /**
     * @param Throwable $e
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $e, Response $response): Response
    {
        // Debug is false
        if (!APP_DEBUG) {
            $data = [
                'msg' => 'System error, please contact administrator'
            ];
        } else {
            $data = [
                'msg'   => sprintf('(%s) %s', get_class($e), $e->getMessage()),
                'debug' => [
                    'code'  => $e->getCode(),
                    'file'  => sprintf('At %s line %d', $e->getFile(), $e->getLine()),
                    'trace' => $e->getTraceAsString(),
                ]
            ];
        }

        $code = $e->getCode() === 0 ? 500 : $e->getCode();
        // CORS setting
        $response = $this->configResponse($response);
        // Debug is true
        return $response->withData($data)->withStatus($code);
    }

    private function configResponse(Response $response)
    {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Credentials', true)
            ->withHeader('Access-Control-Allow-Headers', 'Accept,Cache-Control,Content-Type,DNT,Keep-Alive,Origin,User-Agent, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
