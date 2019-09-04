<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\RoleMenu;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Exception\DbException;
use Swoft\Stdlib\Collection;

/**
 * Class RoleMenuDao
 * @Bean()
 */
class RoleMenuDao
{
    /**
     * @param array $menuRoleMapping
     * @return bool
     */
    public function createRoleMenuMapping(array $menuRoleMapping)
    {
        return RoleMenu::insert($menuRoleMapping);
    }

    /**
     * 根据规则ID删除规则菜单映射关系
     * @param int $roleId
     * @return int|mixed
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function delRoleMenuMappingByRoleId(int $roleId)
    {
        return RoleMenu::where('role_id', $roleId)->delete();
    }

    /**
     * 根据菜单ID删除规则菜单映射关系
     * @param int $menuId
     * @return int|mixed
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function delRoleMenuMappingByMenuId(int $menuId)
    {
        return RoleMenu::where('menu_id', $menuId)->delete();
    }

    /**
     * 根据规则ID获取按钮信息
     * @param array $roleIds
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function getButtons(array $roleIds)
    {
        $prefix = config('db.prefix', 'sys_');
        $ret    = DB::table('role_menu')
            ->join('menu', 'role_menu.menu_id', '=', 'menu.menu_id')
            ->whereIn('role_id', $roleIds)
            ->where('status', 1)
            ->whereRaw('menu_type != 1')
            ->selectRaw("distinct({$prefix}menu.menu_id), alias")
            ->pluck('alias');

        return $ret;
    }


    /**
     * 根据规则ID获取菜单列表
     * @param array $roleIds
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function getMenus(array $roleIds)
    {
        $prefix = config('db.prefix', 'sys_');
        $ret = DB::table('role_menu')
            ->join('menu', 'role_menu.menu_id', '=', 'menu.menu_id')
            ->whereIn('role_id', $roleIds)
            ->where('status', 1)
            ->selectRaw("distinct({$prefix}menu.menu_id), alias, parent_id, menu_name, path, router, menu_type, icon, alias")
            ->get();

        return $ret;
    }

}