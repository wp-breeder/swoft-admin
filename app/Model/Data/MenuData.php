<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\MenuDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class MenuData
 * @Bean()
 */
class MenuData
{
    /**
     * @Inject()
     * @var MenuDao
     */
    private $menuDao;

    public function getMenus()
    {
        return $this->menuDao->getMeans()->toArray();
    }

    public function getMenu(int $menuId)
    {
        $menu = $this->menuDao->getMenu($menuId);

        return empty($menu) ? [] : $menu->toArray();
    }

    public function createMenu(array $menuInfo)
    {
        return $this->menuDao->createMenu($menuInfo);
    }

    public function updateMenu(int $menuId, array $menuInfo)
    {
        return $this->menuDao->updateMenu($menuId, $menuInfo);
    }

    public function delMenu(int $menuId)
    {
        return $this->menuDao->delMenu($menuId);
    }

    public function getMenuList()
    {
        return $this->menuDao->getMenuList()->toArray();
    }
}