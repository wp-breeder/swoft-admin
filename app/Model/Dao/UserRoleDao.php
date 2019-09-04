<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\UserRole;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Exception\DbException;

/**
 * Class UserRoleDao
 * @Bean()
 */
class UserRoleDao
{
    /**
     * 根据用户ID删除映射关系
     * @param int $uid
     * @return int|mixed
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function delUserRoleMappingById(int $uid)
    {
        return UserRole::where('uid', $uid)->delete();
    }

    /**
     * 创建用户角色映射关系
     * @param array $userRoleMapping
     * @return bool
     */
    public function createUserRoleMapping(array $userRoleMapping)
    {
        return UserRole::insert($userRoleMapping);
    }

    /**
     * 根据用户ID获取角色ID
     * @param int $uid
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function getRoleById(int $uid)
    {
        return UserRole::where('uid', $uid)->get();
    }

    /**
     * 根据规则ID删除映射关系
     * @param int $roleId
     * @return int|mixed
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function delUserRoleMappingByRoleId(int $roleId)
    {
        return UserRole::where('role_id', $roleId)->delete();
    }
}