-- 适配V2RAY后端，加入全局TLS PROVIDER
UPDATE `config` SET `name` = 'v2ray_tls_provider', `value` = '' WHERE `name` = 'referral_traffic';
