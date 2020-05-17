-- 用户表新增最后连接IP字段
ALTER TABLE `user`
ADD COLUMN `ip` char(128) NULL COMMENT '最后连接IP' AFTER `t`;

-- 重建连接IP信息索引
ALTER TABLE `ss_node_ip`
ADD INDEX `idx_node`(`node_id`, `user_id`) USING BTREE;
