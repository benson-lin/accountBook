<?php

Route::get('/phpinfo', function(){
	phpinfo();
});

Route::group(['namespace'=>'Basic'], function (){

	Route::post('login', 'BasicController@login');
	Route::post('register', 'BasicController@register');
	Route::get('logout', 'BasicController@logout');
	Route::get('sendMail', 'BasicController@sendMail');
	
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'Basic'], function (){
	
	Route::get('/', "BasicController@index");
    Route::get('/main', "BasicController@index");
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'IncomeExpend'], function (){

    Route::get('/queryRecords', 'IncomeExpendController@queryRecords');
    Route::post('/addRecord', 'IncomeExpendController@addRecord');
    Route::post('/removeRecords', 'IncomeExpendController@removeRecords');
    Route::get('/exportRecords', 'ImportExportController@exportRecords');
    Route::post('/batchImportRecords', 'ImportExportController@batchImportRecords');
    Route::get('/getCategoryMap', 'IncomeExpendController@getCategoryMap');
    Route::get('/statistics', 'ChartController@statistics');
    Route::get('/lineChart', 'ChartController@lineChart');
    Route::get('/barChart', 'ChartController@barChart');
    
    Route::get('/getRemainMoneyByAccount', 'ChartController@getRemainMoneyByAccount');
});


Route::group(['middleware'=>['check.login'], 'namespace'=>'User'], function (){

    Route::get('/getUserInfo', 'UserController@getUserInfo');
});
    