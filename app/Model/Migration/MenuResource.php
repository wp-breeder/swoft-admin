<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Db\Schema\Blueprint;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class MenuResource
 *
 * @since 2.0
 *
 * @Migration(time=20190709110615)
 */
class MenuResource extends BaseMigration
{
    /**
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function up(): void
    {
        $this->schema->createIfNotExists('menu_resource', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->integer('menu_id')->comment('菜单ID');
            $blueprint->string('resource_id', 32)->comment('资源ID');
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
        $this->schema->dropIfExists('menu_resource');
    }
}
