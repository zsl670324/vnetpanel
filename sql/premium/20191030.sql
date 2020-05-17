-- 兼容IPv6
ALTER TABLE `user_subscribe_log`
MODIFY COLUMN `request_ip` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '请求IP' AFTER `sid`;

ALTER TABLE `user_login_log`
MODIFY COLUMN `ip` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL AFTER `user_id`;

ALTER TABLE `user`
MODIFY COLUMN `reg_ip` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '127.0.0.1' COMMENT '注册IP' AFTER `level`;
