<?php



Route::group(['namespace'=>'Basic'], function (){

	Route::post('login', 'BasicController@login');
});



Route::group(['middleware'=>['check.login'], 'namespace'=>'Basic'], function (){
	
	Route::get('/', function (){
		return view('welcome');
	});
});

