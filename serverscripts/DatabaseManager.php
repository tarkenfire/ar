<?php 
	class DatabaseManager
	{
		const DB_HOST = 'localhost';
		const DB_USER = 'mancm50_ar';
		const DB_PASS =  'RJA(3J6EkBD@zUxl1X';
		const DB_NAME = 'mancm50_ar_data';
		
		private $dataSourceName;
		private $dhHandler;
		private $statement;
		
		function __construct(){
			$dataSourceName = "mysql:host={" . self::DB_HOST ."
				};dbname={". self::DB_NAME ."}";
			$options = array(
					PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			
			try {
				$dbHandler = new PDO($dataSourceName, self::DB_USER, self::DB_PASS, $options);				
			} catch (PDOException $e) {
				//TODO: handle error
				echo($e->getMessage());	
			}
		}
		
		//set the query to be executed
		public function setQuery($query){
			$statement = $dbHandler->prepare($query);
		}
		
		
		//bind PDO params
		public function bind($param, $value, $type = null){
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$statement->bindValue($param, $value, $type);
		}
		
		public function execute(){
			return $statement->execute();
		}
		
		//query results
		public function resultSet(){
			$this->execute();
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function singleResult(){
			$this->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		
		public function lastInsertId(){
			return $dbHandler->lastInsertId();
		}
		
		//returns the number of rows selected by the query statement.
		public function rowCount(){
			return $statement->rowCount();	
		}
		
		//trasactions - for multiple database inserts/queries at once.
		public function beginTransaction(){
			return $dbHandler->beginTransaction();
		}
		
		public function endTrasaction()
		{
			return $dbHandler->commit();
		}
		
		public function cancelTransaction(){
			return $dbHandler->rollBack();
		}
		
		//debug methods
		public function debugDumpParams(){
			return $statement->debugDumpParams();
		}
			
	}


?>