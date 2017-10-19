<?php
	include "GetInfoFromDb.php";
		
	if (!isset($_GET['date'])) {
		echo "Error: wrong parameters";
		return false;
	}
		
	$date = $_GET['date'];
	$dbInfo = new GetInfoFromDb();

	return $dbInfo->getExchangeByDate($date);
	
		