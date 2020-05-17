-- 支付回调表
DROP TABLE `payment_callback`;
CREATE TABLE `payment_callback` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`type` TINYINT NULL COMMENT '支付方式：2-码支付、3-易支付、4-支付宝国际、5-支付宝当面付' COLLATE 'utf8mb4_unicode_ci',
	`trade_no` VARCHAR(100) NULL DEFAULT NULL COMMENT '支付平台订单号' COLLATE 'utf8mb4_unicode_ci',
	`out_trade_no` VARCHAR(100) NULL DEFAULT NULL COMMENT '商户订单号（本地订单号）' COLLATE 'utf8mb4_unicode_ci',
	`amount` INT(0) NULL DEFAULT NULL COMMENT '交易金额，单位分' COLLATE 'utf8mb4_unicode_ci',
	`status` TINYINT(1) NULL DEFAULT NULL COMMENT '交易状态：0-失败、1-成功' COLLATE 'utf8mb4_unicode_ci',
	`created_at` DATETIME NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB COLLATE='utf8mb4_unicode_ci' COMMENT='支付回调日志';
