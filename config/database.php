<?php
	
	/**
	* Here you define your database settings.
	* Jexm supports mysql and sqlite
	* If you use sqlite put the file in sqlite folder in this directory or change path in dsn.
	*/
	
	return [
		
		/**
		* Allows you to define another fetchmode. 
		*/
		"fetch_mode" => PDO::FETCH_OBJ,
		
		
		/**
		* Defines which connection to use.
		*/
		"driver" => "sqlite",
		
		"connections" => [
			
			"mysql" => [
				"dsn" => "mysql:host=localhost;dbname=jexm;charset=utf8;",
				"username" => "username",
				"password" => "password"
			],
			
			"sqlite" => [
				"dsn" => "sqlite:".__DIR__ .DS."sqlite".DS."jexm.sqlite",
				"username" => null,
				"password" => null
			]
			
		]
	
	];