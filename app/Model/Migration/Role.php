<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class Role
 *
 * @since 2.0
 *
 * @Migration(time=20190709105655)
 */
class Role extends BaseMigration
{
    /**
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function up(): void
    {
        $this->schema->createIfNotExists('role', function (Blueprint $blueprint) {
            $blueprint->increments('role_id')->comment('角色唯一标识');
            $blueprint->string('role_name', 64)->comment('角色');
            $blueprint->integer('create_uid')->comment('创建者ID');
            $blueprint->integer('update_uid')->comment('修改者ID');
            $blueprint->timestamp('create_time')->comment('创建时间');
            $blueprint->timestamp('update_time')->comment('修改时间');
            $blueprint->string('remark', 128)->comment('备注');
        });

    }

    /**
     * @return void
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function down(): void
    {
        $this->schema->dropIfExists('role');
    }
}
