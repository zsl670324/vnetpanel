-- 节点表增加消息推送端口
ALTER TABLE `ss_node`
	ADD COLUMN `push_port` INT NOT NULL DEFAULT '0' COMMENT '消息推送端口' AFTER `passwd`;
