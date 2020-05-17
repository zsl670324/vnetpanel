-- 节点表增加v2_connect_port、v2_connect_tls字段；删除v2_cdn字段
ALTER TABLE `ss_node`
	ADD COLUMN `v2_connect_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '443' COMMENT 'V2Ray连接端口' AFTER `v2_alter_id`,
	CHANGE COLUMN `v2_port` `v2_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '10087' COMMENT 'V2Ray服务端口' AFTER `v2_connect_port`,
	CHANGE COLUMN `v2_path` `v2_path` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'V2Ray的WS/H2路径' COLLATE 'utf8mb4_unicode_ci' AFTER `v2_host`,
	ADD COLUMN `v2_connect_tls` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'V2Ray连接TLS：0-未开启、1-开启' AFTER `v2_path`,
	CHANGE COLUMN `v2_tls` `v2_tls` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'V2Ray后端TLS：0-未开启、1-开启' AFTER `v2_connect_tls`,
	DROP COLUMN `v2_cdn`;

-- 订单表增加bill_at、reset_at字段
ALTER TABLE `orders`
	ADD COLUMN `bill_at` DATETIME NULL DEFAULT NULL COMMENT '下次账单出现时间' AFTER `status`,
	ADD COLUMN `reset_at` DATETIME NULL DEFAULT NULL COMMENT '下次流量重置时间' AFTER `bill_at`;
