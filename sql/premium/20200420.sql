-- 优惠券加入满减券
ALTER TABLE `coupon`
	ADD COLUMN `match_amount` BIGINT(20) NOT NULL DEFAULT '0' COMMENT '满减要求的金额，单位分' AFTER `usage`,
	CHANGE COLUMN `amount` `amount` BIGINT(20) NOT NULL DEFAULT '0' COMMENT '抵用或充值或满减的金额，单位分' AFTER `match_amount`;
