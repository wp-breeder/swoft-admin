<?php declare(strict_types=1);


namespace App\Http\Middleware;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Http\Message\Response;

/**
 * Class ApiMiddleware
 * @package App\Http\Middleware
 * @Bean()
 */
class ApiMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var Response $response */
        $response = $handler->handle($request);

        $data = $response->getData();
        if (isset($data['code'])) {
            $data     = $this->format($data);
            $response = $response->withStatus($data['code']);
            unset($data['code']);
            $response = $response->withData($data);
        } else {
            $response = $response->withStatus(200);
        }
        return $response;
    }

    public function format(array $attrs)
    {
        $result = [];
        foreach ($attrs as $key => $item) {
            if (is_array($item) || is_object($item)) {
                $result[$this->camelToUnderline($key)] = $this->format((array)$item);
            } else {
                $result[$this->camelToUnderline($key)] = $item;
            }
        }
        return $result;

    }

    private function camelToUnderline($camelCaps, string $separator = '_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
}