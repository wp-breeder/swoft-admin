<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 系统用户表
 * Class User
 *
 * @since 2.0
 *
 * @Entity(table="user")
 * @OA\Schema()
 */
class User extends Model
{

    protected const CREATED_AT = 'create_time';

    protected const UPDATED_AT = 'update_time';

    /**
     * 用户唯一标识
     * @Id()
     * @Column()
     * @var int|null
     * @OA\Property(property="uid")
     */
    private $uid;

    /**
     * 用户名
     *
     * @Column()
     * @var string|null
     * @OA\Property(property="nickname")
     */
    private $nickname;

    /**
     * 邮箱
     *
     * @Column()
     * @var string|null
     * @OA\Property(property="email")
     */
    private $email;

    /**
     * 手机
     *
     * @Column()
     * @var string|null
     * @OA\Property(property="phone")
     */
    private $phone;

    /**
     * 状态 0：禁用 1：正常
     *
     * @Column()
     * @var int|null
     * @OA\Property(property="status")
     */
    private $status;

    /**
     * 创建者ID
     *
     * @Column(name="create_uid", prop="createUid")
     * @var int|null
     * @OA\Property(property="create_uid")
     */
    private $createUid;

    /**
     * 创建时间
     *
     * @Column(name="create_time", prop="createTime")
     * @var string|null
     * @OA\Property(property="create_time")
     */
    private $createTime;

    /**
     * 修改时间
     *
     * @Column(name="update_time", prop="updateTime")
     * @var string|null
     * @OA\Property(property="update_time")
     */
    private $updateTime;

    /**
     * 登录名
     *
     * @Column(name="login_name", prop="loginName")
     * @var string|null
     * @OA\Property(property="login_name")
     */
    private $loginName;

    /**
     * 密码
     *
     * @Column(hidden=true)
     * @var string|null
     * @OA\Property(property="password")
     */
    private $password;

    /**
     * IP地址
     *
     * @Column()
     * @var string|null
     * @OA\Property(property="ip")
     */
    private $ip;


    /**
     * @param int|null $uid
     * @return self
     */
    public function setUid(?int $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @param string|null $nickname
     * @return self
     */
    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @param string|null $email
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string|null $phone
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param int|null $status
     * @return self
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int|null $createUid
     * @return self
     */
    public function setCreateUid(?int $createUid): self
    {
        $this->createUid = $createUid;

        return $this;
    }

    /**
     * @param string|null $createTime
     * @return self
     */
    public function setCreateTime(?string $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @param string|null $updateTime
     * @return self
     */
    public function setUpdateTime(?string $updateTime): self
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @param string|null $loginName
     * @return self
     */
    public function setLoginName(?string $loginName): self
    {
        $this->loginName = $loginName;

        return $this;
    }

    /**
     * @param string|null $password
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string|null $ip
     * @return self
     */
    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUid(): ?int
    {
        return $this->uid;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getCreateUid(): ?int
    {
        return $this->createUid;
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
    public function getLoginName(): ?string
    {
        return $this->loginName;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

}
