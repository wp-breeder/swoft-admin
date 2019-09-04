<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 *
 * Class Menu
 *
 * @since 2.0
 *
 * @Entity(table="menu")
 * @OA\Schema()
 */
class Menu extends Model
{
    protected const CREATED_AT = 'create_time';

    protected const UPDATED_AT = 'update_time';
    /**
     * 菜单唯一标识
     * @Id()
     * @Column(name="menu_id", prop="menuId")
     * @OA\Property(property="menu_id")
     * @var int|null
     */
    private $menuId;

    /**
     * 父菜单ID,一级菜单为0
     *
     * @Column(name="parent_id", prop="parentId")
     * @OA\Property(property="parent_id")
     * @var int|null
     */
    private $parentId;

    /**
     * 菜单名称
     *
     * @Column(name="menu_name", prop="menuName")
     * @OA\Property(property="menu_name")
     * @var string|null
     */
    private $menuName;

    /**
     * 路径
     *
     * @Column()
     * @OA\Property(property="path")
     * @var string|null
     */
    private $path;

    /**
     * 类型 0:目录 1:菜单 2:按钮
     *
     * @Column(name="menu_type", prop="menuType")
     * @OA\Property(property="menu_type")
     * @var int|null
     */
    private $menuType;

    /**
     * 菜单图标
     *
     * @Column()
     * @OA\Property(property="icon")
     * @var string|null
     */
    private $icon;

    /**
     * 创建者ID
     *
     * @Column(name="create_uid", prop="createUid")
     * @OA\Property(property="create_uid")
     * @var int|null
     */
    private $createUid;

    /**
     * 修改者ID
     *
     * @Column(name="update_uid", prop="updateUid")
     * @OA\Property(property="update_uid")
     * @var int|null
     */
    private $updateUid;

    /**
     * 创建时间
     *
     * @Column(name="create_time", prop="createTime")
     * @OA\Property(property="create_time")
     * @var string|null
     */
    private $createTime;

    /**
     * 修改时间
     *
     * @Column(name="update_time", prop="updateTime")
     * @OA\Property(property="update_time")
     * @var string|null
     */
    private $updateTime;

    /**
     * 状态 0：禁用 1：正常
     *
     * @Column()
     * @OA\Property(property="status")
     * @var int|null
     */
    private $status;

    /**
     * 路由
     *
     * @Column()
     * @OA\Property(property="router")
     * @var string|null
     */
    private $router;

    /**
     * 别名
     *
     * @Column()
     * @OA\Property(property="alias")
     * @var string|null
     */
    private $alias;


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
     * @param int|null $parentId
     *
     * @return void
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @param string|null $menuName
     *
     * @return void
     */
    public function setMenuName(?string $menuName): void
    {
        $this->menuName = $menuName;
    }

    /**
     * @param string|null $path
     *
     * @return void
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param int|null $menuType
     *
     * @return void
     */
    public function setMenuType(?int $menuType): void
    {
        $this->menuType = $menuType;
    }

    /**
     * @param string|null $icon
     *
     * @return void
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @param int|null $createUid
     *
     * @return void
     */
    public function setCreateUid(?int $createUid): void
    {
        $this->createUid = $createUid;
    }

    /**
     * @param int|null $updateUid
     *
     * @return void
     */
    public function setUpdateUid(?int $updateUid): void
    {
        $this->updateUid = $updateUid;
    }

    /**
     * @param string|null $createTime
     *
     * @return void
     */
    public function setCreateTime(?string $createTime): void
    {
        $this->createTime = $createTime;
    }

    /**
     * @param string|null $updateTime
     *
     * @return void
     */
    public function setUpdateTime(?string $updateTime): void
    {
        $this->updateTime = $updateTime;
    }

    /**
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param string|null $router
     *
     * @return void
     */
    public function setRouter(?string $router): void
    {
        $this->router = $router;
    }

    /**
     * @param string|null $alias
     *
     * @return void
     */
    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return int|null
     */
    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @return string|null
     */
    public function getMenuName(): ?string
    {
        return $this->menuName;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return int|null
     */
    public function getMenuType(): ?int
    {
        return $this->menuType;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return int|null
     */
    public function getCreateUid(): ?int
    {
        return $this->createUid;
    }

    /**
     * @return int|null
     */
    public function getUpdateUid(): ?int
    {
        return $this->updateUid;
    }

    /**
     * @return string|null
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

    /**
     * @return string|null
     */
    public function getUpdateTime(): ?string
    {
        return $this->updateTime;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getRouter(): ?string
    {
        return $this->router;
    }

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

}
