<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class User
 *
 * @since 2.0
 *
 * @Migration(time=20190709102419)
 */
class User extends BaseMigration
{
    /**
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function up(): void
    {
        $this->schema->createIfNotExists('user', function (Blueprint $blueprint) {
            $blueprint->increments('uid')->comment('用户唯一标识');
            $blueprint->string('nickname', 50)->comment('用户名');
            $blueprint->string('email', 100)->comment('邮箱');
            $blueprint->string('phone', 11)->comment('手机');
            $blueprint->smallInteger('status')->comment('状态 0：禁用 1：正常');
            $blueprint->integer('create_uid')->comment('创建者ID');
            $blueprint->timestamp('create_time')->comment('创建时间');
            $blueprint->timestamp('update_time')->comment('修改时间');
            $blueprint->string('login_name', 16)->comment('登录名');
            $blueprint->string('password', 64)->comment('密码');
            $blueprint->ipAddress('ip')->comment('IP地址');
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
        $this->schema->dropIfExists('user');
    }
}
