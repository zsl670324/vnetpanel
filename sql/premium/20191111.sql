-- 重建用户连接IP日志表索引
ALTER TABLE `ss_node_ip`
DROP INDEX `idx_node`,
ADD INDEX `idx_node`(`node_id`),
ADD INDEX `idx_user`(`user_id`);
