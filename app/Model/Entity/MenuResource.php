<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class MenuResource
 *
 * @since 2.0
 *
 * @Entity(table="menu_resource")
 */
class MenuResource extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int|null
     */
    private $id;

    /**
     * 菜单ID
     *
     * @Column(name="menu_id", prop="menuId")
     *
     * @var int|null
     */
    private $menuId;

    /**
     * 资源ID
     *
     * @Column(name="resource_id", prop="resourceId")
     *
     * @var string|null
     */
    private $resourceId;


    /**
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int|null $menuId
     *
     * @return void
     */
    public function setMenuId(?int $menuId): void
    {
        $this->menuId = $menuId;
    }

    /**
     * @param string|null $resourceId
     *
     * @return void
     */
    public function setResourceId(?string $resourceId): void
    {
        $this->resourceId = $resourceId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

    /**
     * @return string|null
     */
    public function getResourceId(): ?string
    {
        return $this->resourceId;
    }

}
