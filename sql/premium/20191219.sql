-- goods表明product表，并大量改写字段
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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

-- order表改名orders，并大量改写字段
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
  `paid_at` datetime DEFAULT NULL COMMENT '支付时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后一次更新时间',
  PRIMARY KEY (`oid`) USING BTREE,
  KEY `idx_order_search` (`user_id`,`product_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单表';

-- 新增产品名称池
CREATE TABLE `products_pool` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `min_amount` int(10) unsigned DEFAULT 0 COMMENT '适用最小金额',
  `max_amount` int(10) unsigned DEFAULT 0 COMMENT '适用最大金额',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '状态：0-未启用、1-已启用',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='产品名称池';

-- 移除order_goods表
DROP TABLE `order_goods`;

-- user_balance_log 表改名为 user_credit_log
RENAME TABLE `user_balance_log` TO `user_credit_log`;

-- desc 字段名规范化为 description
ALTER TABLE `user_credit_log`
  CHANGE COLUMN `desc` `description` varchar(255) NULL DEFAULT '' COMMENT '操作描述' AFTER `amount`;

ALTER TABLE `user_ban_log`
  CHANGE COLUMN `desc` `description` varchar(255) NULL DEFAULT '' COMMENT '操作描述' AFTER `minutes`;

ALTER TABLE `user_traffic_modify_log`
  CHANGE COLUMN `desc` `description` varchar(255) NULL DEFAULT '' COMMENT '操作描述' AFTER `after`;

ALTER TABLE `coupon_log`
  CHANGE COLUMN `goods_id` `product_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '产品ID' AFTER `coupon_id`,
  CHANGE COLUMN `desc` `description` varchar(255) NULL DEFAULT '' COMMENT '操作描述' AFTER `order_id`;

ALTER TABLE `master`
  CHANGE COLUMN `balance` `credit` int(10) DEFAULT '0' COMMENT '余额' AFTER `level`;

-- user 表字段改名
ALTER TABLE `user`
  ADD COLUMN `code` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '唯一码' AFTER `id`,
  CHANGE COLUMN `balance` `credit` int(11) NOT NULL DEFAULT 0 COMMENT '余额，单位分' AFTER `pay_way`,
  CHANGE COLUMN `invite_num` `invite_qty` int(11) NOT NULL DEFAULT 0 COMMENT '可生成邀请码数' AFTER `referral_uid`,
  MODIFY COLUMN `transfer_enable` bigint(20) UNSIGNED NOT NULL DEFAULT 1099511627776 COMMENT '可用流量，单位字节，默认1TiB' AFTER `vmess_id`,
  MODIFY COLUMN `u` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已上传流量，单位字节' AFTER `transfer_enable`,
  MODIFY COLUMN `d` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '已下载流量，单位字节' AFTER `u`,
  DROP COLUMN `traffic_reset_day`;

-- config 表配置改名(加入麻瓜宝、盛凯小微支付、PAYJS支付)
UPDATE `config` SET name='v2ray_license',value='' WHERE id=2;
UPDATE `config` SET name='invite_qty',value='0' WHERE id=3;
UPDATE `config` SET value='http://api2.xiuxiu888.com/creat_order/?' WHERE id=51;
UPDATE `config` SET name='shengkai_url',value='https://v.0599.pro' WHERE id=77;
UPDATE `config` SET name='shengkai_mch_id',value='' WHERE id=78;
UPDATE `config` SET name='shengkai_key',value='' WHERE id=79;
UPDATE `config` SET name='mugglepay_url',value='https://api.mugglepay.com/v1' WHERE id=80;
UPDATE `config` SET name='mugglepay_secret',value='' WHERE id=81;
UPDATE `config` SET name='payjs_mch_id',value='' WHERE id=82;
UPDATE `config` SET name='payjs_key',value='' WHERE id=83;

-- 移除 ss_node 表的 is_nat、compatible 字段、改名desc字段
ALTER TABLE `ss_node`
  DROP COLUMN `is_nat`,
  DROP COLUMN `compatible`,
  CHANGE COLUMN `desc` `description` varchar(255) NULL DEFAULT '' COMMENT '简单描述' AFTER `relay_port`;

-- 用户订阅码长度由5位改8位
ALTER TABLE `user_subscribe`
  MODIFY COLUMN `code` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT '' COMMENT '订阅地址唯一识别码' AFTER `user_id`;

-- 移除无用V2Ray配置
ALTER TABLE `ss_node`
  DROP COLUMN `v2_insider_port`,
  DROP COLUMN `v2_outsider_port`;

-- 无用的config ID：80
