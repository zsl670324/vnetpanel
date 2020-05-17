-- 自定义大流量用户的流量阈值
UPDATE `config` SET `name` = 'huge_traffic_threshold', `value` = '500' WHERE `name` = 'subscribe_max';
