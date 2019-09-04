<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\Role;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Exception\DbException;

/**
 * 角色数据接口
 * Class RoleDao
 * @Bean()
 */
class RoleDao
{
    /**
     * 获取所有角色信息
     * @return Collection
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function getRoles()
    {
        return Role::join('role_menu', 'role.role_id', '=', 'role_menu.role_id')
            ->get([
                'role.role_id',
                'role_name',
                'create_uid',
                'update_uid',
                'create_time',
                'update_time',
                'remark',
                'menu_id'
            ]);
    }

    /**
     * 获取指定角色信息
     * @param int $roleId
     * @return Role
     */
    public function getRole(int $roleId)
    {
        return Role::find($roleId);
    }

    /**
     * 创建角色信息
     * @param array $roleInfo
     * @return bool
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function createRole(array $roleInfo)
    {
        return Role::new($roleInfo)->save();
    }

    /**
     * 根据角色ID根据角色信息
     * @param int $roleId
     * @param array $roleInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function updateRole(int $roleId, array $roleInfo)
    {
        return Role::where('role_id', $roleId)->update($roleInfo);
    }

    /**
     * 删除指定角色信息
     * @param int $roleId
     * @return int|mixed
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function delRole(int $roleId)
    {
        return Role::where('role_id', $roleId)->delete();
    }
}