<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class UserRole
 *
 * @since 2.0
 *
 * @Entity(table="user_role")
 */
class UserRole extends Model
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
     * 用户ID
     *
     * @Column()
     *
     * @var int|null
     */
    private $uid;

    /**
     * 角色ID
     *
     * @Column(name="role_id", prop="roleId")
     *
     * @var int|null
     */
    private $roleId;


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
     * @param int|null $uid
     *
     * @return void
     */
    public function setUid(?int $uid): void
    {
        $this->uid = $uid;
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getUid(): ?int
    {
        return $this->uid;
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

}
