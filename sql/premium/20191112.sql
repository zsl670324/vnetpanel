-- 修正用户登录日志表字段长度
ALTER TABLE `user_login_log`
  MODIFY COLUMN `country` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `ip`,
  MODIFY COLUMN `province` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `country`,
  MODIFY COLUMN `city` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `province`,
  MODIFY COLUMN `county` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `city`,
  MODIFY COLUMN `isp` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `county`,
  MODIFY COLUMN `area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `isp`;
