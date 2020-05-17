-- 移除用户表的is_admin字段
ALTER TABLE `user`
  DROP COLUMN `is_admin`;

-- 清空旧的角色数据，插入新的角色数据
TRUNCATE TABLE `roles`;

-- 删除权限行为表并重建，导入权限行为数据
DROP TABLE `permissions`;

CREATE TABLE `permissions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `guard_name` VARCHAR(191) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;

INSERT INTO `permissions` (`name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
	('admin', 'master', '管理后台首页', '2018-11-02 10:30:58', '2018-11-02 10:30:58'),
	('admin/userList', 'master', '用户管理-用户列表', '2018-11-02 10:31:19', '2018-11-02 10:31:19'),
	('admin/addUser', 'master', '用户管理-添加用户', '2018-11-02 10:31:31', '2018-11-02 10:31:31'),
	('admin/editUser', 'master', '用户管理-编辑用户', '2018-11-02 10:31:53', '2018-11-02 10:31:53'),
	('admin/delUser', 'master', '用户管理-删除用户', '2018-11-02 10:32:21', '2018-11-02 10:32:21'),
	('admin/batchAddUsers', 'master', '用户管理-批量生成用户', '2018-11-02 10:32:36', '2018-11-02 10:32:36'),
	('admin/userGroupList', 'master', '用户管理-用户分组列表', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/addUserGroup', 'master', '用户管理-添加用户分组', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/delUserGroup', 'master', '用户管理-删除用户分组', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/nodeList', 'master', '节点管理-节点列表', '2018-11-02 10:33:11', '2018-11-02 10:33:11'),
	('admin/addNode', 'master', '节点管理-添加节点', '2018-11-02 10:33:24', '2018-11-02 10:33:24'),
	('admin/editNode', 'master', '节点管理-编辑节点', '2018-11-02 10:33:37', '2018-11-02 10:33:37'),
	('admin/delNode', 'master', '节点管理-删除节点', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/reloadNode', 'master', '节点管理-重载节点后端', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeRealTimeStatus', 'master', '节点管理-节点实时状态', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeMonitor', 'master', '节点管理-节点流量监控', '2018-11-02 10:34:07', '2018-11-02 10:34:07'),
	('admin/articleList', 'master', '文章管理-文章列表', '2018-11-02 10:34:25', '2018-11-02 10:34:25'),
	('admin/addArticle', 'master', '文章管理-添加文章', '2018-11-02 10:34:37', '2018-11-02 10:34:37'),
	('admin/editArticle', 'master', '文章管理-编辑文章', '2018-11-02 10:34:51', '2018-11-02 10:34:51'),
	('admin/delArticle', 'master', '文章管理-删除文章', '2018-11-02 10:35:03', '2018-11-02 10:35:03'),
	('admin/groupList', 'master', '节点管理-节点分组列表', '2018-11-02 10:35:28', '2018-11-02 10:35:28'),
	('admin/addGroup', 'master', '节点管理-添加节点分组', '2018-11-02 10:35:43', '2018-11-02 10:35:43'),
	('admin/editGroup', 'master', '节点管理-编辑节点分组', '2018-11-02 10:35:55', '2018-11-02 10:35:55'),
	('admin/delGroup', 'master', '节点管理-删除节点分组', '2018-11-02 10:36:07', '2018-11-02 10:36:07'),
	('admin/labelList', 'master', '节点管理-标签列表', '2018-11-02 10:36:27', '2018-11-02 10:36:27'),
	('admin/addLabel', 'master', '节点管理-添加标签', '2018-11-02 10:36:40', '2018-11-02 10:36:40'),
	('admin/editLabel', 'master', '节点管理-编辑标签', '2018-11-02 10:36:51', '2018-11-02 10:36:51'),
	('admin/delLabel', 'master', '节点管理-删除标签', '2018-11-02 10:37:02', '2018-11-02 10:37:02'),
	('admin/ticketList', 'master', '工单管理-工单列表', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('admin/addTicket', 'master', '工单管理-发起工单', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('admin/replyTicket', 'master', '工单管理-回复工单', '2018-11-02 10:37:28', '2018-11-02 10:37:28'),
	('admin/closeTicket', 'master', '工单管理-关闭工单', '2018-11-02 10:37:41', '2018-11-02 10:37:41'),
	('admin/orderList', 'master', '订单管理-订单列表', '2018-11-02 10:38:48', '2018-11-02 10:38:48'),
	('admin/paymentCallbackList', 'master', '订单管理-支付回调日志', '2018-11-02 15:50:10', '2018-11-02 15:50:10'),
	('admin/inviteList', 'master', '邀请管理-邀请码列表', '2018-11-02 10:39:03', '2018-11-02 10:39:03'),
	('admin/makeInvite', 'master', '邀请管理-生成邀请码', '2018-11-02 10:39:23', '2018-11-02 10:39:23'),
	('admin/exportInvite', 'master', '邀请管理-导出邀请码', '2018-11-02 10:39:41', '2018-11-02 10:39:41'),
	('admin/applyList', 'master', '提现管理-提现申请列表', '2018-11-02 10:40:36', '2018-11-02 10:40:36'),
	('admin/applyDetail', 'master', '提现管理-提现申请详情', '2018-11-02 10:41:12', '2018-11-02 10:41:12'),
	('admin/setApplyStatus', 'master', '提现管理-设置提现申请状态', '2018-11-02 10:41:34', '2018-11-02 10:41:34'),
	('admin/couponList', 'master', '卡券管理-卡券列表', '2018-11-02 10:51:42', '2018-11-02 10:51:42'),
	('admin/addCoupon', 'master', '卡券管理-添加卡券', '2018-11-02 10:51:57', '2018-11-02 10:51:57'),
	('admin/delCoupon', 'master', '卡券管理-删除卡券', '2018-11-02 10:52:09', '2018-11-02 10:52:09'),
	('admin/exportCoupon', 'master', '卡券管理-导出卡券', '2018-11-02 10:52:25', '2018-11-02 10:52:25'),
	('admin/productList', 'master', '产品管理-产品列表', '2018-11-02 10:54:58', '2018-11-02 10:54:58'),
	('admin/addProduct', 'master', '产品管理-添加产品', '2018-11-02 10:55:13', '2018-11-02 10:55:13'),
	('admin/editProduct', 'master', '产品管理-编辑产品', '2018-11-02 10:55:27', '2018-11-02 10:55:27'),
	('admin/delProduct', 'master', '产品管理-删除产品', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/productsPool', 'master', '产品管理-产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/addProductsPool', 'master', '产品管理-添加产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/editProductsPool', 'master', '产品管理-编辑产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/delProductsPool', 'master', '产品管理-删除产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/addRule', 'master', '审计规则-添加规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/delRule', 'master', '审计规则-删除规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/ruleGroupList', 'master', '审计规则-规则分组列表', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/addRuleGroup', 'master', '审计规则-添加规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/editRuleGroup', 'master', '审计规则-编辑规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/delRuleGroup', 'master', '审计规则-删除规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/assignNode', 'master', '审计规则-规则分组分配节点', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/ruleLogList', 'master', '审计规则-审计规则触发记录', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/clearLog', 'master', '商品管理-清空审计规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/config', 'master', '设置-通用配置列表', '2018-11-02 11:18:20', '2018-11-02 11:18:20'),
	('admin/setDefaultConfig', 'master', '配置-通用配置-设置默认值', '2018-11-02 11:25:20', '2018-11-02 11:25:20'),
	('admin/system', 'master', '设置-系统配置-配置列表', '2018-11-02 15:25:56', '2018-11-02 15:25:56'),
	('admin/setExtend', 'master', '设置-系统配置-设置客服统计', '2018-11-02 15:26:19', '2018-11-02 15:26:19'),
	('admin/setConfig', 'master', '配置-系统设置-设置某个配置项', '2018-11-02 15:26:46', '2018-11-02 15:26:46'),
	('admin/userCreditLogList', 'master', '用户管理-余额变动记录', '2018-11-02 15:28:19', '2018-11-02 15:28:19'),
	('admin/userTrafficLogList', 'master', '用户管理-流量变动记录', '2018-11-02 15:28:32', '2018-11-02 15:28:32'),
	('admin/userRebateList', 'master', '用户管理-返利流水记录', '2018-11-02 15:28:46', '2018-11-02 15:28:46'),
	('admin/userBanLogList', 'master', '用户管理-用户封禁记录', '2018-11-02 15:28:56', '2018-11-02 15:28:56'),
	('admin/userSubscribeList', 'master', '用户管理-用户列表-订阅码列表', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/userSubscribeLog', 'master', '用户管理-用户列表-用户订阅访问日志', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/setUserSubscribeStatus', 'master', '用户管理-启用禁用用户的订阅', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/export', 'master', '用户管理-用户列表-导出(查看)配置信息', '2018-11-02 15:29:20', '2018-11-02 15:29:20'),
	('admin/userMonitor', 'master', '用户管理-用户列表-用户流量监控', '2018-11-02 15:29:34', '2018-11-02 15:29:34'),
	('admin/resetUserTraffic', 'master', '用户管理-用户列表-重置用户流量', '2018-11-02 15:32:48', '2018-11-02 15:32:48'),
	('admin/handleUserCredit', 'master', '用户管理-用户列表-用户余额充值', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/onlineIPMonitor', 'master', '用户管理-用户列表-在线IP监控', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/emailList', 'master', '营销管理-邮件群发', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/emailLog', 'master', '营销管理-邮件投递记录', '2018-11-02 15:48:49', '2018-11-02 15:48:49'),
	('admin/import', 'master', '工具箱-数据导入', '2018-11-02 15:48:33', '2018-11-02 15:48:33'),
	('admin/trafficLog', 'master', '工具箱-流量日志', '2018-11-02 15:48:49', '2018-11-02 15:48:49'),
	('admin/sensitiveWordsList', 'master', '工具箱-敏感词管理-敏感词列表', '2018-11-02 16:42:13', '2018-11-02 16:42:13'),
	('admin/addSensitiveWords', 'master', '工具箱-敏感词管理-添加敏感词', '2018-11-02 16:42:27', '2018-11-02 16:42:27'),
	('admin/delSensitiveWords', 'master', '工具箱-敏感词管理-删除敏感词', '2018-11-02 16:42:39', '2018-11-02 16:42:39'),
	('logs', 'master', '工具箱-系统运行日志', '2018-11-02 16:43:07', '2018-11-02 16:43:07'),
	('admin/profile', 'master', '管理后台-修改个人信息', '2018-11-02 17:11:53', '2018-11-02 17:11:53'),
	('admin/makePort', 'master', '管理后台-用户列表-生成端口', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/getNodeStatus', 'master', '管理后台-查询节点实时状态', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/accessList', 'master', '管理后台-节点授权列表', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/addAccess', 'master', '管理后台-添加节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/delAccess', 'master', '管理后台-删除节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/refreshAccess', 'master', '管理后台-重置节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/makeAccessConfig', 'master', '管理后台-生成节点授权配置文件', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/sendBarkTestMessage', 'master', '管理后台-发送Bark测试消息', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('permission/permissionList', 'master', '权限管理-权限行为列表', '2018-11-02 17:14:45', '2018-11-02 17:14:45'),
	('permission/addPermission', 'master', '权限管理-添加权限行为', '2018-11-02 17:14:55', '2018-11-02 17:14:55'),
	('permission/editPermission', 'master', '权限管理-编辑权限行为', '2018-11-02 17:15:07', '2018-11-02 17:15:07'),
	('permission/deletePermission', 'master', '权限管理-删除权限行为', '2018-11-02 17:15:15', '2018-11-02 17:15:15'),
	('permission/roleList', 'master', '权限管理-角色列表', '2018-11-02 17:15:25', '2018-11-02 17:15:25'),
	('permission/addRole', 'master', '权限管理-添加角色', '2018-11-02 17:15:33', '2018-11-02 17:15:33'),
	('permission/editRole', 'master', '权限管理-编辑角色', '2018-11-02 17:15:41', '2018-11-02 17:15:41'),
	('permission/deleteRole', 'master', '权限管理-删除角色', '2018-11-02 17:15:49', '2018-11-02 17:15:49'),
	('permission/masterList', 'master', '权限管理-管理员列表', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/addMaster', 'master', '权限管理-添加管理员', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/editMaster', 'master', '权限管理-编辑管理员', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/deleteMaster', 'master', '权限管理-删除管理员', '2018-11-02 17:16:04', '2018-11-02 17:16:04'),
	('permission/assignPermission', 'master', '权限管理-分配权限行为', '2018-11-02 17:16:12', '2018-11-02 17:16:12');

-- 清空角色模型关联表
TRUNCATE TABLE `model_has_roles`;

-- 清空角色权限关联表
TRUNCATE TABLE `role_has_permissions`;

-- 新增管理员表
CREATE TABLE `master` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `level` tinyint(3) unsigned DEFAULT '1' COMMENT '等级',
  `balance` int(10) DEFAULT '0' COMMENT '余额',
  `expire_time` datetime DEFAULT NULL COMMENT '有效期结束',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：0-禁用、1-启用',
  `last_login` int(10) unsigned DEFAULT NULL COMMENT '最后登录时间',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';

-- 增加一个管理员admin，默认密码123456
INSERT INTO `master` VALUES (1, 'admin', '$2y$10$ryMdx5ejvCSdjvZVZAPpOuxHrsAUY8FEINUATy6RCck6j9EeHhPfq', 0, 0, NULL, NULL, 1, 1575469801, 'qP3UBhSM2JOg8vEAYDYpd1WELW8qtmBCN1F87bdifpffjVllNk2S7cYRpHXh', NULL, '2019-12-04 22:30:01', NULL);

-- 新增管理员操作日志表
CREATE TABLE `master_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned DEFAULT '0' COMMENT '管理员ID',
  `desc` varchar(255) DEFAULT NULL COMMENT '动作描述',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后一次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员操作日志';

-- 新增管理员登录日志表
CREATE TABLE `master_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master_id` int(11) NOT NULL DEFAULT '0',
  `ip` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isp` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员登录日志';

-- 工单表加发起工单的管理员的ID
ALTER TABLE `ticket`
  MODIFY COLUMN `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户ID' AFTER `id`,
  ADD COLUMN `master_id` int(11) DEFAULT '0' COMMENT '发起工单的管理员ID' AFTER `user_id`;

-- 工单回复表字段变更
ALTER TABLE `ticket_reply`
  MODIFY COLUMN `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '回复用户的ID' AFTER `ticket_id`,
  ADD COLUMN `master_id` int(11) NOT NULL DEFAULT 0 COMMENT '回复管理员的ID' AFTER `user_id`;
