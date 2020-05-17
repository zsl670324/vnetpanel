-- 用户表vmess_id改名为uuid
ALTER TABLE `user`
	CHANGE COLUMN `vmess_id` `uuid` VARCHAR(64) NOT NULL DEFAULT '' AFTER `id`;
