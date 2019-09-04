<?php declare(strict_types=1);


namespace App\Model\Validator;

use Swoft\Validator\Annotation\Mapping\Email;
use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\Mobile;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * 用户表验证器
 * Class UserValidator
 * @Validator(name="UserValidator")
 */
class UserValidator
{
    /**
     * 用户名
     * @IsString()
     * @var string|null
     */
    protected $nickname;

    /**
     * 邮箱
     * @Email()
     * @IsString()
     * @var string|null
     */
    protected $email;

    /**
     * 手机
     * @Mobile()
     * @IsString()
     * @var string|null
     */
    protected $phone;

    /**
     * 状态 0：禁用 1：正常
     *
     * @IsInt()
     * @Enum(values={0,1})
     * @var int|null
     */
    protected $status = 1;

    /**
     * 登录名
     * @IsString(name="identity")
     * @var string|null
     */
    protected $loginName;

    /**
     * 密码
     * @Length(min=8, max=20, message="password length must be 8-20")
     * @IsString(name="credential")
     * @var string|null
     */
    protected $password;

}