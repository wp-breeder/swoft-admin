<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 角色表
 * Class Role
 *
 * @since 2.0
 *
 * @Entity(table="role")
 * @OA\Schema()
 */
class Role extends Model
{
    protected const CREATED_AT = 'create_time';

    protected const UPDATED_AT = 'update_time';

    /**
     * 角色唯一标识
     * @Id()
     * @Column(name="role_id", prop="roleId")
     * @OA\Property(property="role_id")
     * @var int|null
     */
    private $roleId;

    /**
     * 角色名称
     *
     * @Column(name="role_name", prop="roleName")
     * @OA\Property(property="role_name")
     * @var string|null
     */
    private $roleName;

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
     * 备注
     *
     * @Column()
     * @OA\Property(property="remark")
     * @var string|null
     */
    private $remark;


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
     * @param string|null $roleName
     *
     * @return void
     */
    public function setRoleName(?string $roleName): void
    {
        $this->roleName = $roleName;
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
     * @param string|null $remark
     *
     * @return void
     */
    public function setRemark(?string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return string|null
     */
    public function getRoleName(): ?string
    {
        return $this->roleName;
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
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

}
