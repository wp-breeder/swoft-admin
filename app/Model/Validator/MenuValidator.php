<?php declare(strict_types=1);


namespace App\Model\Validator;


use Doctrine\Common\Annotations\Annotation\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Length;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * Class MenuValidator
 * @Validator(name="MenuValidator")
 */
class MenuValidator
{

    /**
     * 父菜单ID,一级菜单为0
     *
     * @IsInt(name="parent_id")
     * @var int|null
     */
    protected $parentId;

    /**
     * 菜单名称
     *
     * @IsString(name="menu_name")
     * @Length(min=2, max=20, message="menu_name length must be 2-20")
     * @var string|null
     */
    protected $menuName;

    /**
     * 路径
     *
     * @IsString()
     * @var string|null
     */
    protected $path = 'default';

    /**
     * 类型 0:目录 1:菜单 2:按钮
     *
     * @IsInt(name="menu_type")
     * @Enum(value={0,1,2})
     * @var int|null
     */
    protected $menuType;

    /**
     * 菜单图标
     *
     * @IsString()
     * @Length(min=2, max=60, message="menu_name length must be 2-60")
     * @var string|null
     */
    protected $icon;

    /**
     * 状态 0：禁用 1：正常
     *
     * @IsInt()
     * @Enum(value={0,1})
     * @var int|null
     */
    protected $status;

    /**
     * 路由
     * @IsString()
     * @var string|null
     */
    protected $router = 'default';

    /**
     * 别名
     * @IsString()
     * @var string|null
     */
    protected $alias = 'default';
}