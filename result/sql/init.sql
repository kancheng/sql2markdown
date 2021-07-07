CREATE TABLE `info` (
  `id` int(11) NOT NULL DEFAULT '1000' COMMENT '編碼',
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `account_name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶名稱',
  `account_number` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶編號',
  `swift_code` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SWIFT 代碼',
  `comments` text COLLATE utf8_unicode_ci COMMENT '帳戶額外資訊'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

CREATE TABLE `info_1` (
  `id` int(11) NOT NULL DEFAULT '1000' COMMENT '編碼',
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `account_name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶名稱',
  `account_number` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶編號',
  `swift_code` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SWIFT 代碼',
  `comments` text COLLATE utf8_unicode_ci COMMENT '帳戶額外資訊'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;


CREATE TABLE `info_2` (
  `id` int(11) NOT NULL DEFAULT '1000' COMMENT '編碼',
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `account_name` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶名稱',
  `account_number` varchar(155) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳戶編號',
  `swift_code` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'SWIFT 代碼',
  `comments` text COLLATE utf8_unicode_ci COMMENT '帳戶額外資訊'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

