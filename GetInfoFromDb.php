<?php
	include "Database.php";
			
	class GetInfoFromDb {
		private $db;
		private $dbh;
		private $url;
	
		// Constructor
		public function __construct() {
			$this->db = Database::getInstance();
			$this->dbh = $this->db->getConnection();
			$this->url = URL;
		}

		public function getExchangeByDate($date = false) {
			if ($date == false) {
				echo "Error: incorrect input parameters";
				return false;
			}

			if (!$this->dbh) {
				echo "Error: could not connect to db";
				return false;
			}
		
			try {
				$stmt = $this->dbh->prepare("select * from currex where `cdate` = '$date'");
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_OBJ);

				echo json_encode($rs);
			} catch (PDOException $e) {
				echo "Error!: " . $e->getMessage();
				return false;
			}
		
			return true;
		}
	}