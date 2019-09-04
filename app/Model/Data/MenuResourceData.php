<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Model\Dao\MenuResourceDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class MenuResourceData
 * @Bean()
 */
class MenuResourceData
{
    /**
     * @Inject()
     * @var MenuResourceDao
     */
    private $menuResourceDao;

    public function delMenuResourceByMenuId(int $menuId)
    {
        return $this->menuResourceDao->delMenuResourceByMenuId($menuId);
    }

    public function createMenuResourceMapping(array $menuResourceMapping)
    {
        return $this->menuResourceDao->createMenuResourceMapping($menuResourceMapping);
    }
}