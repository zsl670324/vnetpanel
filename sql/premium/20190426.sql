-- 节点支持动态IP、加入宝塔API
ALTER TABLE `ss_node`
    ADD COLUMN `is_dynamic` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否动态IP：0-否、1-是' AFTER `is_transit`,
    ADD COLUMN `is_bt` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否启用宝塔API：0-否、1-是' AFTER `ssh_port`,
    ADD COLUMN `bt_port` SMALLINT(6) UNSIGNED NOT NULL DEFAULT '8888' COMMENT '宝塔访问端口' AFTER `is_bt`,
    ADD COLUMN `bt_key` VARCHAR(50) NULL DEFAULT '' COMMENT '宝塔API密钥' AFTER `bt_port`,
    ADD COLUMN `level` INT(11) NOT NULL DEFAULT '0' COMMENT '等级：0-无等级，全部可见' AFTER `type`,
	ADD COLUMN `is_tcp` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否启用TCP：0-不启用、1-启用' AFTER `is_tcp_check`,
	ADD COLUMN `is_udp` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否启用UDP：0-不启用、1-启用' AFTER `is_tcp`,
	ADD COLUMN `speed_limit` bigint(20) NOT NULL DEFAULT '0' COMMENT '限速：0-不限速' AFTER `traffic_rate`;

-- 国家表字段改名
ALTER TABLE `country`
	CHANGE COLUMN `country_name` `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '名称' COLLATE 'utf8mb4_unicode_ci' AFTER `id`,
	CHANGE COLUMN `country_code` `code` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '代码' COLLATE 'utf8mb4_unicode_ci' AFTER `name`;

-- 国家表增加字段
ALTER TABLE `country`
	ADD COLUMN `created_at` DATETIME NULL DEFAULT NULL COMMENT '创建时间' AFTER `code`,
	ADD COLUMN `updated_at` DATETIME NULL DEFAULT NULL COMMENT '最后更新时间' AFTER `created_at`;

-- 创建授权密钥表
CREATE TABLE `access` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`node_id` INT(11) NOT NULL DEFAULT '0' COMMENT '授权节点ID',
	`key` CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '' COLLATE 'utf8mb4_unicode_ci' COMMENT '认证KEY',
	`secret` CHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '' COLLATE 'utf8mb4_unicode_ci' COMMENT '通信密钥',
	`status` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '状态：0-禁用、1-启用',
	`created_at` DATETIME NULL DEFAULT NULL COMMENT '创建时间',
	`updated_at` DATETIME NULL DEFAULT NULL COMMENT '最后更新时间',
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='授权密钥表';


-- 权限表
CREATE TABLE `permissions` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`guard_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- 角色表
CREATE TABLE `roles` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`guard_name` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`description` VARCHAR(255) NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- 模型权限关联表
CREATE TABLE `model_has_permissions` (
	`permission_id` INT(10) UNSIGNED NOT NULL,
	`model_type` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`model_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
	INDEX `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- 模型角色关联表
CREATE TABLE `model_has_roles` (
	`role_id` INT(10) UNSIGNED NOT NULL,
	`model_type` VARCHAR(191) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`model_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`role_id`, `model_id`, `model_type`),
	INDEX `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- 角色权限表
CREATE TABLE `role_has_permissions` (
	`permission_id` INT(10) UNSIGNED NOT NULL,
	`role_id` INT(10) UNSIGNED NOT NULL,
	PRIMARY KEY (`permission_id`, `role_id`),
	INDEX `role_has_permissions_role_id_foreign` (`role_id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- 导入权限行为数据
INSERT INTO `permissions` (`name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
	('admin', 'web', '管理后台首页', '2018-11-02 10:30:58', '2018-11-02 10:30:58'),
	('admin/userList', 'web', '用户管理-用户列表', '2018-11-02 10:31:19', '2018-11-02 10:31:19'),
	('admin/addUser', 'web', '用户管理-添加用户', '2018-11-02 10:31:31', '2018-11-02 10:31:31'),
	('admin/editUser', 'web', '用户管理-编辑用户', '2018-11-02 10:31:53', '2018-11-02 10:31:53'),
	('admin/delUser', 'web', '用户管理-删除用户', '2018-11-02 10:32:21', '2018-11-02 10:32:21'),
	('admin/batchAddUsers', 'web', '用户管理-批量生成用户', '2018-11-02 10:32:36', '2018-11-02 10:32:36'),
	('admin/exportSSJson', 'web', '用户管理-导出用户的SS配置', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/nodeList', 'web', '节点管理-节点列表', '2018-11-02 10:33:11', '2018-11-02 10:33:11'),
	('admin/addNode', 'web', '节点管理-添加节点', '2018-11-02 10:33:24', '2018-11-02 10:33:24'),
	('admin/editNode', 'web', '节点管理-编辑节点', '2018-11-02 10:33:37', '2018-11-02 10:33:37'),
	('admin/delNode', 'web', '节点管理-删除节点', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeRealTimeStatus', 'web', '节点管理-删除节点', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeMonitor', 'web', '节点管理-节点流量监控', '2018-11-02 10:34:07', '2018-11-02 10:34:07'),
	('admin/articleList', 'web', '文章管理-文章列表', '2018-11-02 10:34:25', '2018-11-02 10:34:25'),
	('admin/addArticle', 'web', '文章管理-添加文章', '2018-11-02 10:34:37', '2018-11-02 10:34:37'),
	('admin/editArticle', 'web', '文章管理-编辑文章', '2018-11-02 10:34:51', '2018-11-02 10:34:51'),
	('admin/delArticle', 'web', '文章管理-删除文章', '2018-11-02 10:35:03', '2018-11-02 10:35:03'),
	('admin/groupList', 'web', '节点管理-节点分组列表', '2018-11-02 10:35:28', '2018-11-02 10:35:28'),
	('admin/addGroup', 'web', '节点管理-添加节点分组', '2018-11-02 10:35:43', '2018-11-02 10:35:43'),
	('admin/editGroup', 'web', '节点管理-编辑节点分组', '2018-11-02 10:35:55', '2018-11-02 10:35:55'),
	('admin/delGroup', 'web', '节点管理-删除节点分组', '2018-11-02 10:36:07', '2018-11-02 10:36:07'),
	('admin/labelList', 'web', '标签管理-节点标签列表', '2018-11-02 10:36:27', '2018-11-02 10:36:27'),
	('admin/addLabel', 'web', '标签管理-添加标签', '2018-11-02 10:36:40', '2018-11-02 10:36:40'),
	('admin/editLabel', 'web', '标签管理-编辑标签', '2018-11-02 10:36:51', '2018-11-02 10:36:51'),
	('admin/delLabel', 'web', '标签管理-删除标签', '2018-11-02 10:37:02', '2018-11-02 10:37:02'),
	('ticket/ticketList', 'web', '工单管理-工单列表', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('ticket/addTicket', 'web', '工单管理-发起工单', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('ticket/replyTicket', 'web', '工单管理-回复工单', '2018-11-02 10:37:28', '2018-11-02 10:37:28'),
	('ticket/closeTicket', 'web', '工单管理-关闭工单', '2018-11-02 10:37:41', '2018-11-02 10:37:41'),
	('admin/orderList', 'web', '订单管理-订单列表', '2018-11-02 10:38:48', '2018-11-02 10:38:48'),
	('admin/inviteList', 'web', '邀请管理-邀请码列表', '2018-11-02 10:39:03', '2018-11-02 10:39:03'),
	('admin/makeInvite', 'web', '邀请管理-生成邀请码', '2018-11-02 10:39:23', '2018-11-02 10:39:23'),
	('admin/exportInvite', 'web', '邀请管理-导出邀请码', '2018-11-02 10:39:41', '2018-11-02 10:39:41'),
	('admin/applyList', 'web', '提现管理-体现申请列表', '2018-11-02 10:40:36', '2018-11-02 10:40:36'),
	('admin/applyDetail', 'web', '提现管理-提现申请详情', '2018-11-02 10:41:12', '2018-11-02 10:41:12'),
	('admin/setApplyStatus', 'web', '提现管理-设置提现申请状态', '2018-11-02 10:41:34', '2018-11-02 10:41:34'),
	('coupon/couponList', 'web', '卡券管理-卡券列表', '2018-11-02 10:51:42', '2018-11-02 10:51:42'),
	('coupon/addCoupon', 'web', '卡券管理-添加卡券', '2018-11-02 10:51:57', '2018-11-02 10:51:57'),
	('coupon/delCoupon', 'web', '卡券管理-删除卡券', '2018-11-02 10:52:09', '2018-11-02 10:52:09'),
	('coupon/exportCoupon', 'web', '卡券管理-导出卡券', '2018-11-02 10:52:25', '2018-11-02 10:52:25'),
	('shop/goodsList', 'web', '商品管理-商品列表', '2018-11-02 10:54:58', '2018-11-02 10:54:58'),
	('shop/addGoods', 'web', '商品管理-添加商品', '2018-11-02 10:55:13', '2018-11-02 10:55:13'),
	('shop/editGoods', 'web', '商品管理-编辑商品', '2018-11-02 10:55:27', '2018-11-02 10:55:27'),
	('shop/delGoods', 'web', '商品管理-删除商品', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/config', 'web', '设置-通用配置列表', '2018-11-02 11:18:20', '2018-11-02 11:18:20'),
	('admin/addConfig', 'web', '配置-添加通用配置', '2018-11-02 11:18:58', '2018-11-02 11:18:58'),
	('admin/delConfig', 'web', '配置-删除通用配置', '2018-11-02 11:19:22', '2018-11-02 11:19:22'),
	('admin/addCountry', 'web', '配置-通用配置-添加国家', '2018-11-02 11:20:52', '2018-11-02 11:20:52'),
	('admin/updateCountry', 'web', '配置-通用配置-编辑国家', '2018-11-02 11:24:44', '2018-11-02 11:24:44'),
	('admin/delCountry', 'web', '配置-通用配置-删除国家', '2018-11-02 11:24:58', '2018-11-02 11:24:58'),
	('admin/setDefaultConfig', 'web', '配置-通用配置-设置默认值', '2018-11-02 11:25:20', '2018-11-02 11:25:20'),
	('admin/system', 'web', '设置-系统配置-配置列表', '2018-11-02 15:25:56', '2018-11-02 15:25:56'),
	('admin/setExtend', 'web', '设置-系统配置-设置客服统计', '2018-11-02 15:26:19', '2018-11-02 15:26:19'),
	('admin/setConfig', 'web', '配置-系统设置-设置某个配置项', '2018-11-02 15:26:46', '2018-11-02 15:26:46'),
	('admin/userBalanceLogList', 'web', '用户管理-余额变动记录', '2018-11-02 15:28:19', '2018-11-02 15:28:19'),
	('admin/userTrafficLogList', 'web', '用户管理-流量变动记录', '2018-11-02 15:28:32', '2018-11-02 15:28:32'),
	('admin/userRebateList', 'web', '用户管理-返利流水记录', '2018-11-02 15:28:46', '2018-11-02 15:28:46'),
	('admin/userBanLogList', 'web', '用户管理-用户封禁记录', '2018-11-02 15:28:56', '2018-11-02 15:28:56'),
	('admin/userOnlineIPList', 'web', '用户管理-用户在线IP列表', '2018-11-02 15:28:56', '2018-11-02 15:28:56'),
	('admin/onlineIPMonitor', 'web', '用户管理-在线IP监控', '2018-11-02 15:28:56', '2018-11-02 15:28:56'),
	('admin/export', 'web', '用户管理-用户列表-导出(查看)配置信息', '2018-11-02 15:29:20', '2018-11-02 15:29:20'),
	('admin/userMonitor', 'web', '用户管理-用户列表-用户流量监控', '2018-11-02 15:29:34', '2018-11-02 15:29:34'),
	('admin/resetUserTraffic', 'web', '用户管理-用户列表-重置用户流量', '2018-11-02 15:32:48', '2018-11-02 15:32:48'),
	('admin/handleUserBalance', 'web', '用户管理-用户列表-用户余额充值', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/switchToUser', 'web', '用户管理-用户列表-转换成某个用户的身份', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('admin/subscribeAccessLog', 'web', '用户管理-订阅访问日志', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('subscribe/subscribeList', 'web', '订阅管理-订阅码列表', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('subscribe/deviceList', 'web', '订阅管理-订阅设备列表', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('subscribe/setSubscribeStatus', 'web', '订阅管理-启用禁用用户的订阅', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('subscribe/setDeviceStatus', 'web', '订阅管理-是否允许设备订阅', '2018-11-02 15:46:35', '2018-11-02 15:46:35'),
	('marketing/emailList', 'web', '营销管理-邮件消息列表', '2018-11-02 16:43:59', '2018-11-02 16:43:59'),
	('admin/decompile', 'web', '工具箱-反解析', '2018-11-02 15:47:24', '2018-11-02 15:47:24'),
	('admin/download', 'web', '工具箱-下载转换过的JSON配置', '2018-11-02 15:48:01', '2018-11-02 15:48:01'),
	('admin/convert', 'web', '工具箱-格式转换', '2018-11-02 15:48:16', '2018-11-02 15:48:16'),
	('admin/import', 'web', '工具箱-数据导入', '2018-11-02 15:48:33', '2018-11-02 15:48:33'),
	('admin/trafficLog', 'web', '工具箱-流量日志', '2018-11-02 15:48:49', '2018-11-02 15:48:49'),
	('admin/analysis', 'web', '工具箱-日志分析', '2018-11-02 15:49:07', '2018-11-02 15:49:07'),
	('admin/emailLog', 'web', '工具箱-邮件发送日志', '2018-11-02 15:49:07', '2018-11-02 15:49:07'),
	('payment/callbackList', 'web', '工具箱-支付回调日志', '2018-11-02 15:50:10', '2018-11-02 15:50:10'),
	('sensitiveWords/list', 'web', '工具箱-敏感词管理-敏感词列表', '2018-11-02 16:42:13', '2018-11-02 16:42:13'),
	('sensitiveWords/add', 'web', '工具箱-敏感词管理-添加敏感词', '2018-11-02 16:42:27', '2018-11-02 16:42:27'),
	('sensitiveWords/del', 'web', '工具箱-敏感词管理-删除敏感词', '2018-11-02 16:42:39', '2018-11-02 16:42:39'),
	('logs', 'web', '工具箱-系统运行日志', '2018-11-02 16:43:07', '2018-11-02 16:43:07'),
	('admin/profile', 'web', '管理后台-修改个人信息', '2018-11-02 17:11:53', '2018-11-02 17:11:53'),
	('admin/makePort', 'web', '管理后台-生成端口', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/getNodeStatus', 'web', '管理后台-查询节点实时状态', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/accessList', 'web', '管理后台-节点管理-WEBAPI-授权KEY列表', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/addAccess', 'web', '管理后台-节点管理-WEBAPI-生成KEY', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/delAccess', 'web', '管理后台-节点管理-WEBAPI-删除KEY', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/revokeAccess', 'web', '管理后台-节点管理-WEBAPI-吊销KEY', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/refreshAccess', 'web', '管理后台-节点管理-WEBAPI-重置KEY', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/makeAccessConfig', 'web', '管理后台-节点管理-WEBAPI-生成节点配置文件', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/sendBarkTestMessage', 'web', '管理后台-发送Bark测试消息', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('permission/permissionList', 'web', '权限管理-行为列表', '2018-11-02 17:14:45', '2018-11-02 17:14:45'),
	('permission/addPermission', 'web', '权限管理-创建行为', '2018-11-02 17:14:55', '2018-11-02 17:14:55'),
	('permission/editPermission', 'web', '权限管理-编辑行为', '2018-11-02 17:15:07', '2018-11-02 17:15:07'),
	('permission/deletePermission', 'web', '权限管理-删除行为', '2018-11-02 17:15:15', '2018-11-02 17:15:15'),
	('permission/roleList', 'web', '权限管理-角色列表', '2018-11-02 17:15:25', '2018-11-02 17:15:25'),
	('permission/addRole', 'web', '权限管理-创建角色', '2018-11-02 17:15:33', '2018-11-02 17:15:33'),
	('permission/editRole', 'web', '权限管理-编辑角色', '2018-11-02 17:15:41', '2018-11-02 17:15:41'),
	('permission/deleteRole', 'web', '权限管理-删除角色', '2018-11-02 17:15:49', '2018-11-02 17:15:49'),
	('permission/masterList', 'web', '权限管理-管理员列表', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/deleteMaster', 'web', '权限管理-删除管理员', '2018-11-02 17:16:04', '2018-11-02 17:16:04'),
	('permission/assignPermission', 'web', '权限管理-分配行为', '2018-11-02 17:16:12', '2018-11-02 17:16:12'),
	('permission/assignRole', 'web', '权限管理-分配角色', '2018-11-02 17:16:20', '2018-11-02 17:16:20');

-- 导入角色数据
INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', '超级管理员', '2018-11-02 17:23:45', '2018-11-02 17:23:45'),
	(2, 'admin', 'web', '普通管理员', '2018-11-02 17:23:55', '2018-11-02 17:23:55'),
	(3, 'seniortech', 'web', '高级技术员', '2018-11-02 17:25:20', '2018-11-02 17:25:20');

-- 账号admin的所有权限
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(6,1),
	(7,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1),
	(17,1),
	(18,1),
	(19,1),
	(20,1),
	(21,1),
	(22,1),
	(23,1),
	(24,1),
	(25,1),
	(26,1),
	(27,1),
	(28,1),
	(29,1),
	(30,1),
	(31,1),
	(32,1),
	(33,1),
	(34,1),
	(35,1),
	(36,1),
	(37,1),
	(38,1),
	(39,1),
	(40,1),
	(41,1),
	(42,1),
	(43,1),
	(44,1),
	(45,1),
	(46,1),
	(47,1),
	(48,1),
	(49,1),
	(50,1),
	(51,1),
	(52,1),
	(53,1),
	(54,1),
	(55,1),
	(56,1),
	(57,1),
	(58,1),
	(59,1),
	(60,1),
	(61,1),
	(62,1),
	(63,1),
	(64,1),
	(65,1),
	(66,1),
	(67,1),
	(68,1),
	(69,1),
	(70,1),
	(71,1),
	(72,1),
	(73,1),
	(74,1),
	(75,1),
	(76,1),
	(77,1),
	(78,1),
	(79,1),
	(80,1),
	(81,1),
	(82,1),
	(83,1),
	(84,1),
	(85,1),
	(86,1),
	(87,1),
	(88,1),
	(89,1),
	(90,1),
	(91,1),
	(92,1),
	(93,1),
	(94,1),
	(95,1);

-- admin账号默认拥有的角色
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES (1,'App\\Http\\Models\\User',1);


-- 加入Bark消息推送
INSERT INTO `config` VALUES ('96', 'is_bark', 0);
INSERT INTO `config` VALUES ('97', 'bark_device', '');


-- 邮件发送记录增加对外可见唯一识别码
ALTER TABLE `email_log`
	ADD COLUMN `code` CHAR(8) NULL COMMENT '消息对外可见的唯一识别码' AFTER `type`;

-- 商品授权等级
ALTER TABLE `goods`
  ADD COLUMN `level` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '购买该商品后给用户授权的等级' AFTER `traffic`;


-- 敏感词黑白名单
ALTER TABLE `sensitive_words`
  ADD COLUMN `type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '类型：1-黑名单、2-白名单' AFTER `id`;

UPDATE `config` SET name='is_register_type',VALUE=0 WHERE id=54;

-- 删除等级表
DROP TABLE `level`;

-- 废除用户和商品得标签化
-- DROP TABLE `user_label`; -- 不删除，用于从开源版更新数据时对数据用
DROP TABLE `goods_label`;

-- 管理员收信地址字段更名
UPDATE `config` SET name='webmaster_email' WHERE id=38;

-- 加入telegram消息推送
UPDATE `config` SET name='is_telegram' WHERE id=59;
UPDATE `config` SET name='telegram_token' WHERE id=60;
UPDATE `config` SET name='telegram_chatid' WHERE id=61;

-- 加入易支付
INSERT INTO `config` VALUES ('98', 'is_epay', 0);
INSERT INTO `config` VALUES ('99', 'epay_url', '');
INSERT INTO `config` VALUES ('100', 'epay_mch_id', '');
INSERT INTO `config` VALUES ('101', 'epay_key', '');

-- 支付单加入支付跳转URL
ALTER TABLE `payment`
	ADD COLUMN `jump_url` VARCHAR(255) NULL DEFAULT NULL COMMENT '跳转URL（打开跳转去别的URL支付）' AFTER `qr_local_url`;

-- 兼容VNET单端口
ALTER TABLE `ss_node`
  DROP COLUMN `protocol_param`,
  DROP COLUMN `single_port`,
  DROP COLUMN `single_passwd`,
  DROP COLUMN `single_method`,
  DROP COLUMN `single_protocol`,
  DROP COLUMN `single_obfs`,
  DROP COLUMN `single_force`,
  ADD COLUMN `port` varchar(50) NULL COMMENT '单端口端口号' AFTER `single`,
  ADD COLUMN `passwd` varchar(255) NULL COMMENT '单端口连接密码' AFTER `port`;

-- 商品增加赠送邀请码数
ALTER TABLE `goods`
	ADD COLUMN `invite_num` INT(11) NOT NULL DEFAULT '0' COMMENT '赠送邀请码数' AFTER `days`;

-- 用户表增加可以生成的邀请码数
ALTER TABLE `user`
	ADD COLUMN `invite_num` INT NOT NULL DEFAULT '0' COMMENT '可生成邀请码数' AFTER `traffic_reset_day`;

-- 加入SSRR特有的协议
INSERT INTO `ss_config` VALUES ('42', 'auth_akarin_rand', '2', '0', '0');
INSERT INTO `ss_config` VALUES ('43', 'auth_akarin_spec_a', '2', '0', '0');

-- 加入VNET WEBAPI版后端的消息推送端口（由面板往后端推送消息）
UPDATE `config` SET name='node_push_port',value='8081' WHERE id=15;

-- 删除用户的协议参数字段
ALTER TABLE `user`
  DROP COLUMN `protocol_param`;

-- 适配vnet后端：扩大节点心跳表 load 字段长度
ALTER TABLE `ss_node_info`
	CHANGE COLUMN `load` `load` VARCHAR(255) NOT NULL COMMENT '负载' COLLATE 'utf8mb4_unicode_ci' AFTER `uptime`;

-- 订阅时显示节点等级
UPDATE `config` SET name='is_show_subscribe_level',value=0 WHERE id=16;

-- 支付专用回调域名
UPDATE `config` SET name='website_callback_url',value='' WHERE id=58;
