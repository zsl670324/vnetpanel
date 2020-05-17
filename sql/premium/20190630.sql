-- 删除用户表的单连接限速字段
ALTER TABLE `user`
    DROP COLUMN `speed_limit_per_con`;

-- 商品
ALTER TABLE `goods`
    ADD COLUMN `speed` BIGINT(20) NOT NULL DEFAULT '-1' COMMENT '购买后限速，单位字节，默认-1不改变用户现有速率' AFTER `days`,
	ADD COLUMN `limit_num` INT(11) NOT NULL DEFAULT '0' COMMENT '限购数量，默认为0不限购' AFTER `invite_num`,
	DROP COLUMN `is_limit`;

-- 用户表限速字段更名
ALTER TABLE `user`
	CHANGE COLUMN `speed_limit_per_user` `speed_limit` BIGINT(20) NOT NULL DEFAULT '0' COMMENT '单用户限速，默认10G，为0表示不限速，单位Byte' AFTER `obfs_param`;

-- 节点表删除限速字段
ALTER TABLE `ss_node`
	DROP COLUMN `speed_limit`;

-- 节点表删除TCP字段
ALTER TABLE `ss_node`
	DROP COLUMN `is_tcp`;

-- 商品加入实际到账金额字段
ALTER TABLE `goods`
    ADD COLUMN `amount` int(11) NOT NULL DEFAULT '0' COMMENT '实际到账金额，单位分' AFTER `price`;
