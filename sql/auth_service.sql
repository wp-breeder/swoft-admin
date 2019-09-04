/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1_3306
 Source Server Type    : MySQL
 Source Server Version : 50550
 Source Host           : 127.0.0.1:3306
 Source Schema         : auth_service

 Target Server Type    : MySQL
 Target Server Version : 50550
 File Encoding         : 65001

 Date: 22/08/2019 16:08:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu`  (
  `menu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单唯一标识',
  `parent_id` int(11) NOT NULL COMMENT '父菜单ID,一级菜单为0',
  `menu_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单名称',
  `path` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路径',
  `menu_type` smallint(6) NOT NULL COMMENT '类型 0:目录 1:菜单 2:按钮',
  `icon` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单图标',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `update_uid` int(11) NOT NULL COMMENT '修改者ID',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `status` smallint(6) NOT NULL COMMENT '状态 0:禁用 1:正常',
  `router` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '路由',
  `alias` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '别名',
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES (1, 0, '系统管理', '', 0, 'settings', 1, 1, '2019-08-21 11:27:03', '2019-07-11 17:40:07', 1, NULL, '');
INSERT INTO `sys_menu` VALUES (8, 1, '用户管理', 'system/user', 1, 'account_circle', 1, 1, '2019-08-20 19:04:00', '2019-08-16 14:49:58', 1, 'system/User', 'sys:user:list');
INSERT INTO `sys_menu` VALUES (9, 1, '角色管理', 'system/role', 1, 'perm_identity', 1, 1, '2019-08-20 19:04:01', '2019-08-19 11:05:58', 1, 'system/Role', 'sys:role:list');
INSERT INTO `sys_menu` VALUES (10, 1, '菜单管理', 'system/menu', 1, 'menu', 1, 1, '2019-08-20 19:04:02', '2019-07-11 15:55:02', 1, 'system/Menu', 'sys:menu:list');
INSERT INTO `sys_menu` VALUES (12, 1, '资源管理', 'system/resource', 1, 'folder', 1, 1, '2019-08-20 19:04:05', '2019-08-19 11:05:57', 1, 'system/Resource', 'sys:resource:list');

-- ----------------------------
-- Table structure for sys_menu_resource
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu_resource`;
CREATE TABLE `sys_menu_resource`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  `resource_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for sys_migration
-- ----------------------------
DROP TABLE IF EXISTS `sys_migration`;
CREATE TABLE `sys_migration`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` bigint(20) NOT NULL,
  `is_rollback` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_migration
-- ----------------------------
INSERT INTO `sys_migration` VALUES (1, 'App\\Model\\Migration\\MenuResource', 20190709110615, 2);
INSERT INTO `sys_migration` VALUES (2, 'App\\Model\\Migration\\RoleResource', 20190709110347, 2);
INSERT INTO `sys_migration` VALUES (3, 'App\\Model\\Migration\\RoleMenu', 20190709110525, 2);
INSERT INTO `sys_migration` VALUES (4, 'App\\Model\\Migration\\User', 20190709102419, 2);
INSERT INTO `sys_migration` VALUES (5, 'App\\Model\\Migration\\Resource', 20190709110443, 2);
INSERT INTO `sys_migration` VALUES (6, 'App\\Model\\Migration\\Menu', 20190709110557, 2);
INSERT INTO `sys_migration` VALUES (7, 'App\\Model\\Migration\\UserRole', 20190709110423, 2);
INSERT INTO `sys_migration` VALUES (8, 'App\\Model\\Migration\\Role', 20190709105655, 2);

-- ----------------------------
-- Table structure for sys_resource
-- ----------------------------
DROP TABLE IF EXISTS `sys_resource`;
CREATE TABLE `sys_resource`  (
  `resource_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源唯一标识',
  `resource_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '资源名称',
  `mapping` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '路径映射',
  `method` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求方式',
  `auth_type` smallint(6) NOT NULL COMMENT '权限认证类型1:是否需要登录2:开放3:是否鉴定权限',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  `perm` varchar(68) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '权限标识',
  PRIMARY KEY (`resource_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_resource
-- ----------------------------
INSERT INTO `sys_resource` VALUES ('008c5504a999181eb0051016223c2c2a', '删除指定角色信息', '/auth-service/role/{roleId}', 'DELETE', 3, '2019-08-22 11:57:56', 'DELETE:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('1992db9b9427b66b4247c20d08e1386a', '账号登录', '/auth-service/account/token', 'POST', 2, '2019-08-22 11:57:56', 'POST:/auth-service/account/token');
INSERT INTO `sys_resource` VALUES ('1f269fdf908c638b279d346eca414640', '获取账号详细信息', '/auth-service/account/info', 'GET', 1, '2019-08-22 11:57:56', 'GET:/auth-service/account/info');
INSERT INTO `sys_resource` VALUES ('249c7aeaddaa51fd21d87052e5f576ba', '获取所有用户信息', '/auth-service/user', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/user');
INSERT INTO `sys_resource` VALUES ('251638d128962c4934b03fac6f0494ed', '获取指定用户信息', '/auth-service/user/{uid}', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/user/{uid}');
INSERT INTO `sys_resource` VALUES ('303fc27ab54280b6f00d5835c1b34823', '获取账号菜单', '/auth-service/account/menu', 'GET', 1, '2019-08-22 11:57:56', 'GET:/auth-service/account/menu');
INSERT INTO `sys_resource` VALUES ('52971390ae4c63681ff3394646b7a01c', '刷新资源', '/auth-service/resource', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/resource');
INSERT INTO `sys_resource` VALUES ('55983e4ea480ba85720f2212ee5ec886', '获取菜单列表(目录、菜单)', '/auth-service/menu/list', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/menu/list');
INSERT INTO `sys_resource` VALUES ('717f1d6acf678059d3219a42782577b4', '创建角色', '/auth-service/role', 'POST', 3, '2019-08-22 11:57:56', 'POST:/auth-service/role');
INSERT INTO `sys_resource` VALUES ('7d358fb22e3012d3cbff6ea59eb89183', '创建菜单', '/auth-service/menu', 'POST', 3, '2019-08-22 11:57:56', 'POST:/auth-service/menu');
INSERT INTO `sys_resource` VALUES ('80ea55dede4fc8de34382d58e7bbc794', '获取账号菜单', '/auth-service/account/button', 'GET', 1, '2019-08-22 11:57:56', 'GET:/auth-service/account/button');
INSERT INTO `sys_resource` VALUES ('85129053780d148bc9c6c36bea87fc69', '获取所有资源信息', '/auth-service/resource', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/resource');
INSERT INTO `sys_resource` VALUES ('85ebfb7e9c578f353577287ade9ad6c9', '重置密码', '/auth-service/user/{uid}/password', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/user/{uid}/password');
INSERT INTO `sys_resource` VALUES ('94e3ddd1668169009542ba1aaa6b6bdb', '删除指定菜单', '/auth-service/menu/{menuId}', 'DELETE', 3, '2019-08-22 11:57:56', 'DELETE:/auth-service/menu/{menuId}');
INSERT INTO `sys_resource` VALUES ('a614b5b911e4a6d5fc4df27fde27890e', '修改账号信息', '/auth-service/account/info', 'PUT', 1, '2019-08-22 11:57:56', 'PUT:/auth-service/account/info');
INSERT INTO `sys_resource` VALUES ('ab777bb4b2b3ad8b96fc5cece9576aab', '修改密码', '/auth-service/account/password', 'PUT', 1, '2019-08-22 11:57:56', 'PUT:/auth-service/account/password');
INSERT INTO `sys_resource` VALUES ('abc6a5c291cee62207204a3bd28e1d26', '获取指定菜单列表', '/auth-service/menu/{menuId}', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/menu/{menuId}');
INSERT INTO `sys_resource` VALUES ('b224f5bf274cf6e7982d51443aa7c857', '修改用户信息', '/auth-service/user/{uid}', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/user/{uid}');
INSERT INTO `sys_resource` VALUES ('b427bcd8743ba1a8730b019d3c6068be', '设置用户状态', '/auth-service/user/{uid}/status', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/user/{uid}/status');
INSERT INTO `sys_resource` VALUES ('bd2a50519bd2e2fb58c0f8e26bbbbf1f', '更新指定菜单', '/auth-service/menu/{menuId}/status', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/menu/{menuId}/status');
INSERT INTO `sys_resource` VALUES ('bd9a93c74838bcf6ddf3d6db997f1668', '刷新token', '/auth-service/account/refresh', 'GET', 1, '2019-08-22 11:57:56', 'GET:/auth-service/account/refresh');
INSERT INTO `sys_resource` VALUES ('c4e605798ab049733af8e45e6e8bf895', '获取所有角色信息', '/auth-service/role', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/role');
INSERT INTO `sys_resource` VALUES ('e54fc20e1e3ce9eb04cd3ded153d676b', '修改角色菜单', '/auth-service/role/{roleId}/menus', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/role/{roleId}/menus');
INSERT INTO `sys_resource` VALUES ('e599e9195df9cf61aaca8ed36f1e5ebc', '退出登录', '/auth-service/account/logout', 'GET', 1, '2019-08-22 11:57:56', 'GET:/auth-service/account/logout');
INSERT INTO `sys_resource` VALUES ('e9ec5f8a2c0b19cbc79b23e7101b0086', '更新角色信息', '/auth-service/role/{roleId}', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('f0355b5eb2f9d11dee544c30ce600713', '获取所有菜单列表', '/auth-service/menu', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/menu');
INSERT INTO `sys_resource` VALUES ('f705e671c6b7d38ee594017db55f1814', '创建用户', '/auth-service/user', 'POST', 3, '2019-08-22 11:57:56', 'POST:/auth-service/user');
INSERT INTO `sys_resource` VALUES ('f8bae34e99a4c460fb78e3e6e1857e26', '获取指定角色信息', '/auth-service/role/{roleId}', 'GET', 3, '2019-08-22 11:57:56', 'GET:/auth-service/role/{roleId}');
INSERT INTO `sys_resource` VALUES ('fbd18c637ace8b36d149c214fa19098e', '更新指定菜单', '/auth-service/menu/{menuId}', 'PUT', 3, '2019-08-22 11:57:56', 'PUT:/auth-service/menu/{menuId}');

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role`  (
  `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色唯一标识',
  `role_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '角色',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `update_uid` int(11) NOT NULL COMMENT '修改者ID',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `remark` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES (1, '超级管理员', 1, 1, '2019-08-12 17:04:55', '2019-08-12 17:04:55', '超级管理员');
INSERT INTO `sys_role` VALUES (2, '普通管理员', 1, 1, '2018-11-12 16:00:17', '2018-11-12 16:00:19', '普通管理员');

-- ----------------------------
-- Table structure for sys_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_role_menu`;
CREATE TABLE `sys_role_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `menu_id` int(11) NOT NULL COMMENT '菜单ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_role_menu
-- ----------------------------
INSERT INTO `sys_role_menu` VALUES (7, 2, 1);
INSERT INTO `sys_role_menu` VALUES (8, 2, 8);
INSERT INTO `sys_role_menu` VALUES (9, 2, 9);
INSERT INTO `sys_role_menu` VALUES (13, 1, 1);
INSERT INTO `sys_role_menu` VALUES (14, 1, 8);
INSERT INTO `sys_role_menu` VALUES (15, 1, 10);
INSERT INTO `sys_role_menu` VALUES (16, 1, 9);
INSERT INTO `sys_role_menu` VALUES (17, 1, 12);

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户唯一标识',
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户名',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱',
  `phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '手机',
  `status` smallint(6) NOT NULL COMMENT '状态 0：禁用 1：正常',
  `create_uid` int(11) NOT NULL COMMENT '创建者ID',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `login_name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录名',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'IP地址',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, 'test', '123456@qq.com', '138385438', 1, 1, '2019-08-02 11:58:41', '2019-08-16 10:46:41', 'test', '0711b926d862dc50b1c8502270b03fa3', '192.168.23.69');
INSERT INTO `sys_user` VALUES (2, '123', '123456@qq.com', '138385438', 1, 1, '2019-08-02 11:58:41', '2019-08-09 15:35:30', 'test', '0711b926d862dc50b1c8502270b03fa3', '192.168.23.69');
INSERT INTO `sys_user` VALUES (7, 'test', '11@qq.com', '138385438', 1, 1, '2019-08-09 17:23:34', '2019-08-15 11:48:21', 'wp', '3086e29cae227a6a19d5d2a6bc921187', '192.168.23.89');
INSERT INTO `sys_user` VALUES (8, 'test', '123@qq.com', '138385438', 1, 1, '2019-08-09 17:25:09', '2019-08-16 10:46:44', '123w', '9d402a6bbc8bcb6f2846a2c346b3daf0', '192.168.23.89');

-- ----------------------------
-- Table structure for sys_user_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_role`;
CREATE TABLE `sys_user_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sys_user_role
-- ----------------------------
INSERT INTO `sys_user_role` VALUES (3, 2, 2);
INSERT INTO `sys_user_role` VALUES (10, 7, 2);
INSERT INTO `sys_user_role` VALUES (11, 8, 1);
INSERT INTO `sys_user_role` VALUES (15, 1, 1);
INSERT INTO `sys_user_role` VALUES (16, 1, 2);

SET FOREIGN_KEY_CHECKS = 1;
