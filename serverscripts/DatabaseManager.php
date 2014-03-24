<?php 
	class DatabaseManager
	{
		const DB_HOST = 'localhost';
		const DB_USER = 'mancm50_ar';
		const DB_PASS =  'RJA(3J6EkBD@zUxl1X';
		const DB_NAME = 'mancm50_ar_data';
		
		private $dataSourceName;
		private $pdo;
		
		function __construct()
		{
			$dataSourceName = "mysql:host={" . self::DB_HOST ."
				};dbname={". self::DB_NAME ."}";
			$pdo = new PDO($dataSourceName, self::DB_USER, self::DB_PASS);
		}
		
		function runQuery($query)
		{
			
		}
		
			
	}


?>