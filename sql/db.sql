# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.18)
# Database: 2
# Generation Time: 2017-07-29 06:28:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- ----------------------------
-- Table structure for `node`
-- ----------------------------
CREATE TABLE `node` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '服务类型：1-VNet、2-V2ray、3-Trojan',
  `level` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '等级：0-无等级，全部可见',
  `speed_limit` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '节点限速，为0表示不限速，单位Byte',
  `client_limit` INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '设备数限制',
  `name` VARCHAR(128) NOT NULL DEFAULT '' COMMENT '名称',
  `group_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '所属分组',
  `country_code` CHAR(5) NOT NULL DEFAULT 'un' COMMENT '国家代码',
  `server` VARCHAR(255) NULL DEFAULT '' COMMENT '服务器域名地址',
  `ip` CHAR(15) NULL DEFAULT '' COMMENT '服务器IPV4地址',
  `ipv6` CHAR(128) NULL DEFAULT '' COMMENT '服务器IPV6地址',
  `relay_server` VARCHAR(255) NULL DEFAULT NULL COMMENT '中转地址',
  `relay_port` SMALLINT(5) UNSIGNED NULL DEFAULT 0 COMMENT '中转端口',
  `description` VARCHAR(255) NULL DEFAULT '' COMMENT '节点简单描述',
  `method` VARCHAR(32) NOT NULL DEFAULT 'aes-256-cfb' COMMENT '加密方式',
  `protocol` VARCHAR(64) NOT NULL DEFAULT 'origin' COMMENT '协议',
  `obfs` VARCHAR(64) NOT NULL DEFAULT 'plain' COMMENT '混淆',
  `obfs_param` VARCHAR(255) NULL DEFAULT '' COMMENT '混淆参数',
  `traffic_rate` FLOAT(12) NOT NULL DEFAULT '1.00' COMMENT '流量比率',
  `is_subscribe` TINYINT(3) UNSIGNED NULL DEFAULT '1' COMMENT '是否允许用户订阅该节点：0-否、1-是',
  `is_tcp_check` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否开启检测: 0-不开启、1-开启',
  `is_udp` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '是否启用UDP：0-不启用、1-启用',
  `is_relay` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否中转节点：0-否、1-是',
  `is_dynamic` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否动态IP：0-否、1-是',
  `is_bt` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否启用宝塔API：0-否、1-是',
  `bt_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '8888' COMMENT '宝塔访问端口',
  `bt_key` VARCHAR(50) NULL DEFAULT '' COMMENT '宝塔API密钥',
  `single` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '启用单端口功能：0-否、1-是',
  `port` VARCHAR(50) NULL DEFAULT NULL COMMENT '单端口的端口号',
  `passwd` VARCHAR(255) NULL DEFAULT NULL COMMENT '单端口的连接密码',
  `push_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '消息推送端口',
  `sort` INT(11) NOT NULL DEFAULT '0' COMMENT '排序值，值越大越靠前显示',
  `status` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态：0-维护、1-正常',
  `v2_alter_id` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '16' COMMENT 'V2Ray额外ID',
  `v2_connect_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '443' COMMENT 'V2Ray连接端口',
  `v2_port` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'V2Ray服务端口',
  `v2_method` VARCHAR(32) NOT NULL DEFAULT 'aes-128-gcm' COMMENT 'V2Ray加密方式',
  `v2_net` VARCHAR(16) NOT NULL DEFAULT 'tcp' COMMENT 'V2Ray传输协议',
  `v2_type` VARCHAR(32) NOT NULL DEFAULT 'none' COMMENT 'V2Ray伪装类型',
  `v2_host` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'V2Ray伪装的域名',
  `v2_path` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'V2Ray的WS/H2路径',
  `v2_connect_tls` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'V2Ray连接TLS：0-未开启、1-开启',
  `v2_tls` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'V2Ray后端TLS：0-未开启、1-开启',
  `tls_provider` TEXT NULL DEFAULT NULL COMMENT 'V2Ray节点的TLS提供商授权信息',
  `trojan_port` SMALLINT(6) NOT NULL DEFAULT '443' COMMENT 'Trojan连接端口',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_group` (`group_id`),
  INDEX `idx_sub` (`is_subscribe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点信息表';


-- ----------------------------
-- Table structure for `node_heartbeat`
-- ----------------------------
CREATE TABLE `node_heartbeat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `uptime` int(10) unsigned NOT NULL COMMENT '后端存活时长，单位秒',
  `load` varchar(255) NOT NULL COMMENT '负载',
  `log_time` int(10) unsigned NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`),
  INDEX `idx_node_id` (`node_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点心跳信息';


-- ----------------------------
-- Table structure for `node_online_log`
-- ----------------------------
CREATE TABLE `node_online_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL COMMENT '节点ID',
  `online_user` int(10) unsigned NOT NULL COMMENT '在线用户数',
  `log_time` int(10) unsigned NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`),
  INDEX `idx_node_id` (`node_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点在线信息';


-- ----------------------------
-- Table structure for `node_label`
-- ----------------------------
CREATE TABLE `node_label` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `label_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '标签ID',
  PRIMARY KEY (`id`),
  INDEX `idx_node_label` (`node_id`,`label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点标签';


-- ----------------------------
-- Table structure for `user`
-- ----------------------------
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(64) NOT NULL DEFAULT '',
  `code` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '唯一码',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `port` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理端口',
  `passwd` varchar(32) NOT NULL DEFAULT '' COMMENT '代理密码',
  `transfer_enable` bigint(20) UNSIGNED NOT NULL DEFAULT '1099511627776' COMMENT '可用流量，单位字节，默认1TiB',
  `u` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '已上传流量，单位字节',
  `d` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '已下载流量，单位字节',
  `t` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后使用时间',
  `ip` char(128) DEFAULT NULL COMMENT '最后连接IP',
  `enable` tinyint(4) NOT NULL DEFAULT '1' COMMENT '代理状态',
  `method` varchar(30) NOT NULL DEFAULT 'aes-256-cfb' COMMENT '加密方式',
  `protocol` varchar(30) NOT NULL DEFAULT 'origin' COMMENT '协议',
  `obfs` varchar(30) NOT NULL DEFAULT 'plain' COMMENT '混淆',
  `obfs_param` varchar(255) DEFAULT '' COMMENT '混淆参数',
  `speed_limit` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户限速，为0表示不限速，单位Byte',
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别：0-女、1-男',
  `phone` char(20) NULL COMMENT '联系电话',
  `address` varchar(255) NULL COMMENT '联系地址',
  `wechat` varchar(30) DEFAULT '' COMMENT '微信',
  `qq` varchar(20) DEFAULT '' COMMENT 'QQ',
  `usage` VARCHAR(10) NOT NULL DEFAULT '4' COMMENT '用途：1-手机、2-电脑、3-路由器、4-其他',
  `pay_way` tinyint(4) NOT NULL DEFAULT '0' COMMENT '付费方式：0-免费、1-季付、2-月付、3-半年付、4-年付',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '余额，单位分',
  `enable_time` date DEFAULT NULL COMMENT '开通日期',
  `expire_time` date NOT NULL DEFAULT '2099-01-01' COMMENT '过期时间',
  `ban_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封禁到期时间',
  `remark` text COMMENT '备注',
  `group_id` int(10) unsigned DEFAULT '0' COMMENT '所属分组ID',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '等级，默认0级，最高9级',
  `reg_ip` char(128) NOT NULL DEFAULT '127.0.0.1' COMMENT '注册IP',
  `last_login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `referral_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邀请人',
  `invite_qty` INT NOT NULL DEFAULT '0' COMMENT '可生成邀请码数',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：-1-禁用、0-未激活、1-正常',
  `remember_token` varchar(256) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unq_username` (`username`),
  INDEX `idx_search` (`enable`, `status`, `port`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';


-- ----------------------------
-- Table structure for `user_persona`
-- ----------------------------
CREATE TABLE `user_persona` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户ID',
	`ip` CHAR(128) NOT NULL DEFAULT '' COMMENT '连接IP',
	`country` CHAR(64) NOT NULL DEFAULT '',
	`province` CHAR(64) NOT NULL DEFAULT '',
	`city` CHAR(128) NOT NULL DEFAULT '',
	`county` CHAR(128) NOT NULL DEFAULT '',
	`created_at` DATETIME(0) NOT NULL,
	`updated_at` DATETIME(0) NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='用户画像';


-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
CREATE TABLE `user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `nodes` text COMMENT '关联的节点ID，多个用,号分隔',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户分组控制表';


-- ----------------------------
-- Table structure for `user_traffic_log`
-- ----------------------------
CREATE TABLE `user_traffic_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `u` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传流量',
  `d` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载流量',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `rate` float NOT NULL COMMENT '倍率',
  `traffic` varchar(32) NOT NULL COMMENT '产生流量',
  `log_time` int(10) unsigned NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`id`),
  INDEX `idx_user_node_time` (`user_id`, `node_id`, `log_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户流量日志';


-- ----------------------------
-- Table structure for `user_subscribe_ex`
-- ----------------------------
CREATE TABLE `user_subscribe_ex` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL DEFAULT '0',
	`before` CHAR(8) NULL DEFAULT NULL,
	`after` CHAR(8) NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='用户订阅变更记录';


-- ----------------------------
-- Table structure for `encrypt`
-- ----------------------------
DROP TABLE IF EXISTS `encrypt`;
CREATE TABLE `encrypt` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '配置名' COLLATE 'utf8mb4_unicode_ci',
  `type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '类型：1-加密方式、2-协议、3-混淆',
  `is_default` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否默认：0-不是、1-是',
  `sort` INT(11) NOT NULL DEFAULT '0' COMMENT '排序：值越大排越前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='通用配置';

-- ----------------------------
-- Records of `ss_config`
-- ----------------------------
INSERT INTO `encrypt` VALUES ('1', 'none', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('2', 'bf-cfb', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('3', 'chacha20', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('4', 'chacha20-ietf', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('5', 'aes-128-cfb', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('6', 'aes-192-cfb', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('7', 'aes-256-cfb', '1', '1', '0');
INSERT INTO `encrypt` VALUES ('8', 'aes-128-ctr', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('9', 'aes-192-ctr', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('10', 'aes-256-ctr', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('11', 'cast5-cfb', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('12', 'des-cfb', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('13', 'rc4-md5', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('14', 'salsa20', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('15', 'aes-128-gcm', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('16', 'aes-192-gcm', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('17', 'aes-256-gcm', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('18', 'chacha20-ietf-poly1305', '1', '0', '0');
INSERT INTO `encrypt` VALUES ('19', 'origin', '2', '1', '0');
INSERT INTO `encrypt` VALUES ('20', 'auth_aes128_md5', '2', '0', '0');
INSERT INTO `encrypt` VALUES ('21', 'auth_aes128_sha1', '2', '0', '0');
INSERT INTO `encrypt` VALUES ('22', 'auth_chain_a', '2', '0', '0');
INSERT INTO `encrypt` VALUES ('23', 'plain', '3', '1', '0');
INSERT INTO `encrypt` VALUES ('24', 'http_simple', '3', '0', '0');
INSERT INTO `encrypt` VALUES ('25', 'tls1.2_ticket_auth', '3', '0', '0');


-- ----------------------------
-- Table structure for `config`
-- ----------------------------
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '配置名',
  `value` TEXT NULL COMMENT '配置值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置';


-- ----------------------------
-- Records of `config`
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'is_rand_port', 0);
INSERT INTO `config` VALUES ('2', 'v2ray_license', '');
INSERT INTO `config` VALUES ('3', 'invite_qty', 0);
INSERT INTO `config` VALUES ('4', 'is_register', 1);
INSERT INTO `config` VALUES ('5', 'is_invite_register', 2);
INSERT INTO `config` VALUES ('6', 'website_name', 'VNetPanel');
INSERT INTO `config` VALUES ('7', 'is_reset_password', 1);
INSERT INTO `config` VALUES ('8', 'reset_password_times', 3);
INSERT INTO `config` VALUES ('9', 'website_url', 'https://www.vnetpanel.com');
INSERT INTO `config` VALUES ('10', 'is_active_register', 1);
INSERT INTO `config` VALUES ('11', 'active_times', 3);
INSERT INTO `config` VALUES ('12', 'is_checkin', 1);
INSERT INTO `config` VALUES ('13', 'min_rand_traffic', 10);
INSERT INTO `config` VALUES ('14', 'max_rand_traffic', 500);
INSERT INTO `config` VALUES ('15', 'default_speed_limit', 0);
INSERT INTO `config` VALUES ('16', 'is_show_subscribe_level', 0);
INSERT INTO `config` VALUES ('17', 'traffic_limit_time', 1440);
INSERT INTO `config` VALUES ('18', 'v2ray_tls_provider', '');
INSERT INTO `config` VALUES ('19', 'referral_percent', 0.2);
INSERT INTO `config` VALUES ('20', 'referral_money', 100);
INSERT INTO `config` VALUES ('21', 'referral_status', 1);
INSERT INTO `config` VALUES ('22', 'default_traffic', 1024);
INSERT INTO `config` VALUES ('23', 'traffic_warning', 0);
INSERT INTO `config` VALUES ('24', 'traffic_warning_percent', 80);
INSERT INTO `config` VALUES ('25', 'expire_warning', 0);
INSERT INTO `config` VALUES ('26', 'expire_days', 15);
INSERT INTO `config` VALUES ('27', 'vnet_license', '');
INSERT INTO `config` VALUES ('28', 'default_days', 7);
INSERT INTO `config` VALUES ('29', 'huge_traffic_threshold', 500);
INSERT INTO `config` VALUES ('30', 'min_port', 10000);
INSERT INTO `config` VALUES ('31', 'max_port', 20000);
INSERT INTO `config` VALUES ('32', 'is_captcha', 1);
INSERT INTO `config` VALUES ('33', 'is_traffic_ban', 1);
INSERT INTO `config` VALUES ('34', 'traffic_ban_value', 10);
INSERT INTO `config` VALUES ('35', 'traffic_ban_time', 60);
INSERT INTO `config` VALUES ('36', 'referral_type', 1);
INSERT INTO `config` VALUES ('37', 'is_node_crash_warning', 0);
INSERT INTO `config` VALUES ('38', 'webmaster_email', '');
INSERT INTO `config` VALUES ('39', 'is_server_chan', 0);
INSERT INTO `config` VALUES ('40', 'server_chan_key', '');
INSERT INTO `config` VALUES ('41', 'is_subscribe_ban', 1);
INSERT INTO `config` VALUES ('42', 'subscribe_ban_times', 20);
INSERT INTO `config` VALUES ('43', 'total_transfer', 0);
INSERT INTO `config` VALUES ('44', 'month_transfer', 0);
INSERT INTO `config` VALUES ('45', 'today_transfer', 0);
INSERT INTO `config` VALUES ('46', 'is_free_code', 1);
INSERT INTO `config` VALUES ('47', 'is_forbid_robot', 1);
INSERT INTO `config` VALUES ('48', 'subscribe_domain', '');
INSERT INTO `config` VALUES ('49', 'auto_release_port', 0);
INSERT INTO `config` VALUES ('50', 'payment_gateway', 0);
INSERT INTO `config` VALUES ('51', 'codepay_url', 'http://api2.xiuxiu888.com/creat_order/?');
INSERT INTO `config` VALUES ('52', 'codepay_id', '');
INSERT INTO `config` VALUES ('53', 'codepay_key', '');
INSERT INTO `config` VALUES ('54', 'is_register_type', 2);
INSERT INTO `config` VALUES ('55', 'website_analytics', '');
INSERT INTO `config` VALUES ('56', 'website_customer_service', '');
INSERT INTO `config` VALUES ('57', 'register_ip_limit', 5);
INSERT INTO `config` VALUES ('58', 'website_callback_url', '');
INSERT INTO `config` VALUES ('59', 'is_telegram', 0);
INSERT INTO `config` VALUES ('60', 'telegram_token', '');
INSERT INTO `config` VALUES ('61', 'telegram_chatid', '');
INSERT INTO `config` VALUES ('62', 'is_ban_status', 0);
INSERT INTO `config` VALUES ('63', 'is_namesilo', 0);
INSERT INTO `config` VALUES ('64', 'namesilo_key', '');
INSERT INTO `config` VALUES ('65', 'website_logo', '');
INSERT INTO `config` VALUES ('66', 'website_home_logo', '');
INSERT INTO `config` VALUES ('67', 'is_tcp_check', 0);
INSERT INTO `config` VALUES ('68', 'tcp_check_warning_times', 3);
INSERT INTO `config` VALUES ('69', 'is_forbid_china', 0);
INSERT INTO `config` VALUES ('70', 'is_forbid_oversea', 0);
INSERT INTO `config` VALUES ('71', 'is_verify_register', 0);
INSERT INTO `config` VALUES ('72', 'node_daily_report', 1);
INSERT INTO `config` VALUES ('73', 'prior_node_type', 1);
INSERT INTO `config` VALUES ('74', 'subscribe_default_node', 0);
INSERT INTO `config` VALUES ('75', 'is_show_subscribe_expire', 0);
INSERT INTO `config` VALUES ('76', 'node_crash_warning_times', 10);
INSERT INTO `config` VALUES ('77', 'shengkai_url', 'https://v.0599.pro');
INSERT INTO `config` VALUES ('78', 'shengkai_mch_id', '');
INSERT INTO `config` VALUES ('79', 'shengkai_key', '');
INSERT INTO `config` VALUES ('80', 'mugglepay_url', 'https://api.mugglepay.com/v1');
INSERT INTO `config` VALUES ('81', 'mugglepay_secret', '');
INSERT INTO `config` VALUES ('82', 'payjs_mch_id', '');
INSERT INTO `config` VALUES ('83', 'payjs_key', '');
INSERT INTO `config` VALUES ('84', 'is_show_subscribe_traffic', 0);
INSERT INTO `config` VALUES ('85', 'f2fpay_app_id', '');
INSERT INTO `config` VALUES ('86', 'f2fpay_private_key', '');
INSERT INTO `config` VALUES ('87', 'f2fpay_public_key', '');
INSERT INTO `config` VALUES ('88', 'show_user_invite', 1);
INSERT INTO `config` VALUES ('89', 'website_security_code', '');
INSERT INTO `config` VALUES ('90', 'geetest_id', '');
INSERT INTO `config` VALUES ('91', 'geetest_key', '');
INSERT INTO `config` VALUES ('92', 'google_captcha_sitekey', '');
INSERT INTO `config` VALUES ('93', 'google_captcha_secret', '');
INSERT INTO `config` VALUES ('94', 'user_invite_days', 7);
INSERT INTO `config` VALUES ('95', 'admin_invite_days', 7);
INSERT INTO `config` VALUES ('96', 'is_bark', 0);
INSERT INTO `config` VALUES ('97', 'bark_device', '');
INSERT INTO `config` VALUES ('98', 'subscribe_custom_words', '');
INSERT INTO `config` VALUES ('99', 'epay_url', '');
INSERT INTO `config` VALUES ('100', 'epay_mch_id', '');
INSERT INTO `config` VALUES ('101', 'epay_key', '');
INSERT INTO `config` VALUES ('102', 'trojan_license', '');
INSERT INTO `config` VALUES ('103', 'hcaptcha_secret', '');
INSERT INTO `config` VALUES ('104', 'hcaptcha_sitekey', '');


-- ----------------------------
-- Table structure for `article`
-- ----------------------------
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '1' COMMENT '类型：1-文章、2-站内公告、3-站外公告',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(50) DEFAULT '' COMMENT '作者',
  `summary` varchar(255) DEFAULT '' COMMENT '简介',
  `logo` varchar(255) DEFAULT '' COMMENT 'LOGO',
  `content` text COMMENT '内容',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `deleted_at` datetime NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章';


-- ----------------------------
-- Table structure for `invite`
-- ----------------------------
CREATE TABLE `invite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邀请人ID',
  `fuid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '受邀人ID',
  `code` char(32) NOT NULL COMMENT '邀请码',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '邀请码状态：0-未使用、1-已使用、2-已过期',
  `dateline` datetime DEFAULT NULL COMMENT '有效期至',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='邀请码表';


-- ----------------------------
-- Table structure for `label`
-- ----------------------------
CREATE TABLE `label` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='标签';


-- ----------------------------
-- Records of label
-- ----------------------------
INSERT INTO `label` VALUES (1, 'Netflix', 0);
INSERT INTO `label` VALUES (2, 'Hulu', 0);
INSERT INTO `label` VALUES (3, 'HBO', 0);
INSERT INTO `label` VALUES (4, 'Amazon Video', 0);
INSERT INTO `label` VALUES (5, 'DisneyNow', 0);
INSERT INTO `label` VALUES (6, 'BBC', 0);
INSERT INTO `label` VALUES (7, 'Channel 4', 0);
INSERT INTO `label` VALUES (8, 'Fox+', 0);
INSERT INTO `label` VALUES (9, 'Happyon', 0);
INSERT INTO `label` VALUES (10, 'AbemeTV', 0);
INSERT INTO `label` VALUES (11, 'DMM', 0);
INSERT INTO `label` VALUES (12, 'Niconico', 0);
INSERT INTO `label` VALUES (13, 'DAZN', 0);
INSERT INTO `label` VALUES (14, 'pixiv', 0);
INSERT INTO `label` VALUES (15, 'TVer', 0);
INSERT INTO `label` VALUES (16, 'TVB', 0);
INSERT INTO `label` VALUES (17, 'HBO Go', 0);
INSERT INTO `label` VALUES (18, 'Bilibili 港澳台', 0);
INSERT INTO `label` VALUES (19, 'Viu', 0);
INSERT INTO `label` VALUES (20, '動畫瘋', 0);
INSERT INTO `label` VALUES (21, '四季線上影視', 0);
INSERT INTO `label` VALUES (22, 'LINE TV', 0);
INSERT INTO `label` VALUES (23, 'Youtube Premium', 0);
INSERT INTO `label` VALUES (24, '优酷', 0);
INSERT INTO `label` VALUES (25, '爱奇艺', 0);
INSERT INTO `label` VALUES (26, '腾讯视频', 0);
INSERT INTO `label` VALUES (27, '搜狐视频', 0);
INSERT INTO `label` VALUES (28, 'PP视频', 0);
INSERT INTO `label` VALUES (29, '凤凰视频', 0);
INSERT INTO `label` VALUES (30, '百度视频', 0);
INSERT INTO `label` VALUES (31, '芒果TV', 0);
INSERT INTO `label` VALUES (32, '土豆网', 0);
INSERT INTO `label` VALUES (33, '哔哩哔哩', 0);
INSERT INTO `label` VALUES (34, '网易云音乐', 0);
INSERT INTO `label` VALUES (35, 'Bahamut', 0);
INSERT INTO `label` VALUES (36, 'Deezer', 0);
INSERT INTO `label` VALUES (37, 'DisneyPlus', 0);
INSERT INTO `label` VALUES (38, 'HWTV', 0);
INSERT INTO `label` VALUES (39, 'ITV', 0);
INSERT INTO `label` VALUES (40, 'JOOX', 0);
INSERT INTO `label` VALUES (41, 'KKBOX', 0);
INSERT INTO `label` VALUES (42, 'KKTV', 0);
INSERT INTO `label` VALUES (43, 'LiTV', 0);
INSERT INTO `label` VALUES (44, 'My5', 0);
INSERT INTO `label` VALUES (45, 'PBS', 0);
INSERT INTO `label` VALUES (46, 'Pandora', 0);
INSERT INTO `label` VALUES (47, 'SoundCloud', 0);
INSERT INTO `label` VALUES (48, 'Spotify', 0);
INSERT INTO `label` VALUES (49, 'TIDAL', 0);
INSERT INTO `label` VALUES (50, 'TaiWanGood', 0);
INSERT INTO `label` VALUES (51, 'TikTok', 0);
INSERT INTO `label` VALUES (52, 'Pornhub', 0);
INSERT INTO `label` VALUES (53, 'Twitch', 0);
INSERT INTO `label` VALUES (54, 'ViuTV', 0);
INSERT INTO `label` VALUES (55, 'encoreTVB', 0);
INSERT INTO `label` VALUES (56, 'myTV_SUPER', 0);
INSERT INTO `label` VALUES (57, 'niconico', 0);
INSERT INTO `label` VALUES (58, 'QQ音乐', 0);


-- ----------------------------
-- Table structure for `verify`
-- ----------------------------
CREATE TABLE `verify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` TINYINT NOT NULL DEFAULT '1' COMMENT '激活类型：1-自行激活、2-管理员激活',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `token` varchar(32) NOT NULL COMMENT '校验token',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：0-未使用、1-已使用、2-已失效',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='账号激活邮件地址';


-- ----------------------------
-- Table structure for `verify_code`
-- ----------------------------
CREATE TABLE `verify_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL COMMENT '用户邮箱',
  `code` char(6) NOT NULL COMMENT '验证码',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：0-未使用、1-已使用、2-已失效',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='注册激活验证码';


-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分组名称',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点分组';


-- ----------------------------
-- Table structure for `group_node`
-- ----------------------------
CREATE TABLE `group_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分组ID',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分组节点关系表';


-- ----------------------------
-- Table structure for `coupon`
-- ----------------------------
CREATE TABLE `coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '优惠券名称',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '优惠券LOGO',
  `sn` char(8) NOT NULL DEFAULT '' COMMENT '优惠券码',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型：1-抵用券、2-折扣券、3-充值券、4-满减券',
  `usage` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用途：1-仅限一次性使用、2-可重复使用',
  `match_amount` bigint(20) NOT NULL DEFAULT '0' COMMENT '满减要求的金额，单位分',
  `amount` bigint(20) NOT NULL DEFAULT '0' COMMENT '抵用或充值或满减的金额，单位分',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '折扣',
  `available_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效期开始',
  `available_end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '有效期结束',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：0-未使用、1-已使用、2-已失效',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `deleted_at` datetime NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='优惠券';


-- ----------------------------
-- Table structure for `coupon_log`
-- ----------------------------
CREATE TABLE `coupon_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '优惠券ID',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '产品ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `description` varchar(50) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='优惠券使用日志';


-- ----------------------------
-- Table structure for `products`
-- ----------------------------
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '产品名称',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `traffic` bigint(20) unsigned NOT NULL DEFAULT 0 COMMENT '内含多少流量，单位MiB',
  `level` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '购买后给用户授权的等级',
  `speed` bigint(20) NOT NULL DEFAULT -1 COMMENT '购买后限速，单位字节，默认-1不改变用户现有速率',
  `invite_qty` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '赠送邀请码数',
  `limit_qty` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '限购数量，0不限购',
  `monthly` int(10) unsigned DEFAULT 0 COMMENT '月付金额',
  `quarterly` int(10) unsigned DEFAULT 0 COMMENT '季付金额',
  `semiannual` int(10) unsigned DEFAULT 0 COMMENT '半年付金额',
  `annual` int(10) unsigned DEFAULT 0 COMMENT '年付金额',
  `biennial` int(10) unsigned DEFAULT 0 COMMENT '两年付金额',
  `triennial` int(10) unsigned DEFAULT 0 COMMENT '三年付金额',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `hot` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '是否热销：0-否、1-是',
  `fake` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '提交订单时是否使用假名：0-否、1-是',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '状态：0-下架、1-上架',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='产品表';


-- ----------------------------
-- Table structure for `products_pool`
-- ----------------------------
CREATE TABLE `products_pool` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '状态：0-未启用、1-已启用',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='产品名称池';


-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
CREATE TABLE `orders` (
  `oid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '操作人',
  `product_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '商品ID',
  `coupon_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '优惠券ID',
  `cycle` varchar(20) DEFAULT NULL COMMENT '计费周期',
  `payment_id` int(10) unsigned DEFAULT NULL COMMENT '支付单ID',
  `payment_gateway` varchar(20) DEFAULT NULL COMMENT '支付网关',
  `payment_method` varchar(20) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `subtotal` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '小计金额，单位分',
  `credit` int(10) unsigned NOT NULL COMMENT '使用多少余额，单位分',
  `amount` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '实际总金额，单位分',
  `ip` varchar(128) DEFAULT NULL COMMENT '下单时IP地址',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '订单状态：-1-已失效、0-未支付、1-已支付',
  `bill_at` DATETIME NULL DEFAULT NULL COMMENT '下次账单出现时间',
  `reset_at` DATETIME NULL DEFAULT NULL COMMENT '下次流量重置时间',
  `paid_at` DATETIME DEFAULT NULL COMMENT '支付时间',
  `created_at` DATETIME DEFAULT NULL COMMENT '创建时间',
  `updated_at` DATETIME DEFAULT NULL COMMENT '最后一次更新时间',
  PRIMARY KEY (`oid`) USING BTREE,
  KEY `idx_order_search` (`user_id`,`product_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单表';


-- ----------------------------
-- Table structure for `ticket`
-- ----------------------------
CREATE TABLE `ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `master_id` int(10) unsigned DEFAULT '0' COMMENT '发起工单的管理员ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：0-待处理、1-已处理未关闭、2-已关闭',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='工单';


-- ----------------------------
-- Table structure for `ticket_reply`
-- ----------------------------
CREATE TABLE `ticket_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '工单ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复用户的ID',
  `master_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '回复管理员的ID',
  `content` text NOT NULL COMMENT '回复内容',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='工单回复';


-- ----------------------------
-- Table structure for `user_credit_log`
-- ----------------------------
CREATE TABLE `user_credit_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '账号ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `before` int(11) NOT NULL DEFAULT '0' COMMENT '发生前余额，单位分',
  `after` int(11) NOT NULL DEFAULT '0' COMMENT '发生后金额，单位分',
  `amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发生金额，单位分',
  `description` varchar(255) DEFAULT '' COMMENT '操作描述',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户余额变动日志';


-- ----------------------------
-- Table structure for `user_traffic_modify_log`
-- ----------------------------
CREATE TABLE `user_traffic_modify_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发生的订单ID',
  `before` bigint(20) NOT NULL DEFAULT '0' COMMENT '操作前流量',
  `after` bigint(20) NOT NULL DEFAULT '0' COMMENT '操作后流量',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户流量变动日志';


-- ----------------------------
-- Table structure for `referral_apply`
-- ----------------------------
CREATE TABLE `referral_apply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `before` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作前可提现金额，单位分',
  `after` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作后可提现金额，单位分',
  `amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '本次提现金额，单位分',
  `link_logs` text NOT NULL DEFAULT '' COMMENT '关联返利日志ID，例如：1,3,4',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：-1-驳回、0-待审核、1-审核通过待打款、2-已打款',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='提现申请';


-- ----------------------------
-- Table structure for `referral_log`
-- ----------------------------
CREATE TABLE `referral_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `ref_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推广人ID',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联订单ID',
  `amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '消费金额，单位分',
  `ref_amount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '返利金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：0-未提现、1-审核中、2-已提现',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消费返利日志';


-- ----------------------------
-- Table structure for `email_log`
-- ----------------------------
CREATE TABLE `email_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '类型：1-邮件、2-ServerChan、3-Bark、4-Telegram',
  `code` CHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '消息对外可见的唯一识别码',
  `address` VARCHAR(255) NOT NULL COMMENT '收信地址',
  `title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` TEXT NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：-1发送失败、0-等待发送、1-发送成功',
  `error` text COMMENT '发送失败抛出的异常信息',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='邮件投递记录';


-- ----------------------------
-- Table structure for `sensitive_words`
-- ----------------------------
CREATE TABLE `sensitive_words` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '类型：1-黑名单、2-白名单',
  `words` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '敏感词',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='敏感词';


-- ----------------------------
-- Records of `sensitive_words`
-- ----------------------------
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'chacuo.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'chacuo.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '1766258.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '3202.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '4057.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '4059.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'a7996.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'bccto.me');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'bnuis.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'chaichuang.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'cr219.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'cuirushi.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'dawin.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'jiaxin8736.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'lakqs.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'urltc.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '027168.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '10minutemail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '11163.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '1shivom.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'auoie.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'bareed.ws');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'bit-degree.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'cjpeg.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'cool.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'courriel.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'disbox.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'disbox.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'fidelium10.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'get365.pw');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'ggr.la');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'grr.la');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.biz');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.de');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamailblock.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'hubii-network.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'hurify1.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'itoup.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'jetable.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'jnpayy.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'juyouxi.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mail.bccto.me');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'www.bccto.me');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mega.zik.dj');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'moakt.co');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'moakt.ws');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'molms.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'moncourrier.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'monemail.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'monmail.fr.nf');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'nomail.xl.cx');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'nospam.ze.tc');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'pay-mon.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'poly-swarm.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'sgmh.online');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'sharklasers.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'shiftrpg.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'spam4.me');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'speed.1s.fr');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tmail.ws');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tmails.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tmpmail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tmpmail.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'travala10.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'yopmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'yopmail.fr');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'yopmail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'yuoia.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'zep-hyr.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'zippiex.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'lrc8.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '1otc.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'emailna.co');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mailinator.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'nbzmr.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'awsoo.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'zhcne.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '0box.eu');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'contbay.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'damnthespam.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'kurzepost.de');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'objectmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'proxymail.eu');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'rcpt.at');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trash-mail.at');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashmail.at');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashmail.io');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashmail.me');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashmail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'wegwerfmail.de');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'wegwerfmail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'wegwerfmail.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'nwytg.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'despam.it');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'spambox.us');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'spam.la');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mytrashmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mt2014.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mt2015.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'thankyou2010.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trash2009.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mt2009.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'trashymail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tempemail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'slopsbox.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mailnesia.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'ezehe.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'tempail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'newairmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'temp-mail.org');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'linshiyouxiang.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'zwoho.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'mailboxy.fun');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'crypto-net.club');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'guerrillamail.info');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'pokemail.net');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'odmail.cn');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'hlooy.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'ozlaq.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', '666email.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'linshiyou.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'linshiyou.pl');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'woyao.pl');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('1', 'yaowo.pl');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', 'qq.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', '163.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', '126.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', '189.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', 'sohu.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', 'gmail.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', 'outlook.com');
INSERT INTO `sensitive_words` (`type`, `words`) VALUES ('2', 'icloud.com');


-- ----------------------------
-- Table structure for `user_subscribe`
-- ----------------------------
CREATE TABLE `user_subscribe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `code` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '' COMMENT '订阅地址唯一识别码',
  `times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '地址请求次数',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：0-禁用、1-启用',
  `ban_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封禁时间',
  `ban_desc` varchar(50) NOT NULL DEFAULT '' COMMENT '封禁理由',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id`, `status`),
  INDEX `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户订阅';


-- ----------------------------
-- Table structure for `user_subscribe_log`
-- ----------------------------
CREATE TABLE `user_subscribe_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned DEFAULT NULL COMMENT '对应user_subscribe的id',
  `request_ip` char(128) DEFAULT NULL COMMENT '请求IP',
  `request_time` datetime DEFAULT NULL COMMENT '请求时间',
  `request_header` text COMMENT '请求头部信息',
  PRIMARY KEY (`id`),
  INDEX `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户订阅访问日志';


-- ----------------------------
-- Table structure for `user_traffic_daily`
-- ----------------------------
CREATE TABLE `user_traffic_daily` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID，0表示统计全部节点',
  `u` bigint(20) NOT NULL DEFAULT '0' COMMENT '上传流量',
  `d` bigint(20) NOT NULL DEFAULT '0' COMMENT '下载流量',
  `total` bigint(20) NOT NULL DEFAULT '0' COMMENT '总流量',
  `traffic` varchar(255) DEFAULT '' COMMENT '总流量（带单位）',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `idx_user_node` (`user_id`,`node_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户每日流量统计';


-- ----------------------------
-- Table structure for `user_traffic_hourly`
-- ----------------------------
CREATE TABLE `user_traffic_hourly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID，0表示统计全部节点',
  `u` bigint(20) NOT NULL DEFAULT '0' COMMENT '上传流量',
  `d` bigint(20) NOT NULL DEFAULT '0' COMMENT '下载流量',
  `total` bigint(20) NOT NULL DEFAULT '0' COMMENT '总流量',
  `traffic` varchar(255) DEFAULT '' COMMENT '总流量（带单位）',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `idx_user_node` (`user_id`,`node_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户每小时流量统计';


-- ----------------------------
-- Table structure for `node_traffic_daily`
-- ----------------------------
CREATE TABLE `node_traffic_daily` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `u` bigint(20) NOT NULL DEFAULT '0' COMMENT '上传流量',
  `d` bigint(20) NOT NULL DEFAULT '0' COMMENT '下载流量',
  `total` bigint(20) NOT NULL DEFAULT '0' COMMENT '总流量',
  `traffic` varchar(255) DEFAULT '' COMMENT '总流量（带单位）',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `idx_node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点每日流量统计';


-- ----------------------------
-- Table structure for `node_traffic_hourly`
-- ----------------------------
CREATE TABLE `node_traffic_hourly` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `u` bigint(20) NOT NULL DEFAULT '0' COMMENT '上传流量',
  `d` bigint(20) NOT NULL DEFAULT '0' COMMENT '下载流量',
  `total` bigint(20) NOT NULL DEFAULT '0' COMMENT '总流量',
  `traffic` varchar(255) DEFAULT '' COMMENT '总流量（带单位）',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `idx_node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点每小时流量统计';


-- ----------------------------
-- Table structure for `user_ban_log`
-- ----------------------------
CREATE TABLE `user_ban_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `minutes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封禁账号时长，单位分钟',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '操作描述',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态：0-未处理、1-已处理',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户封禁日志';


-- ----------------------------
-- Table structure for `country`
-- ----------------------------
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT '代码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='国家代码';


-- ----------------------------
-- Records of `country`
-- ----------------------------
INSERT INTO `country` VALUES ('1', '澳大利亚', 'au');
INSERT INTO `country` VALUES ('2', '巴西', 'br');
INSERT INTO `country` VALUES ('3', '加拿大', 'ca');
INSERT INTO `country` VALUES ('4', '瑞士', 'ch');
INSERT INTO `country` VALUES ('5', '中国', 'cn');
INSERT INTO `country` VALUES ('6', '德国', 'de');
INSERT INTO `country` VALUES ('7', '丹麦', 'dk');
INSERT INTO `country` VALUES ('8', '埃及', 'eg');
INSERT INTO `country` VALUES ('9', '法国', 'fr');
INSERT INTO `country` VALUES ('10', '希腊', 'gr');
INSERT INTO `country` VALUES ('11', '香港', 'hk');
INSERT INTO `country` VALUES ('12', '印度尼西亚', 'id');
INSERT INTO `country` VALUES ('13', '爱尔兰', 'ie');
INSERT INTO `country` VALUES ('14', '以色列', 'il');
INSERT INTO `country` VALUES ('15', '印度', 'in');
INSERT INTO `country` VALUES ('16', '伊拉克', 'iq');
INSERT INTO `country` VALUES ('17', '伊朗', 'ir');
INSERT INTO `country` VALUES ('18', '意大利', 'it');
INSERT INTO `country` VALUES ('19', '日本', 'jp');
INSERT INTO `country` VALUES ('20', '韩国', 'kr');
INSERT INTO `country` VALUES ('21', '墨西哥', 'mx');
INSERT INTO `country` VALUES ('22', '马来西亚', 'my');
INSERT INTO `country` VALUES ('23', '荷兰', 'nl');
INSERT INTO `country` VALUES ('24', '挪威', 'no');
INSERT INTO `country` VALUES ('25', '纽西兰', 'nz');
INSERT INTO `country` VALUES ('26', '菲律宾', 'ph');
INSERT INTO `country` VALUES ('27', '俄罗斯', 'ru');
INSERT INTO `country` VALUES ('28', '瑞典', 'se');
INSERT INTO `country` VALUES ('29', '新加坡', 'sg');
INSERT INTO `country` VALUES ('30', '泰国', 'th');
INSERT INTO `country` VALUES ('31', '土耳其', 'tr');
INSERT INTO `country` VALUES ('32', '台湾', 'tw');
INSERT INTO `country` VALUES ('33', '英国', 'uk');
INSERT INTO `country` VALUES ('34', '美国', 'us');
INSERT INTO `country` VALUES ('35', '越南', 'vn');
INSERT INTO `country` VALUES ('36', '波兰', 'pl');
INSERT INTO `country` VALUES ('37', '哈萨克斯坦', 'kz');
INSERT INTO `country` VALUES ('38', '乌克兰', 'ua');
INSERT INTO `country` VALUES ('39', '罗马尼亚', 'ro');
INSERT INTO `country` VALUES ('40', '阿联酋', 'ae');
INSERT INTO `country` VALUES ('41', '南非', 'za');
INSERT INTO `country` VALUES ('42', '缅甸', 'mm');
INSERT INTO `country` VALUES ('43', '冰岛', 'is');
INSERT INTO `country` VALUES ('44', '芬兰', 'fi');
INSERT INTO `country` VALUES ('45', '卢森堡', 'lu');
INSERT INTO `country` VALUES ('46', '比利时', 'be');
INSERT INTO `country` VALUES ('47', '保加利亚', 'bg');
INSERT INTO `country` VALUES ('48', '立陶宛', 'lt');
INSERT INTO `country` VALUES ('49', '哥伦比亚', 'co');
INSERT INTO `country` VALUES ('50', '澳门', 'mo');
INSERT INTO `country` VALUES ('51', '肯尼亚', 'ke');
INSERT INTO `country` VALUES ('52', '捷克', 'cz');
INSERT INTO `country` VALUES ('53', '摩尔多瓦', 'md');
INSERT INTO `country` VALUES ('54', '西班牙', 'es');
INSERT INTO `country` VALUES ('55', '巴基斯坦', 'pk');
INSERT INTO `country` VALUES ('56', '葡萄牙', 'pt');
INSERT INTO `country` VALUES ('57', '匈牙利', 'hu');
INSERT INTO `country` VALUES ('58', '阿根廷', 'ar');


-- ----------------------------
-- Table structure for `payment`
-- ----------------------------
CREATE TABLE `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trade_no` varchar(64) DEFAULT NULL COMMENT '支付单号（本地订单号）',
  `qrcode` TEXT NOT NULL DEFAULT '' COMMENT '支付平台返回的付款二维码',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `amount` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '金额，单位分',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '支付状态：-1-支付失败、0-等待支付、1-支付成功',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='支付单';


-- ----------------------------
-- Table structure for `payment_callback`
-- ----------------------------
CREATE TABLE `payment_callback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trade_no` varchar(100) DEFAULT NULL COMMENT '本地订单号',
  `out_trade_no` varchar(100) DEFAULT NULL COMMENT '外部订单号（支付平台）',
  `amount` int(10) unsigned DEFAULT NULL COMMENT '交易金额，单位分',
  `status` tinyint(1) DEFAULT NULL COMMENT '交易状态：0-失败、1-成功',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='支付回调日志';


-- ----------------------------
-- Table structure for `marketing`
-- ----------------------------
CREATE TABLE `marketing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` TINYINT(4) NOT NULL COMMENT '类型：1-单个发送、2-批量发送',
  `receiver` LONGTEXT NOT NULL COMMENT '接收者',
  `title` VARCHAR(255) NOT NULL COMMENT '标题',
  `content` TEXT NOT NULL COMMENT '内容',
  `status` TINYINT(4) NOT NULL COMMENT '状态：-1-失败、0-待发送、1-成功',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='营销';


-- ----------------------------
-- Table structure for `user_login_log`
-- ----------------------------
CREATE TABLE `user_login_log` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) unsigned NOT NULL DEFAULT '0',
  `ip` CHAR(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `province` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `county` varchar(128) NOT NULL,
  `isp` varchar(128) NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户登录日志';


-- ----------------------------
-- Table structure for `node_ip`
-- ----------------------------
CREATE TABLE `node_ip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `user_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `port` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '端口',
  `type` char(10) NOT NULL DEFAULT 'tcp' COMMENT '类型：all、tcp、udp',
  `ip` text COMMENT '连接IP：每个IP用,号隔开',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上报时间',
  PRIMARY KEY (`id`),
  KEY `idx_node` (`node_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户连接IP';


-- ----------------------------
-- Table structure for `rule`
-- ----------------------------
CREATE TABLE `rule` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL DEFAULT '0' COMMENT '类型：reg-正则表达式、domain-域名、ip-IP、protocol-协议',
  `name` VARCHAR(100) NOT NULL COMMENT '规则描述',
  `pattern` TEXT NOT NULL COMMENT '规则值',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则';


-- ----------------------------
-- Records of `rule`
-- ----------------------------
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
  (10, 'reg', '大陆应用', '(.*\\.||)(baidu|qq|163|189|10000|10010|10086|sohu|sogoucdn|sogou|uc|58|taobao|qpic|bilibili|hdslb|acgvideo|sina|douban|doubanio|xiaohongshu|sinaimg|weibo|xiaomi|youzanyun)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (11, 'reg', '大陆银行', '(.*\\.||)(icbc|ccb|boc|bankcomm|abchina|cmbchina|psbc|cebbank|cmbc|pingan|spdb|citicbank|cib|hxb|bankofbeijing|hsbank|tccb|4001961200|bosc|hkbchina|njcb|nbcb|lj-bank|bjrcb|jsbchina|gzcb|cqcbank|czbank|hzbank|srcb|cbhb|cqrcb|grcbank|qdccb|bocd|hrbcb|jlbank|bankofdl|qlbchina|dongguanbank|cscb|hebbank|drcbank|zzbank|bsb|xmccb|hljrcc|jxnxs|gsrcu|fjnx|sxnxs|gx966888|gx966888|zj96596|hnnxs|ahrcu|shanxinj|hainanbank|scrcu|gdrcu|hbxh|ynrcc|lnrcc|nmgnxs|hebnx|jlnls|js96008|hnnx|sdnxs)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (12, 'reg', '台湾银行', '(.*\\.||)(firstbank|bot|cotabank|megabank|tcb-bank|landbank|hncb|bankchb|tbb|ktb|tcbbank|scsb|bop|sunnybank|kgibank|fubon|ctbcbank|cathaybk|eximbank|bok|ubot|feib|yuantabank|sinopac|esunbank|taishinbank|jihsunbank|entiebank|hwataibank|csc|skbank)\\.(org|com|net|tw)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (13, 'reg', '大陆第三方支付', '(.*\\.||)(alipay|baifubao|yeepay|99bill|95516|51credit|cmpay|tenpay|lakala|jdpay)\\.(org|com|net|cn)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (14, 'reg', '台湾特供', '(.*\.||)(visa|mycard|mastercard|gov|gash|beanfun|bank|line)\.(org|com|net|cn|tw|jp|kr)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (15, 'reg', '涉政治类', '(.*\\.||)(shenzhoufilm|secretchina|renminbao|aboluowang|mhradio|guangming|zhengwunet|soundofhope|yuanming|zhuichaguoji|fgmtv|xinsheng|shenyunperformingarts|epochweekly|tuidang|shenyun|falundata|bannedbook|pincong|rfi|mingjingnews|boxun|rfa|scmp)\\.(org|com|net|rocks|fr)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
  (16, 'reg', '流媒体', '(.*\.||)(youtube|googlevideo|hulu|netflix|nflxvideo|akamai|nflximg|hbo|mtv|bbc|tvb)\.(org|club|com|net|tv)', '2019-11-19 15:04:11', '2019-11-19 15:04:11'),
  (17, 'reg', '测速类', '(.*\.||)(fast|speedtest)\.(org|com|net|cn)', '2019-11-19 15:04:11', '2019-11-19 15:04:11');

-- ----------------------------
-- Table structure for `rule_group`
-- ----------------------------
CREATE TABLE `rule_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT '1' COMMENT '模式：1-阻断、2-仅放行',
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `rules` text COMMENT '关联的规则ID，多个用,号分隔',
  `nodes` text COMMENT '关联的节点ID，多个用,号分隔',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则分组';


-- ----------------------------
-- Records of `rule_group`
-- ----------------------------
INSERT INTO `rule_group` (`id`, `type`, `name`, `rules`, `nodes`, `created_at`, `updated_at`) VALUES
(1, 1, '默认', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15', NULL, '2019-10-26 15:29:48', '2019-10-26 15:29:48');


-- ----------------------------
-- Table structure for `rule_group_node`
-- ----------------------------
CREATE TABLE `rule_group_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rule_group_id` int(10) unsigned DEFAULT '0' COMMENT '规则分组ID',
  `node_id` int(10) unsigned DEFAULT '0' COMMENT '节点ID',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='审计规则分组节点关联表';


-- ----------------------------
-- Table structure for `rule_log`
-- ----------------------------
CREATE TABLE `rule_log` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `node_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `rule_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则ID，0表示白名单模式下访问访问了非规则允许的网址',
  `reason` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '触发原因',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx` (`user_id`, `node_id`, `rule_id`)
) ENGINE=InnoDB COMMENT='触发审计规则日志表';


-- ----------------------------
-- Table structure for `node_rule`
-- ----------------------------
CREATE TABLE `node_rule` (
  `id` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '节点ID',
  `rule_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '审计规则ID',
  `is_black` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '是否黑名单模式：0-不是、1-是',
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='节点审计规则关联';


-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='失败任务';


-- ----------------------------
-- Table structure for `jobs`
-- ----------------------------
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='任务';


-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='迁移';


-- ----------------------------
-- Table structure for `access`
-- ----------------------------
CREATE TABLE `access` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `node_id` INT(10) unsigned NOT NULL DEFAULT '0' COMMENT '授权节点ID',
  `key` CHAR(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '' COMMENT '认证KEY',
  `secret` CHAR(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '' COMMENT '通信密钥',
  `created_at` DATETIME NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` DATETIME NULL DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  INDEX `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='授权密钥表';


-- ----------------------------
-- Table structure for `certificate`
-- ----------------------------
CREATE TABLE `certificate` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`domain` VARCHAR(255) NOT NULL COMMENT '域名',
	`key` TEXT NULL COMMENT '域名证书KEY',
	`pem` TEXT NULL COMMENT '域名证书PEM',
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='域名证书';


-- ----------------------------
-- Table structure for `master`
-- ----------------------------
CREATE TABLE `master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `level` tinyint(3) unsigned DEFAULT '1' COMMENT '等级',
  `credit` int(10) DEFAULT '0' COMMENT '余额',
  `expire_time` datetime DEFAULT NULL COMMENT '有效期结束',
  `remark` text COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：0-禁用、1-启用',
  `last_login` int(10) unsigned DEFAULT NULL COMMENT '最后登录时间',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  `deleted_at` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';


-- ----------------------------
-- Records of `master`
-- ----------------------------
INSERT INTO `master` VALUES (1, 'admin', '$2y$10$ryMdx5ejvCSdjvZVZAPpOuxHrsAUY8FEINUATy6RCck6j9EeHhPfq', 0, 0, NULL, NULL, 1, 1575469801, 'qP3UBhSM2JOg8vEAYDYpd1WELW8qtmBCN1F87bdifpffjVllNk2S7cYRpHXh', NULL, '2019-12-04 22:30:01', NULL);


-- ----------------------------
-- Table structure for `master_action_log`
-- ----------------------------
CREATE TABLE `master_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned DEFAULT '0' COMMENT '管理员ID',
  `description` varchar(255) DEFAULT NULL COMMENT '动作描述',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后一次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员操作日志';


-- ----------------------------
-- Table structure for `master_login_log`
-- ----------------------------
CREATE TABLE `master_login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isp` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员登录日志';


-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
CREATE TABLE `permissions` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `guard_name` VARCHAR(191) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- ----------------------------
-- Records of `permissions`
-- ----------------------------
INSERT INTO `permissions` (`name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
	('admin', 'master', '管理后台首页', '2018-11-02 10:30:58', '2018-11-02 10:30:58'),
	('admin/userList', 'master', '用户管理-用户列表', '2018-11-02 10:31:19', '2018-11-02 10:31:19'),
	('admin/addUser', 'master', '用户管理-添加用户', '2018-11-02 10:31:31', '2018-11-02 10:31:31'),
	('admin/editUser', 'master', '用户管理-编辑用户', '2018-11-02 10:31:53', '2018-11-02 10:31:53'),
	('admin/delUser', 'master', '用户管理-删除用户', '2018-11-02 10:32:21', '2018-11-02 10:32:21'),
	('admin/batchAddUsers', 'master', '用户管理-批量生成用户', '2018-11-02 10:32:36', '2018-11-02 10:32:36'),
	('admin/userGroupList', 'master', '用户管理-用户分组列表', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/addUserGroup', 'master', '用户管理-添加用户分组', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/delUserGroup', 'master', '用户管理-删除用户分组', '2018-11-02 10:32:48', '2018-11-02 10:32:48'),
	('admin/nodeList', 'master', '节点管理-节点列表', '2018-11-02 10:33:11', '2018-11-02 10:33:11'),
	('admin/addNode', 'master', '节点管理-添加节点', '2018-11-02 10:33:24', '2018-11-02 10:33:24'),
	('admin/editNode', 'master', '节点管理-编辑节点', '2018-11-02 10:33:37', '2018-11-02 10:33:37'),
	('admin/delNode', 'master', '节点管理-删除节点', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/reloadNode', 'master', '节点管理-重载节点后端', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeRealTimeStatus', 'master', '节点管理-节点实时状态', '2018-11-02 10:33:50', '2018-11-02 10:33:50'),
	('admin/nodeMonitor', 'master', '节点管理-节点流量监控', '2018-11-02 10:34:07', '2018-11-02 10:34:07'),
	('admin/articleList', 'master', '文章管理-文章列表', '2018-11-02 10:34:25', '2018-11-02 10:34:25'),
	('admin/addArticle', 'master', '文章管理-添加文章', '2018-11-02 10:34:37', '2018-11-02 10:34:37'),
	('admin/editArticle', 'master', '文章管理-编辑文章', '2018-11-02 10:34:51', '2018-11-02 10:34:51'),
	('admin/delArticle', 'master', '文章管理-删除文章', '2018-11-02 10:35:03', '2018-11-02 10:35:03'),
	('admin/groupList', 'master', '节点管理-节点分组列表', '2018-11-02 10:35:28', '2018-11-02 10:35:28'),
	('admin/addGroup', 'master', '节点管理-添加节点分组', '2018-11-02 10:35:43', '2018-11-02 10:35:43'),
	('admin/editGroup', 'master', '节点管理-编辑节点分组', '2018-11-02 10:35:55', '2018-11-02 10:35:55'),
	('admin/delGroup', 'master', '节点管理-删除节点分组', '2018-11-02 10:36:07', '2018-11-02 10:36:07'),
	('admin/labelList', 'master', '节点管理-标签列表', '2018-11-02 10:36:27', '2018-11-02 10:36:27'),
	('admin/addLabel', 'master', '节点管理-添加标签', '2018-11-02 10:36:40', '2018-11-02 10:36:40'),
	('admin/editLabel', 'master', '节点管理-编辑标签', '2018-11-02 10:36:51', '2018-11-02 10:36:51'),
	('admin/delLabel', 'master', '节点管理-删除标签', '2018-11-02 10:37:02', '2018-11-02 10:37:02'),
	('admin/ticketList', 'master', '工单管理-工单列表', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('admin/addTicket', 'master', '工单管理-发起工单', '2018-11-02 10:37:17', '2018-11-02 10:37:17'),
	('admin/replyTicket', 'master', '工单管理-回复工单', '2018-11-02 10:37:28', '2018-11-02 10:37:28'),
	('admin/closeTicket', 'master', '工单管理-关闭工单', '2018-11-02 10:37:41', '2018-11-02 10:37:41'),
	('admin/orderList', 'master', '订单管理-订单列表', '2018-11-02 10:38:48', '2018-11-02 10:38:48'),
	('admin/paymentCallbackList', 'master', '订单管理-支付回调日志', '2018-11-02 15:50:10', '2018-11-02 15:50:10'),
	('admin/inviteList', 'master', '邀请管理-邀请码列表', '2018-11-02 10:39:03', '2018-11-02 10:39:03'),
	('admin/makeInvite', 'master', '邀请管理-生成邀请码', '2018-11-02 10:39:23', '2018-11-02 10:39:23'),
	('admin/exportInvite', 'master', '邀请管理-导出邀请码', '2018-11-02 10:39:41', '2018-11-02 10:39:41'),
	('admin/applyList', 'master', '提现管理-提现申请列表', '2018-11-02 10:40:36', '2018-11-02 10:40:36'),
	('admin/applyDetail', 'master', '提现管理-提现申请详情', '2018-11-02 10:41:12', '2018-11-02 10:41:12'),
	('admin/setApplyStatus', 'master', '提现管理-设置提现申请状态', '2018-11-02 10:41:34', '2018-11-02 10:41:34'),
	('admin/couponList', 'master', '卡券管理-卡券列表', '2018-11-02 10:51:42', '2018-11-02 10:51:42'),
	('admin/addCoupon', 'master', '卡券管理-添加卡券', '2018-11-02 10:51:57', '2018-11-02 10:51:57'),
	('admin/delCoupon', 'master', '卡券管理-删除卡券', '2018-11-02 10:52:09', '2018-11-02 10:52:09'),
	('admin/exportCoupon', 'master', '卡券管理-导出卡券', '2018-11-02 10:52:25', '2018-11-02 10:52:25'),
	('admin/productList', 'master', '产品管理-产品列表', '2018-11-02 10:54:58', '2018-11-02 10:54:58'),
	('admin/addProduct', 'master', '产品管理-添加产品', '2018-11-02 10:55:13', '2018-11-02 10:55:13'),
	('admin/editProduct', 'master', '产品管理-编辑产品', '2018-11-02 10:55:27', '2018-11-02 10:55:27'),
	('admin/delProduct', 'master', '产品管理-删除产品', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/productsPool', 'master', '产品管理-产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/addProductsPool', 'master', '产品管理-添加产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/editProductsPool', 'master', '产品管理-编辑产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/delProductsPool', 'master', '产品管理-删除产品名称池', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/addRule', 'master', '审计规则-添加规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/delRule', 'master', '审计规则-删除规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/ruleGroupList', 'master', '审计规则-规则分组列表', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/addRuleGroup', 'master', '审计规则-添加规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/editRuleGroup', 'master', '审计规则-编辑规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/delRuleGroup', 'master', '审计规则-删除规则分组', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/assignNode', 'master', '审计规则-规则分组分配节点', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/ruleLogList', 'master', '审计规则-审计规则触发记录', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('rule/clearLog', 'master', '商品管理-清空审计规则', '2018-11-02 10:55:37', '2018-11-02 10:55:37'),
	('admin/config', 'master', '设置-通用配置列表', '2018-11-02 11:18:20', '2018-11-02 11:18:20'),
	('admin/setDefaultConfig', 'master', '配置-通用配置-设置默认值', '2018-11-02 11:25:20', '2018-11-02 11:25:20'),
	('admin/system', 'master', '设置-系统配置-配置列表', '2018-11-02 15:25:56', '2018-11-02 15:25:56'),
	('admin/setExtend', 'master', '设置-系统配置-设置客服统计', '2018-11-02 15:26:19', '2018-11-02 15:26:19'),
	('admin/setConfig', 'master', '配置-系统设置-设置某个配置项', '2018-11-02 15:26:46', '2018-11-02 15:26:46'),
	('admin/userCreditLogList', 'master', '用户管理-余额变动记录', '2018-11-02 15:28:19', '2018-11-02 15:28:19'),
	('admin/userTrafficLogList', 'master', '用户管理-流量变动记录', '2018-11-02 15:28:32', '2018-11-02 15:28:32'),
	('admin/userRebateList', 'master', '用户管理-返利流水记录', '2018-11-02 15:28:46', '2018-11-02 15:28:46'),
	('admin/userBanLogList', 'master', '用户管理-用户封禁记录', '2018-11-02 15:28:56', '2018-11-02 15:28:56'),
	('admin/userSubscribeList', 'master', '用户管理-用户列表-订阅码列表', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/userSubscribeLog', 'master', '用户管理-用户列表-用户订阅访问日志', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/setUserSubscribeStatus', 'master', '用户管理-启用禁用用户的订阅', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/export', 'master', '用户管理-用户列表-导出(查看)配置信息', '2018-11-02 15:29:20', '2018-11-02 15:29:20'),
	('admin/userMonitor', 'master', '用户管理-用户列表-用户流量监控', '2018-11-02 15:29:34', '2018-11-02 15:29:34'),
	('admin/resetUserTraffic', 'master', '用户管理-用户列表-重置用户流量', '2018-11-02 15:32:48', '2018-11-02 15:32:48'),
	('admin/handleUserCredit', 'master', '用户管理-用户列表-用户余额充值', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/onlineIPMonitor', 'master', '用户管理-用户列表-在线IP监控', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/emailList', 'master', '营销管理-邮件群发', '2018-11-02 15:46:03', '2018-11-02 15:46:03'),
	('admin/emailLog', 'master', '营销管理-邮件投递记录', '2018-11-02 15:48:49', '2018-11-02 15:48:49'),
	('admin/import', 'master', '工具箱-数据导入', '2018-11-02 15:48:33', '2018-11-02 15:48:33'),
	('admin/trafficLog', 'master', '工具箱-流量日志', '2018-11-02 15:48:49', '2018-11-02 15:48:49'),
	('admin/sensitiveWordsList', 'master', '工具箱-敏感词管理-敏感词列表', '2018-11-02 16:42:13', '2018-11-02 16:42:13'),
	('admin/addSensitiveWords', 'master', '工具箱-敏感词管理-添加敏感词', '2018-11-02 16:42:27', '2018-11-02 16:42:27'),
	('admin/delSensitiveWords', 'master', '工具箱-敏感词管理-删除敏感词', '2018-11-02 16:42:39', '2018-11-02 16:42:39'),
	('logs', 'master', '工具箱-系统运行日志', '2018-11-02 16:43:07', '2018-11-02 16:43:07'),
	('admin/profile', 'master', '管理后台-修改个人信息', '2018-11-02 17:11:53', '2018-11-02 17:11:53'),
	('admin/makePort', 'master', '管理后台-用户列表-生成端口', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/getNodeStatus', 'master', '管理后台-查询节点实时状态', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/accessList', 'master', '管理后台-节点授权列表', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/addAccess', 'master', '管理后台-添加节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/delAccess', 'master', '管理后台-删除节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/refreshAccess', 'master', '管理后台-重置节点授权', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/certificateList', 'master', '管理后台-域名证书列表', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/addCertificate', 'master', '管理后台-添加域名证书', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/editCertificate', 'master', '管理后台-编辑域名证书', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/delCertificate', 'master', '管理后台-删除域名证书', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/refreshCertificate', 'master', '管理后台-重置域名证书', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('admin/sendBarkTestMessage', 'master', '管理后台-发送Bark测试消息', '2018-11-02 17:12:15', '2018-11-02 17:12:15'),
	('permission/permissionList', 'master', '权限管理-权限行为列表', '2018-11-02 17:14:45', '2018-11-02 17:14:45'),
	('permission/addPermission', 'master', '权限管理-添加权限行为', '2018-11-02 17:14:55', '2018-11-02 17:14:55'),
	('permission/editPermission', 'master', '权限管理-编辑权限行为', '2018-11-02 17:15:07', '2018-11-02 17:15:07'),
	('permission/deletePermission', 'master', '权限管理-删除权限行为', '2018-11-02 17:15:15', '2018-11-02 17:15:15'),
	('permission/roleList', 'master', '权限管理-角色列表', '2018-11-02 17:15:25', '2018-11-02 17:15:25'),
	('permission/addRole', 'master', '权限管理-添加角色', '2018-11-02 17:15:33', '2018-11-02 17:15:33'),
	('permission/editRole', 'master', '权限管理-编辑角色', '2018-11-02 17:15:41', '2018-11-02 17:15:41'),
	('permission/deleteRole', 'master', '权限管理-删除角色', '2018-11-02 17:15:49', '2018-11-02 17:15:49'),
	('permission/masterList', 'master', '权限管理-管理员列表', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/addMaster', 'master', '权限管理-添加管理员', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/editMaster', 'master', '权限管理-编辑管理员', '2018-11-02 17:15:56', '2018-11-02 17:15:56'),
	('permission/deleteMaster', 'master', '权限管理-删除管理员', '2018-11-02 17:16:04', '2018-11-02 17:16:04'),
	('permission/assignPermission', 'master', '权限管理-分配权限行为', '2018-11-02 17:16:12', '2018-11-02 17:16:12');


-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
CREATE TABLE `roles` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) NOT NULL,
  `guard_name` VARCHAR(191) NOT NULL,
  `description` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- ----------------------------
-- Table structure for `model_has_permissions`
-- ----------------------------
CREATE TABLE `model_has_permissions` (
  `permission_id` INT(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  INDEX `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- ----------------------------
-- Table structure for `model_has_roles`
-- ----------------------------
CREATE TABLE `model_has_roles` (
  `role_id` INT(10) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  INDEX `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


-- ----------------------------
-- Table structure for `role_has_permissions`
-- ----------------------------
CREATE TABLE `role_has_permissions` (
  `permission_id` INT(10) UNSIGNED NOT NULL,
  `role_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`),
  INDEX `role_has_permissions_role_id_foreign` (`role_id`)
) COLLATE='utf8mb4_unicode_ci' ENGINE=MyISAM;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
