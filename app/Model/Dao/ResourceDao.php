<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\Resource;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Exception\DbException;
use function config;

/**
 * 资源数据接口
 * Class ResourceDao
 * @Bean()
 */
class ResourceDao
{
    /**
     * 获取所有资源信息
     */
    public function getResources()
    {
        return Resource::all();
    }

    /**
     * 创建资源
     * @param array $resource
     * @return bool
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function createResource(array $resource)
    {
        return DB::table('resource')->insert($resource);
    }

    public function clearResource()
    {
        $prefix = config('db.prefix', 'sys_');
        return DB::statement("TRUNCATE `{$prefix}resource`");
    }
}