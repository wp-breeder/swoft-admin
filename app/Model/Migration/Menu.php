<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class Menu
 *
 * @since 2.0
 *
 * @Migration(time=20190709110557)
 */
class Menu extends BaseMigration
{
    /**
     * @return void
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function up(): void
    {
        $this->schema->createIfNotExists('menu', function (Blueprint $blueprint) {
            $blueprint->increments('menu_id')->comment('菜单唯一标识');
            $blueprint->integer('parent_id')->default(0)->comment('父菜单ID,一级菜单为0');
            $blueprint->string('menu_name', 32)->comment('菜单名称');
            $blueprint->string('path', 64)->comment('路径');
            $blueprint->smallInteger('menu_type')->comment('类型 0:目录 1:菜单 2:按钮');
            $blueprint->string('icon', 32)->comment('菜单图标');
            $blueprint->integer('create_uid')->comment('创建者ID');
            $blueprint->integer('update_uid')->comment('修改者ID');
            $blueprint->timestamp('create_time')->comment('创建时间');
            $blueprint->timestamp('update_time')->comment('修改时间');
            $blueprint->smallInteger('status')->comment('状态 0:禁用 1:正常');
            $blueprint->string('router', 64)->nullable()->comment('路由');
            $blueprint->string('alias', 64)->nullable()->comment('别名');
        });

    }

    /**
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function down(): void
    {
        $this->schema->dropIfExists('menu');
    }
}
