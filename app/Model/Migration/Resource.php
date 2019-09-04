<?php declare(strict_types=1);


namespace App\Model\Migration;


use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Devtool\Annotation\Mapping\Migration;
use Swoft\Devtool\Migration\Migration as BaseMigration;

/**
 * Class Resource
 *
 * @since 2.0
 *
 * @Migration(time=20190709110443)
 */
class Resource extends BaseMigration
{
    /**
     * @return void
     */
    public function up(): void
    {
        $sql = <<<sql
CREATE TABLE `sys_resource`  (
  `resource_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源唯一标识',
  `resource_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源名称',
  `mapping` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路径映射',
  `method` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求方式',
  `auth_type` smallint(6) NOT NULL COMMENT '权限认证类型1:是否需要登录2:开放3:是否鉴定权限',
  `update_time` timestamp(0) NOT NULL COMMENT '修改时间',
  `perm` varchar(68) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '权限标识',
  PRIMARY KEY (`resource_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;
sql;
        $this->execute($sql);

    }

    /**
     * @return void
     * @throws ContainerException
     * @throws DbException
     * @throws ReflectionException
     */
    public function down(): void
    {
        $this->schema->dropIfExists('resource');
    }
}
