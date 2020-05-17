-- 移除有赞云，加入码支付
UPDATE `config` SET name='payment_gateway',value='0' WHERE id=50;
UPDATE `config` SET name='codepay_url',value='https://codepay.fateqq.com/creat_order' WHERE id=51;
UPDATE `config` SET name='codepay_id',value='' WHERE id=52;
UPDATE `config` SET name='codepay_key',value='' WHERE id=53;

-- 审计规则模式：0-全局规则（所有节点都按规则审计）、1-自定义规则
UPDATE `config` SET name='node_rule_mode',value='0' WHERE id=76;

-- 删除webapi授权里的软删除字段
ALTER TABLE `access`
	DROP COLUMN `deleted_at`,
	DROP COLUMN `status`;
