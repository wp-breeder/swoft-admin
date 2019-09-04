<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Exception\ApiException;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 用户数据
 * Class UserData
 * @package App\Model\Data
 * @Bean()
 */
class UserData
{
    /**
     * @Inject()
     * @var UserDao
     */
    private $userDao;

    public function getUsers()
    {
        $users = $this->userDao->getUsers();

        return empty($users) ? [] : $users->toArray();
    }

    public function getUser(int $uid)
    {
        $user = $this->userDao->getUser($uid);
        return empty($user) ? [] : $user->toArray();
    }

    public function getUserByIdentify(string $identify)
    {
        return $this->userDao->getUserByIdentify($identify);
    }

    public function issetUserById(string $uid): bool
    {
        return (bool)$this->userDao->getUser((int)$uid);
    }

    public function createUser(array $userInfo)
    {
        $isUserInfo = $this->getUserByIdentify($userInfo['login_name']);
        if ($isUserInfo) {
            throw new ApiException('User already exist', 400);
        }
        return $this->userDao->createUser($userInfo);
    }

    public function updateUser(int $uid, array $userInfo)
    {
        return $this->userDao->updateUser($uid, $userInfo);
    }
}