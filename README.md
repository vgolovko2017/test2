Hi Sergey,<br><br>
Config.php - file with some necessary params such as db host, usernanme etc.<br>
Database.php - class for db pdo_mysql connection. It has been done in singletone style. However this is not necessary for this project. I just wanted that you see I know what is this.<br>
GetInfoFromDb.php - class get info by date from db (included in getcdate.php)<br>
getcdate.php - Need it for ajax query from js (index.html + jquery).<br> 
cron_script.php - this is functon oriented (class is not using there) php file. It have collecting information from bank.gov.ua and put it in mysql db. It must be run after 10.00 (much better after 11.00) by current Ukrainian time every day. I has realized log functional for this script. Path to log file you can see in Config.php<br>
index.html - main html/js/jquery file<br><br>

P.S.<br>
I were attach some screenshots for you in this repo.<br><br>Table structure below.<br><br>

CREATE TABLE `currex` (
  `cdate` date DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cexchange` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `cdate` (`cdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
