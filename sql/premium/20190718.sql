-- 创建审计规则表
DROP TABLE `rule`;
CREATE TABLE `rule` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
	`type` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '类型：reg-正则表达式、domain-域名、ip-IP',
	`pattern` TEXT NOT NULL COMMENT '规则值' COLLATE 'utf8mb4_unicode_ci',
	`name` VARCHAR(100) NOT NULL COMMENT '规则描述' COLLATE 'utf8mb4_unicode_ci',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则';


-- 审计规则数据
INSERT INTO `rule` (`id`, `type`, `pattern`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'reg', '(.+\\.|^)(360|so)\\.(cn|com)', '屏蔽360相关', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
	(2, 'reg', '(Subject|HELO|SMTP)', '屏蔽垃圾邮件', '2019-07-19 15:04:35', '2019-07-19 15:04:35'),
	(3, 'reg', 'BitTorrent protocol', '屏蔽BT协议', '2019-07-19 15:04:50', '2019-07-19 15:04:50'),
	(4, 'reg', '(api|ps|sv|offnavi|newvector|ulog\\.imap|newloc)(\\.map|)\\.(baidu|n\\.shifen)\\.com', '屏蔽百度定位', '2019-07-19 15:05:06', '2019-07-19 15:05:06'),
	(5, 'reg', '(.*\\.||)(dafahao|minghui|dongtaiwang|epochtimes|ntdtv|falundafa|wujieliulan|zhengjian)\\.(org|com|net)', '屏蔽反动网站', '2019-07-19 15:05:46', '2019-07-19 15:05:46'),
	(6, 'reg', '(torrent|\\.torrent|peer_id=|info_hash|get_peers|find_node|BitTorrent|announce_peer|announce\\.php\\?passkey=)', '屏蔽BT扩展名', '2019-07-19 15:06:07', '2019-07-19 15:06:07'),
	(7, 'reg', '(^.*\\@)(guerrillamail|guerrillamailblock|sharklasers|grr|pokemail|spam4|bccto|chacuo|027168)\\.(info|biz|com|de|net|org|me|la)', '屏蔽SPAM邮箱', '2019-07-19 15:06:20', '2019-07-19 15:06:20'),
	(8, 'reg', '(.?)(xunlei|sandai|Thunder|XLLiveUD)(.)', '屏蔽迅雷下载', '2019-07-19 15:06:31', '2019-07-19 15:06:31');


-- 创建节点审计规则表
DROP TABLE `ss_node_deny`;
CREATE TABLE `ss_node_rule` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
	`node_id` INT(11) NOT NULL DEFAULT '0' COMMENT '节点ID',
	`rule_id` INT(11) NOT NULL DEFAULT '0' COMMENT '审计规则ID',
	`is_black` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '是否黑名单模式：0-不是、1-是',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点审计规则关联';


-- 创建触发审计规则日志表
CREATE TABLE `rule_log` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
	`node_id` INT(11) NOT NULL DEFAULT '0' COMMENT '节点ID',
	`rule_id` INT(11) NOT NULL DEFAULT '0' COMMENT '规则ID',
	`reason` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '触发原因',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `idx` (`user_id`, `node_id`, `rule_id`)
) ENGINE=InnoDB COMMENT='触发审计规则日志表';


ALTER TABLE `user`
DROP INDEX `idx_search`,
ADD INDEX `idx_search`(`enable`, `status`, `port`) USING BTREE;