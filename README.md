Hi Sergey,

Config.php - file with some necessary params such as db host, usernanme etc.
Database.php - class for db pdo_mysql connection. It has been done in singletone style. However this is not necessary for this project. I just wanted that you know I know what is this.
GetInfoFromDb.php - class get info by date from db (included in getcdate.php)
getcdate.php - this functon oriented (class is not using there). Need it for ajax query from js (index.html + jquery). I has realized log functional for this script. Path to log file you can see in Config.php
index.html - main html/js/jquery file

P.S.
I were attach some screenshots for you in this repo.
Table structure below.

CREATE TABLE `currex` (
  `cdate` date DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cexchange` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `cdate` (`cdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
