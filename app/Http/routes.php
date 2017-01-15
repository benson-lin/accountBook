<?php


Route::group(['namespace'=>'Basic'], function (){

	Route::post('login', 'BasicController@login');
	Route::post('register', 'BasicController@register');
	Route::get('logout', 'BasicController@logout');
	
});



Route::group(['middleware'=>['check.login'], 'namespace'=>'Basic'], function (){
	
	Route::get('/', function (){
		return view('welcome');
	});
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'IncomeExpend'], function (){

    Route::get('/queryRecords', 'IncomeExpendController@queryRecords');
    
    Route::get('/addRecord', 'IncomeExpendController@addRecord');
});
    
    