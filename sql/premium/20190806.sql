-- 废弃无意义的加密方式、协议、混淆
TRUNCATE TABLE `ss_config`;

INSERT INTO `ss_config` VALUES ('1', 'none', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('2', 'bf-cfb', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('3', 'chacha20', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('4', 'chacha20-ietf', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('5', 'aes-128-cfb', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('6', 'aes-192-cfb', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('7', 'aes-256-cfb', '1', '1', '0');
INSERT INTO `ss_config` VALUES ('8', 'aes-128-ctr', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('9', 'aes-192-ctr', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('10', 'aes-256-ctr', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('11', 'cast5-cfb', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('12', 'des-cfb', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('13', 'rc4-md5', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('14', 'salsa20', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('15', 'aes-128-gcm', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('16', 'aes-192-gcm', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('17', 'aes-256-gcm', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('18', 'chacha20-ietf-poly1305', '1', '0', '0');
INSERT INTO `ss_config` VALUES ('19', 'origin', '2', '1', '0');
INSERT INTO `ss_config` VALUES ('20', 'auth_aes128_md5', '2', '0', '0');
INSERT INTO `ss_config` VALUES ('21', 'auth_aes128_sha1', '2', '0', '0');
INSERT INTO `ss_config` VALUES ('22', 'auth_chain_a', '2', '0', '0');
INSERT INTO `ss_config` VALUES ('23', 'plain', '3', '1', '0');
INSERT INTO `ss_config` VALUES ('24', 'http_simple', '3', '0', '0');
INSERT INTO `ss_config` VALUES ('25', 'tls1.2_ticket_auth', '3', '0', '0');