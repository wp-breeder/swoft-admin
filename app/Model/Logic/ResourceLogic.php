<?php declare(strict_types=1);


namespace App\Model\Logic;

use App\Model\Data\ResourceData;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Router\Router;
use function date;
use function time;


/**
 * Class ResourceLogic
 * @Bean()
 */
class ResourceLogic
{
    /**
     * @Inject()
     * @var ResourceData
     */
    private $resourceData;

    /**
     * 刷新资源信息
     */
    public function refresh()
    {
        $resource = $this->genResource();
        $this->resourceData->clearResource();
        $ret = $this->resourceData->createResources($resource);

        return $ret;
    }

    /**
     * 生成资源信息
     */
    public function genResource(): array
    {
        /** @var Router $router */
        $router = \Bean('httpRouter');

        $routers = $router->getRoutes();

        $resource = [];
        foreach ($routers as $router) {
            if (!empty($router['binds'])) {
                $resource[] = [
                    'resource_id'   => md5($router['method'] . ':' . $router['path']),
                    'mapping'       => $router['path'],
                    'method'        => $router['method'],
                    'auth_type'     => (int)$router['binds'][0],
                    'resource_name' => $router['binds'][1],
                    'update_time'   => date('Y-m-d H:i:s', time()),
                    'perm'          => $router['method'] . ':' . $router['path'],
                ];
            }
        }

        return $resource;
    }
}