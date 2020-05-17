-- 增加V2Ray伪装域名证书表
CREATE TABLE `certificate` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`domain` VARCHAR(255) NOT NULL COMMENT '域名',
	`key` TEXT NULL COMMENT '域名证书KEY',
	`pem` TEXT NULL COMMENT '域名证书PEM',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='域名证书';

-- 增加：Trojan后端授权码
INSERT INTO `config` VALUES ('102', 'trojan_license', '');

-- 增加：Trojan连接端口
ALTER TABLE `ss_node` ADD COLUMN `trojan_port` SMALLINT NOT NULL DEFAULT '443' COMMENT 'Trojan连接端口' AFTER `tls_provider`;
