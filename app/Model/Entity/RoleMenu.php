<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class RoleMenu
 *
 * @since 2.0
 *
 * @Entity(table="role_menu")
 */
class RoleMenu extends Model
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
     * 角色ID
     *
     * @Column(name="role_id", prop="roleId")
     *
     * @var int|null
     */
    private $roleId;

    /**
     * 菜单ID
     *
     * @Column(name="menu_id", prop="menuId")
     *
     * @var int|null
     */
    private $menuId;


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
     * @param int|null $roleId
     *
     * @return void
     */
    public function setRoleId(?int $roleId): void
    {
        $this->roleId = $roleId;
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return int|null
     */
    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

}
