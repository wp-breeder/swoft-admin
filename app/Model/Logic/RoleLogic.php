<?php declare(strict_types=1);


namespace App\Model\Logic;


use App\Model\Data\RoleData;
use App\Model\Data\RoleMenuData;
use App\Model\Data\UserRoleData;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use function array_values;

/**
 * @Bean()
 * Class RoleLogic
 */
class RoleLogic
{
    /**
     * @Inject()
     * @var RoleMenuData
     */
    private $roleMenuData;

    /**
     * @Inject()
     * @var UserRoleData
     */
    private $userMenuData;

    /**
     * @Inject()
     * @var RoleData
     */
    private $roleData;

    public function updateRoleMenuMapping(int $roleId, string $menuIds)
    {
        $roleMenuMapping = [];
        $menuIds         = explode(',', $menuIds);
        foreach ($menuIds as $menuId) {
            $roleMenuMapping[] = [
                'role_id' => $roleId,
                'menu_id' => (int)$menuId,
            ];
        }
        $this->roleMenuData->delRoleMenuMappingByRoleId($roleId);
        return $this->roleMenuData->createRoleMenuMapping($roleMenuMapping);
    }

    public function getRoles()
    {
        $roles = $this->roleData->getRoles();

        $rolesAndMenus = [];
        foreach ($roles as $role) {
            if (!isset($rolesAndMenus[$role['role_id']])) {
                $rolesAndMenus[$role['role_id']]               = $role;
                $rolesAndMenus[$role['role_id']]['menu_ids'][] = $role['menu_id'];
                unset($rolesAndMenus[$role['role_id']]['menu_id']);
            } else {
                $rolesAndMenus[$role['role_id']]['menu_ids'][] = $role['menu_id'];
            }
        }

        return array_values($rolesAndMenus);
    }

    public function delRole(int $roleId)
    {
        $this->roleMenuData->delRoleMenuMappingByRoleId($roleId);
        $this->userMenuData->delUserRoleMappingByRoleId($roleId);

        return $this->roleData->delRole($roleId);
    }
}