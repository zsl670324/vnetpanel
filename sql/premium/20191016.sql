-- 节点加入限速字段（节点限速：如果用户限速大于节点限速，则用户速度会被限制在节点限制的速度）
ALTER TABLE `ss_node`
  ADD COLUMN `speed_limit` bigint(20) NOT NULL DEFAULT '0' COMMENT '节点限速，为0表示不限速，单位Byte' AFTER `level`;

-- 更新审计规则
TRUNCATE TABLE `rule`;

INSERT INTO `rule` (`id`, `type`, `name`, `pattern`, `created_at`, `updated_at`) VALUES
  (1, 'reg', '360', '(.*\.||)(^360|0360|1360|3600|360safe|^so|qhimg|qhmsg|^yunpan|qihoo|qhcdn|qhupdate|360totalsecurity|360shouji|qihucdn|360kan|secmp)\.(cn|com|net)', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
  (2, 'reg', '腾讯管家', '(\.guanjia\.qq\.com|qqpcmgr|QQPCMGR)', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
  (3, 'reg', '金山毒霸', '(.*\.||)(rising|kingsoft|duba|xindubawukong|jinshanduba)\.(com|net|org)', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
  (4, 'reg', '暗网相关', '(.*\.||)(netvigator|torproject)\.(cn|com|net|org)', '2019-07-19 15:04:11', '2019-07-19 15:04:11'),
  (5, 'reg', '百度定位', '(api|ps|sv|offnavi|newvector|ulog\\.imap|newloc|tracknavi)(\\.map|)\\.(baidu|n\\.shifen)\\.com', '2019-07-19 15:05:06', '2019-07-19 15:05:06'),
  (6, 'reg', '法轮功类', '(.*\\.||)(dafahao|minghui|dongtaiwang|dajiyuan|falundata|shenyun|tuidang|epochweekly|epochtimes|ntdtv|falundafa|wujieliulan|zhengjian)\\.(org|com|net)', '2019-07-19 15:05:46', '2019-07-19 15:05:46'),
  (7, 'reg', 'BT扩展名', '(torrent|\\.torrent|peer_id=|info_hash|get_peers|find_node|BitTorrent|announce_peer|announce\\.php\\?passkey=)', '2019-07-19 15:06:07', '2019-07-19 15:06:07'),
  (8, 'reg', '邮件滥发', '((^.*\@)(guerrillamail|guerrillamailblock|sharklasers|grr|pokemail|spam4|bccto|chacuo|027168)\.(info|biz|com|de|net|org|me|la)|Subject|HELO|SMTP)', '2019-07-19 15:06:20', '2019-07-19 15:06:20'),
  (9, 'reg', '迅雷下载', '(.?)(xunlei|sandai|Thunder|XLLiveUD)(.)', '2019-07-19 15:06:31', '2019-07-19 15:06:31'),
  (10, 'reg', '大陆应用', '(.*\\.||)(qq|163|sohu|sogoucdn|sogou|uc|58|taobao)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (11, 'reg', '大陆银行', '(.*\\.||)(icbc|ccb|boc|bankcomm|abchina|cmbchina|psbc|cebbank|cmbc|pingan|spdb|citicbank|cib|hxb|bankofbeijing|hsbank|tccb|4001961200|bosc|hkbchina|njcb|nbcb|lj-bank|bjrcb|jsbchina|gzcb|cqcbank|czbank|hzbank|srcb|cbhb|cqrcb|grcbank|qdccb|bocd|hrbcb|jlbank|bankofdl|qlbchina|dongguanbank|cscb|hebbank|drcbank|zzbank|bsb|xmccb|hljrcc|jxnxs|gsrcu|fjnx|sxnxs|gx966888|gx966888|zj96596|hnnxs|ahrcu|shanxinj|hainanbank|scrcu|gdrcu|hbxh|ynrcc|lnrcc|nmgnxs|hebnx|jlnls|js96008|hnnx|sdnxs)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (12, 'reg', '台湾银行', '(.*\\.||)(firstbank|bot|cotabank|megabank|tcb-bank|landbank|hncb|bankchb|tbb|ktb|tcbbank|scsb|bop|sunnybank|kgibank|fubon|ctbcbank|cathaybk|eximbank|bok|ubot|feib|yuantabank|sinopac|esunbank|taishinbank|jihsunbank|entiebank|hwataibank|csc|skbank)\\.(org|com|net|tw)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (13, 'reg', '大陆第三方支付', '(.*\\.||)(alipay|baifubao|yeepay|99bill|95516|51credit|cmpay|tenpay|lakala|jdpay)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (14, 'reg', '台湾特供', '(.*\.||)(visa|mycard|mastercard|gov|gash|beanfun|bank|line)\.(org|com|net|cn|tw|jp|kr)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (15, 'reg', '涉政治类', '(.*\\.||)(shenzhoufilm|secretchina|renminbao|aboluowang|mhradio|guangming|zhengwunet|soundofhope|yuanming|zhuichaguoji|fgmtv|xinsheng|shenyunperformingarts|epochweekly|tuidang|shenyun|falundata|bannedbook)\\.(org|com|net)', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


-- 审计规则分组
CREATE TABLE `rule_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '1' COMMENT '模式：1-阻断、2-仅放行',
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `rules` text COMMENT '关联的规则ID，多个用,号分隔',
  `nodes` text COMMENT '关联的节点ID，多个用,号分隔',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则分组';

-- 加一个默认的审计规则分组
INSERT INTO `rule_group` (`id`, `type`, `name`, `rules`, `nodes`, `created_at`, `updated_at`) VALUES
(1, 1, '默认', '1,2,3,4,5,6,7,8,9,10,11,12,13,14', NULL, '2019-10-26 15:29:48', '2019-10-26 15:29:48');


-- 移除随机订阅，增加订阅时默认节点
UPDATE `config` SET name = 'subscribe_default_node', value='0' WHERE id = 74;

-- 节点级的设备数量限制
ALTER TABLE `ss_node`
  ADD COLUMN `client_limit` int(0) NOT NULL DEFAULT 0 COMMENT '设备数限制' AFTER `speed_limit`;

-- 删除ss_node_rule表
DROP TABLE `ss_node_rule`;

-- 创建规则分组节点关联表
CREATE TABLE `rule_group_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_group_id` int(11) DEFAULT '0' COMMENT '规则分组ID',
  `node_id` int(11) DEFAULT '0' COMMENT '节点ID',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则分组节点关联表';
