-- 节点表适配V2Ray
ALTER TABLE `ss_node`
  DROP COLUMN `bandwidth`,
  DROP COLUMN `traffic`,
  DROP COLUMN `monitor_url`,
  ADD COLUMN `v2_cdn` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'V2Ray节点是否套用CDN' AFTER `v2_tls`,
  ADD COLUMN `tls_provider` TEXT NULL DEFAULT NULL COMMENT 'V2Ray节点的TLS提供商授权信息' AFTER `v2_cdn`;
