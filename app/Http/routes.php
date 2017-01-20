<?php


Route::group(['namespace'=>'Basic'], function (){

	Route::post('login', 'BasicController@login');
	Route::post('register', 'BasicController@register');
	Route::get('logout', 'BasicController@logout');
	
	Route::get('sendMail', 'BasicController@sendMail');
	
});



Route::group(['middleware'=>['check.login'], 'namespace'=>'Basic'], function (){
	
	Route::get('/', function (){
		return view('index');
	});
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'IncomeExpend'], function (){

    Route::get('/queryRecords', 'IncomeExpendController@queryRecords');
    	
    Route::post('/addRecord', 'IncomeExpendController@addRecord');
    
    Route::get('/exportRecords', 'ImportExportController@exportRecords');
    
    Route::get('/getCategoryMap', 'IncomeExpendController@getCategoryMap');
});
    
    