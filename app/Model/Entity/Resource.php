<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 *
 * Class Resource
 *
 * @since 2.0
 *
 * @Entity(table="resource")
 * @OA\Schema()
 */
class Resource extends Model
{

    protected $modelTimestamps = false;
    /**
     * 资源唯一标识
     *
     * @Column(name="resource_id", prop="resourceId")
     * @OA\Property(property="resource_id")
     * @var string|null
     */
    private $resourceId;

    /**
     * 资源名称
     *
     * @Column(name="resource_name", prop="resourceName")
     * @OA\Property(property="resource_name")
     * @var string|null
     */
    private $resourceName;

    /**
     * 路径映射
     *
     * @Column()
     * @OA\Property(property="mapping")
     * @var string|null
     */
    private $mapping;

    /**
     * 请求方式
     *
     * @Column()
     * @OA\Property(property="method")
     * @var string|null
     */
    private $method;

    /**
     * 权限认证类型
     * @Id()
     * @Column(name="auth_type", prop="authType")
     * @OA\Property(property="auth_type")
     * @var int|null
     */
    private $authType;

    /**
     * 修改时间
     *
     * @Column(name="update_time", prop="updateTime")
     * @OA\Property(property="update_time")
     * @var string|null
     */
    private $updateTime;

    /**
     * 权限标识
     * @OA\Property(property="perm")
     * @Column()
     *
     * @var string|null
     */
    private $perm;


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
     * @param string|null $resourceName
     *
     * @return void
     */
    public function setResourceName(?string $resourceName): void
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @param string|null $mapping
     *
     * @return void
     */
    public function setMapping(?string $mapping): void
    {
        $this->mapping = $mapping;
    }

    /**
     * @param string|null $method
     *
     * @return void
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param int|null $authType
     *
     * @return void
     */
    public function setAuthType(?int $authType): void
    {
        $this->authType = $authType;
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
     * @param string|null $perm
     *
     * @return void
     */
    public function setPerm(?string $perm): void
    {
        $this->perm = $perm;
    }

    /**
     * @return string|null
     */
    public function getResourceId(): ?string
    {
        return $this->resourceId;
    }

    /**
     * @return string|null
     */
    public function getResourceName(): ?string
    {
        return $this->resourceName;
    }

    /**
     * @return string|null
     */
    public function getMapping(): ?string
    {
        return $this->mapping;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return int|null
     */
    public function getAuthType(): ?int
    {
        return $this->authType;
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
    public function getPerm(): ?string
    {
        return $this->perm;
    }

}
