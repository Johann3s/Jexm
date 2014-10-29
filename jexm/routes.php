<?php
	//$route = \jexm\core\route\Routes::getInstance();
	
	/**
	*
	*
	* Here you define your routes.
	* You can define a route with just a controller or controller with a method.
	*
	*
	*/
	Routes::get('/','Test@idx');
	Routes::post('/', 'test@postData');
	Routes::get('/params/<anything>','test@showParam');
	Routes::get('/params','test@doRockAndRoll');
	Routes::get('/test','test2@index');
	
	Routes::get('/pagination','test@helloWorld');
	Routes::get('/user/auth','test@authUser');
	Routes::get('/user/logout','test@logoutUser');
	
	Routes::get('/update','test@updateSomething');
	Routes::get('/test/model','test@modelTest');

