-- 增加VNET授权码
UPDATE `config` SET `name` = 'vnet_license', `value` = '' WHERE `name` = 'reset_traffic';

-- 返利模式可调：1-初次返利、2-循环返利
UPDATE `config` SET `name` = 'referral_type', `value` = '1' WHERE `name` = 'is_clear_log';
