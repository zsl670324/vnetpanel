TRUNCATE TABLE `rule`;
TRUNCATE TABLE `ss_node_rule`;

INSERT INTO `rule` (`id`, `type`, `pattern`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'reg', '(.+\\.|^)(360|so)\\.(cn|com)', '360相关', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
	(2, 'reg', '(Subject|HELO|SMTP)', '垃圾邮件', '2019-07-19 15:04:35', '2019-07-19 15:04:35'),
	(3, 'reg', 'BitTorrent protocol', 'BT协议', '2019-07-19 15:04:50', '2019-07-19 15:04:50'),
	(4, 'reg', '(api|ps|sv|offnavi|newvector|ulog\\.imap|newloc)(\\.map|)\\.(baidu|n\\.shifen)\\.com', '百度定位', '2019-07-19 15:05:06', '2019-07-19 15:05:06'),
	(5, 'reg', '(.*\\.||)(dafahao|minghui|dongtaiwang|epochtimes|ntdtv|falundafa|wujieliulan|zhengjian)\\.(org|com|net)', '反动网站', '2019-07-19 15:05:46', '2019-07-19 15:05:46'),
	(6, 'reg', '(torrent|\\.torrent|peer_id=|info_hash|get_peers|find_node|BitTorrent|announce_peer|announce\\.php\\?passkey=)', 'BT扩展名', '2019-07-19 15:06:07', '2019-07-19 15:06:07'),
	(7, 'reg', '(^.*\\@)(guerrillamail|guerrillamailblock|sharklasers|grr|pokemail|spam4|bccto|chacuo|027168)\\.(info|biz|com|de|net|org|me|la)', 'SPAM邮箱', '2019-07-19 15:06:20', '2019-07-19 15:06:20'),
	(8, 'reg', '(.?)(xunlei|sandai|Thunder|XLLiveUD)(.)', '迅雷下载', '2019-07-19 15:06:31', '2019-07-19 15:06:31');

-- 总流量、本月流量、今日流量
UPDATE `config` SET name='total_transfer',value='0' WHERE id=43;
UPDATE `config` SET name='month_transfer',value='0' WHERE id=44;
UPDATE `config` SET name='today_transfer',value='0' WHERE id=45;


-- 用户表增加联系电话
ALTER TABLE `user` ADD COLUMN `phone` char(20) NULL COMMENT '联系电话' AFTER `gender`;