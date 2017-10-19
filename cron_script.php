<?php
	include "Database.php";

	// YYYYMMDD
	$today = date("Ynj"); 
	if (!getExchangeByDate($today)) {
		logIt("Error: could not get exchange/rate");
		die();
	}
		
	return;
	
	function getExchangeByDate($date = false) {
		$db = Database::getInstance();
		$dbh = $db->getConnection();
		$url = URL;
		$cc = CC;

		if (!$dbh) {
			logIt("Error: could not connect to db");
			return false;
		}
			
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, URL . $date); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 			
		$content = curl_exec($ch); 
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		curl_close($ch); 
			
		if ($httpCode !== 200) {
			logIt("Error: Incorrect htttp code returted: $httpCode");
			return false;
		}

		try {
			$hash = simplexml_load_string($content);
		} catch (Exception $e){
			logIt("Error: " . $e->getMessage());
			return false;
		}

		logIt($url . $date);
		logIt($content);
		
		$today = date("Y-n-j");	

		try {
			$stmt = $dbh->prepare("SELECT cdate FROM currex where cdate = '$today' and '"
						. $hash->currency->cc . "' = '$cc'");
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			logIt("Error!: " . $e->getMessage());
			return false;				
		}
			
		if (is_object($rs)) {
			$query = "update currex set cexchange = '" . $hash->currency->rate
						. "' where cdate = '$today'";
//echo $query;
			try {
				$stmt = $dbh->prepare($query);
				$stmt->execute();
			} catch (PDOException $e) {
				logIt("Error!: " . $e->getMessage());
				return false;	
			}
		}	
		else {
			$query = "insert into currex set cexchange = '" . $hash->currency->rate
						. "', cdate = '$today', currency = '" . $hash->currency->cc . "'";
//echo $query;
			try {
				$stmt = $dbh->prepare($query);
				$stmt->execute();
			} catch (PDOException $e) {
				logIt("Error!: " . $e->getMessage());
				return false;
			}
		}

		logIt("Info by the date: $today has been added to db.");
			
		return true;
	}
		
	function logIt($msg = false) {
		if ($msg == false || $msg == "")
			return false;
			
		$date = date("Y/m/d H:i:s");
			
		file_put_contents(PATH_TO_LOG_FILE, "$date: $msg\n", FILE_APPEND | LOCK_EX);
			
		return true;
	}