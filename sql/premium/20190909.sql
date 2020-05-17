-- 节点表字段长度变更
ALTER TABLE `ss_node`
    MODIFY COLUMN `protocol` varchar(32) NOT NULL DEFAULT 'origin' COMMENT '协议' AFTER `method`,
    MODIFY COLUMN `obfs` varchar(32) NOT NULL DEFAULT 'plain' COMMENT '混淆' AFTER `protocol`,
    MODIFY COLUMN `obfs_param` varchar(255) NULL DEFAULT '' COMMENT '混淆参数' AFTER `obfs`;