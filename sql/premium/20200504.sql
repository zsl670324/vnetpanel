-- 数据字典改名
RENAME TABLE `ss_group` TO `groups`;
RENAME TABLE `ss_group_node` TO `group_node`;
RENAME TABLE `ss_node` TO `node`;
RENAME TABLE `ss_node_info` TO `node_heartbeat`;
RENAME TABLE `ss_node_ip` TO `node_ip`;
RENAME TABLE `ss_node_label` TO `node_label`;
RENAME TABLE `ss_node_online_log` TO `node_online_log`;
RENAME TABLE `ss_node_traffic_daily` TO `node_traffic_daily`;
RENAME TABLE `ss_node_traffic_hourly` TO `node_traffic_hourly`;
RENAME TABLE `ss_config` TO `encrypt`;

-- 移除节点的SSH端口字段
ALTER TABLE `node` DROP COLUMN `ssh_port`;

-- 国家表移除无用字段
ALTER TABLE `country`
	DROP COLUMN `created_at`,
	DROP COLUMN `updated_at`;

-- 用户表的代理连接密码长度由16位改32位
ALTER TABLE `user`
	CHANGE COLUMN `passwd` `passwd` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '代理密码' COLLATE 'utf8mb4_unicode_ci' AFTER `port`;

-- 产品名称池去除无用字段
ALTER TABLE `products_pool`
	DROP COLUMN `min_amount`,
	DROP COLUMN `max_amount`;

-- 卡券适用产品
ALTER TABLE `coupon`
	ADD COLUMN `products` TEXT NULL DEFAULT '' COMMENT '适用产品ID，用,号分隔' AFTER `discount`;
