<?php
	include "GetInfoFromDb.php";
		
	if (!isset($_GET['date'])) {
		echo "Error: wrong parameters";
		return true;
	}
		
	$date = $_GET['date'];
	
	list($yyyy, $mm, $dd) = explode("-", $date);	
	if (!checkdate($mm, $dd, $yyyy)) {
		echo "Error: Incorrect date format";
		return false;
	}
	
	$dbInfo = new GetInfoFromDb();

	return $dbInfo->getExchangeByDate($date);
	
		