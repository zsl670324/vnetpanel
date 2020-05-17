-- 增加用户分组控制表
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '分组名称',
  `nodes` text COMMENT '关联的节点ID，多个用,号分隔',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户分组控制表';

-- 用户表增加所属分组ID字段
ALTER TABLE `user`
  ADD COLUMN `group_id` int(0) NULL DEFAULT 0 COMMENT '所属分组ID' AFTER `remark`;

-- 移除节点分组的level字段
ALTER TABLE `ss_group`
  DROP COLUMN `level`;

-- 增加一条审计规则：流媒体
INSERT INTO `rule` (`id`, `type`, `name`, `pattern`, `created_at`, `updated_at`) VALUES
  (16, 'reg', '流媒体', '(.*\.||)(youtube|googlevideo|hulu|netflix|nflxvideo|akamai|nflximg|hbo|mtv|bbc|tvb)\.(org|club|com|net|tv)', '2019-11-19 15:04:11', '2019-11-19 15:04:11');
