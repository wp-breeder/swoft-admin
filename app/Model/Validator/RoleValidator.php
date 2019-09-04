<?php declare(strict_types=1);


namespace App\Model\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * 角色验证器
 * Class RoleValidator
 * @Validator(name="RoleValidator")
 */
class RoleValidator
{
    /**
     * 角色唯一标识
     * @IsInt(name="role_id")
     * @var int|null
     */
    protected $roleId;

    /**
     * 角色名称
     * @IsString(name="role_name")
     * @Length(min=2, max=20, message="role name length must be 2-20")
     * @var string|null
     */
    protected $roleName = "defaultName";


    /**
     * 备注
     * @IsString()
     * @var string|null
     */
    protected $remark = "defaultName";
}