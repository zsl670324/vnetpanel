-- 加入中转端口
ALTER TABLE `ss_node`
  MODIFY COLUMN `relay_server` varchar(255) NULL DEFAULT NULL COMMENT '中转地址' AFTER `ipv6`,
  ADD COLUMN `relay_port` smallint(5) UNSIGNED NULL DEFAULT 0 COMMENT '中转端口' AFTER `relay_server`;
