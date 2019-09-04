<?php declare(strict_types=1);


namespace App\Model\Logic;

use App\Model\Data\MenuData;
use App\Model\Data\MenuResourceData;
use App\Model\Data\RoleMenuData;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use function array_values;
use function explode;

/**
 * Class MenuLogic
 * @Bean()
 */
class MenuLogic
{
    /**
     * @Inject()
     * @var MenuResourceData
     */
    private $menuResourceData;

    /**
     * @Inject()
     * @var MenuData
     */
    private $menuData;

    /**
     * @Inject()
     * @var RoleMenuData
     */
    private $roleMenuData;

    public function updateMenu(int $menuId, array $menuInfo)
    {
        if (isset($menuInfo['resource_ids']) && $menuInfo['resource_ids']) {
            // 删除原有菜单资源映射关系
            $this->menuResourceData->delMenuResourceByMenuId($menuId);
            $menuResourceMapping = $this->createMenuResourceMapping($menuId, $menuInfo['resource_ids']);
            $this->menuResourceData->createMenuResourceMapping($menuResourceMapping);
        }

        $ret = $this->menuData->updateMenu($menuId, $menuInfo);

        return $ret;

    }

    public function createMenu(array $menuInfo)
    {
        $resourceIds = '';
        if (isset($menuInfo['resource_ids'])) {
            if ($menuInfo['resource_ids']) {
                $resourceIds = $menuInfo['resource_ids'];
            }
            unset($menuInfo['resource_ids']);
        }
        $menuId = $this->menuData->createMenu($menuInfo);
        if (!empty($resourceIds)) {
            $menuResourceMapping = $this->createMenuResourceMapping((int)$menuId, $resourceIds);
            $this->menuResourceData->createMenuResourceMapping($menuResourceMapping);
        }
        return $menuId;
    }

    /**
     * 创建映射关系
     * @param int $menuId
     * @param string $resourcesId
     * @return array
     */
    public function createMenuResourceMapping(int $menuId, string $resourcesId)
    {
        $resourceIds         = explode(',', $resourcesId);
        $menuResourceMapping = [];
        foreach ($resourceIds as $resourceId) {
            $menuResourceMapping[] = [
                'menu_id'     => $menuId,
                'resource_id' => $resourceId,
            ];
        }

        return $menuResourceMapping;
    }

    public function getMenus()
    {
        $menus             = $this->menuData->getMenus();
        $resourcesAndMenus = [];
        foreach ($menus as $menu) {
            if (!isset($resourcesAndMenus[$menu['menu_id']])) {
                $resourcesAndMenus[$menu['menu_id']]                   = $menu;
                $resourcesAndMenus[$menu['menu_id']]['resource_ids'][] = $menu['resource_id'];
                unset($resourcesAndMenus[$menu['menu_id']]['resource_id']);
            } else {
                $resourcesAndMenus[$menu['menu_id']]['resource_ids'][] = $menu['resource_id'];
            }
        }

        return array_values($resourcesAndMenus);
    }

    /**
     * 删除指定菜单并清空映射关系
     * @param int $menuId
     * @return int|mixed
     */
    public function delMenu(int $menuId)
    {
        $this->menuResourceData->delMenuResourceByMenuId($menuId);
        $this->roleMenuData->delRoleMenuMappingByMenuId($menuId);

        return $this->menuData->delMenu($menuId);
    }
}