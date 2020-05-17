-- 用户订阅变更记录
CREATE TABLE `user_subscribe_ex` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL DEFAULT '0',
	`before` CHAR(8) NULL DEFAULT NULL,
	`after` CHAR(8) NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='用户订阅变更记录';
