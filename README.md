CREATE TABLE `currex` (
  `cdate` date DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cexchange` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `cdate` (`cdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
