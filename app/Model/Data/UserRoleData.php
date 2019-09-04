<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\UserRoleDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class UserRoleData
 * @Bean()
 */
class UserRoleData
{
    /**
     * @Inject()
     * @var UserRoleDao
     */
    private $userRoleDao;

    public function delUserRoleMappingById(int $uid)
    {
        return $this->userRoleDao->delUserRoleMappingById($uid);
    }

    public function createUserRoleMapping(array $createUserRoleMapping)
    {
        return $this->userRoleDao->createUserRoleMapping($createUserRoleMapping);
    }

    public function getRoleById(int $uid)
    {
        return $this->userRoleDao->getRoleById($uid)->toArray();
    }

    public function delUserRoleMappingByRoleId(int $roleId)
    {
        return $this->userRoleDao->delUserRoleMappingById($roleId);
    }
}