-- 节点是否中转字段 改名
ALTER TABLE `ss_node`
    CHANGE COLUMN `is_transit` `is_relay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否中转节点：0-否、1-是' AFTER `is_nat`;

-- 节点增加中转中转地址
ALTER TABLE `ss_node`
    ADD COLUMN `relay_server` varchar(128) NULL COMMENT '中转地址' AFTER `ipv6`;

-- 删除device表
DROP TABLE `device`;

-- 移除无用的phone表
DROP TABLE `phone`;
