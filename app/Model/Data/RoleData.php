<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\RoleDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class RoleData
 * @Bean()
 */
class RoleData
{
    /**
     * @Inject()
     * @var RoleDao
     */
    private $roleDao;

    public function getRoles()
    {
        $roles = $this->roleDao->getRoles();

        return empty($roles) ? [] : $roles->toArray();

    }

    public function getRole(int $roleId)
    {
        $role = $this->roleDao->getRole($roleId);

        return empty($role) ? [] : $role->toArray();
    }

    public function createRole(array $roleInfo)
    {
        return $this->roleDao->createRole($roleInfo);
    }

    public function updateRole(int $roleId, array $roleInfo)
    {
        return $this->roleDao->updateRole($roleId, $roleInfo);
    }

    public function delRole(int $roleId)
    {
        return $this->roleDao->delRole($roleId);
    }
}