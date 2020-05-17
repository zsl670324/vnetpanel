-- 生成手机号md5
CREATE TABLE `phone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country` smallint(5) unsigned DEFAULT '86' COMMENT '国家代码',
  `prefix` tinyint(3) unsigned NOT NULL COMMENT '前缀',
  `phone` bigint(20) unsigned NOT NULL COMMENT '手机号',
  `short` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '短md5，16位',
  `long` char(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '长md5，32位',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 用户表增加联系地址
ALTER TABLE `user`
	ADD COLUMN `address` VARCHAR(255) NULL DEFAULT '' COMMENT '联系地址' AFTER `phone`;
