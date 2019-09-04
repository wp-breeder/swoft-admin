<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\ResourceDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 资源数据接口
 * Class ResourceData
 * @Bean()
 */
class ResourceData
{
    /**
     * @Inject()
     * @var ResourceDao
     */
    private $resourceDao;

    public function getResources()
    {
        return $this->resourceDao->getResources()->toArray();
    }

    public function createResources(array $resource)
    {
        return $this->resourceDao->createResource($resource);
    }

    public function clearResource()
    {
        return $this->resourceDao->clearResource();
    }
}