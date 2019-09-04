<?php declare(strict_types=1);

namespace App\Exception\Handler;


use App\Exception\ApiException;
use Swoft\Error\Annotation\Mapping\ExceptionHandler;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Exception\Handler\AbstractHttpErrorHandler;
use App\Exception\AuthException;
use Throwable;

/**
 * Class ApiExceptionHandler
 *
 * @since 2.0
 *
 * @ExceptionHandler({ApiException::class, AuthException::class})
 */
class ApiExceptionHandler extends AbstractHttpErrorHandler
{

    /**
     * @param Throwable $except
     * @param Response $response
     *
     * @return Response
     */
    public function handle(Throwable $except, Response $response): Response
    {
        if (!APP_DEBUG) {
            $data = [
                'msg' => 'System error, please contact administrator'
            ];
        } else {
            $data = [
                'msg'   =>  sprintf('(%s) %s', get_class($except), $except->getMessage()),
                'debug' => [
                    'code'  => $except->getCode(),
                    'file'  => sprintf('At %s line %d', $except->getFile(), $except->getLine()),
                    'trace' => $except->getTraceAsString(),
                ]
            ];
        }

        $code = $except->getCode() === 0 ? 500 : $except->getCode();
        // CORS setting
        $response = $this->configResponse($response);

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
