-- 用户默认等级改为0
ALTER TABLE `user`
    MODIFY COLUMN `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '等级，默认0级，最高9级';

-- 订阅显示账号过期时间、订阅显示账号剩余流量、加入自定义订阅文字
UPDATE `config` SET name='is_show_subscribe_expire',value='0' WHERE id=75;
UPDATE `config` SET name='is_show_subscribe_traffic',value='0' WHERE id=84;
UPDATE `config` SET name='subscribe_custom_words',value='' WHERE id=98;

-- 节点离线提醒次数
UPDATE `config` SET name='node_crash_warning_times',value='10' WHERE id=76;

-- 修复返利提现BUG
ALTER TABLE `referral_apply`
    MODIFY COLUMN `link_logs` text COMMENT '关联返利日志ID，例如：1,3,4';
