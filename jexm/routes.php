<?php
	/**
	* Here you define your routes.
	*/
	
	Routes::get('/','Test@idx');
	Routes::post('/', 'test@postData');
	Routes::get('/params/<anything>','test@showParam');
	Routes::get('/params','test@doRockAndRoll');
	Routes::get('/test','test2@index');
	
	
	Routes::get('/pagination','test@helloWorld');
	Routes::get('/user/auth','test@authUser');
	Routes::get('/user/check','test@checkUser');
	Routes::get('/user/logout','test@logoutUser');
	
	Routes::get('/update','test@updateSomething');
	Routes::get('/test/get','test@modelTest');
	Routes::get('/test/add','test@add');	
	Routes::get('/test/update','test@update');
	Routes::get('/test/delete','test@delete');
	Routes::get('/test/join','test@join');
	
	Routes::get('/json','test@json');
	Routes::get('/custom','test@testCustom');
	Routes::get('/test/clean','test@cleanStuff');
	Routes::post('/test/clean','test@cleanStuff');
	
	Routes::get('/test/di','test@diTest');
	//Routes::get('/invalid','test2');