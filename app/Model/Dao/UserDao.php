<?php declare(strict_types=1);


namespace App\Model\Dao;

use App\Model\Entity\User;
use ReflectionException as ReflectionExceptionAlias;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\DB;
use Swoft\Db\Eloquent\Builder;
use Swoft\Db\Eloquent\Collection;
use Swoft\Db\Eloquent\Model;
use Swoft\Db\Exception\DbException;
use Swoft\Stdlib\Collection as StdlibCollection;

/**
 * 用户数据接口
 * Class UserDao
 * @package App\Model\Dao
 * @Bean()
 */
class UserDao
{
    /**
     * 获取所有用户信息
     * @return Collection
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getUsers()
    {
        $users = User::all();

        return $users;
    }

    /**
     * 获取指定用户信息
     * @param int $uid
     * @return User|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getUser(int $uid): ?StdlibCollection
    {
        return User::join('user_role', 'user.uid', '=', 'user_role.uid')
            ->where('user.uid', '=', $uid)
            ->get([
                'user_role.uid',
                'nickname',
                'email',
                'phone',
                'status',
                'create_uid',
                'create_time',
                'update_time',
                'login_name',
                'ip',
                'role_id'
            ]);
    }

    /**
     * 获取根据用户名获取用户信息
     * @param string $identity
     * @return object|Builder|Model|null
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function getUserByIdentify(string $identity)
    {
        $user = User::where('login_name', $identity)
            ->orWhere('phone', $identity)
            ->orWhere('email', $identity)
            ->first();

        return $user;
    }

    /**
     * 创建用户
     * @param array $userInfo
     * @return string
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function createUser(array $userInfo): string
    {
        return DB::table('user')->insertGetId($userInfo);
    }

    /**
     * 更新用户信息
     * @param int $uid
     * @param array $userInfo
     * @return int
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionExceptionAlias
     */
    public function updateUser(int $uid, array $userInfo)
    {
        $ret = User::where('uid', $uid)->update($userInfo);
        return $ret;
    }
}