<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\RoleMenuDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class RoleMenuData
 * @Bean()
 */
class RoleMenuData
{
    /**
     * @Inject()
     * @var RoleMenuDao
     */
    private $roleMenuDao;

    public function createRoleMenuMapping(array $menuRoleMapping)
    {
        return $this->roleMenuDao->createRoleMenuMapping($menuRoleMapping);
    }

    public function delRoleMenuMappingByRoleId(int $roleId)
    {
        return $this->roleMenuDao->delRoleMenuMappingByRoleId($roleId);
    }

    public function delRoleMenuMappingByMenuId(int $menuId)
    {
        return $this->roleMenuDao->delRoleMenuMappingByMenuId($menuId);
    }

    public function getButtons(array $roleIds)
    {
        return $this->roleMenuDao->getButtons($roleIds)->toArray();
    }

    public function getMenus(array $roleIds)
    {
        return $this->roleMenuDao->getMenus($roleIds)->toArray();
    }
}