<?php declare(strict_types=1);


namespace App\Model\Dao;


use App\Model\Entity\MenuResource;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;

/**
 * Class MenuResourceDao
 * @Bean()
 */
class MenuResourceDao
{

    /**
     * 根据菜单ID删除菜单资源关联关系
     * @param int $menuId
     * @return int|mixed
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function delMenuResourceByMenuId(int $menuId)
    {
        return MenuResource::where('menu_id', $menuId)->delete();
    }

    /**
     * 创建菜单资源映射关系
     * @param array $menuResourceMapping
     * @return bool
     */
    public function createMenuResourceMapping(array $menuResourceMapping)
    {
        return MenuResource::insert($menuResourceMapping);
    }
}