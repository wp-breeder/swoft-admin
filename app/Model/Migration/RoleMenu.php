<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class RoleMenu
 *
 * @since 2.0
 *
 * @Migration(time=20190709110525)
 */
class RoleMenu extends BaseMigration
{
    /**
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function up(): void
    {
        $this->schema->createIfNotExists('role_menu', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->integer('role_id')->comment('角色ID');
            $blueprint->integer('menu_id')->comment('菜单ID');
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
        $this->schema->dropIfExists('role_menu');
    }
}
