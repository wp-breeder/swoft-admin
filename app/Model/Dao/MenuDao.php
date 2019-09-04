<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\Menu;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Exception\DbException;

/**
 * Class MeanDao
 * @Bean()
 */
class MenuDao
{
    /**
     * 获取所有菜单信息
     * @return Collection
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function getMeans()
    {
        return Menu::leftJoin('menu_resource', 'menu.menu_id', '=', 'menu_resource.menu_id')
            ->get([
                'menu.menu_id',
                'parent_id',
                'menu_name',
                'path',
                'menu_type',
                'icon',
                'create_uid',
                'update_uid',
                'create_time',
                'update_time',
                'status',
                'router',
                'alias',
                'resource_id'
            ]);
    }

    /**
     * 获取指定菜单信息
     * @param int $menuId
     * @return Menu
     */
    public function getMenu(int $menuId)
    {
        return Menu::find($menuId);
    }

    /**
     * 创建菜单
     * @param array $menuInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function createMenu(array $menuInfo)
    {
        return DB::table('menu')->insertGetId($menuInfo);
    }

    /**
     * 设置菜单状态信息
     * @param int $menuId
     * @param array $menuInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function updateMenu(int $menuId, array $menuInfo)
    {
        return Menu::where('menu_id', $menuId)->update($menuInfo);
    }

    /**
     * 删除指定菜单
     * @param int $menuId
     * @return int|mixed
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function delMenu(int $menuId)
    {
        return Menu::where('menu_id', $menuId)->delete();
    }

    /**
     * 获取所有菜单列表
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function getMenuList()
    {
        return Menu::whereIn('menu_type', [0, 1])->get(['menu_id', 'menu_name']);
    }
}