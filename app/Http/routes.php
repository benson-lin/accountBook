<?php

use Illuminate\Support\Facades\Session;
Route::get('/phpinfo', function(){
	phpinfo();
});

Route::group(['namespace'=>'Basic'], function (){

	Route::post('login', 'BasicController@login');
	Route::post('register', 'BasicController@register');
	Route::get('logout', 'BasicController@logout');
	Route::get('registerSendEmail', 'BasicController@registerSendEmail');
	Route::get('registerAccept', 'BasicController@registerAccept');
	Route::get('sendEmailSucc', 'BasicController@sendEmailSucc');
	
	
	
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'Basic'], function (){
	
	Route::get('/', "BasicController@index");
    Route::get('/main', "BasicController@index");
});

Route::group(['middleware'=>['check.login'], 'namespace'=>'IncomeExpend'], function (){

    Route::get('/queryRecords', 'IncomeExpendController@queryRecords');
    Route::post('/addRecord', 'IncomeExpendController@addRecord');
    Route::post('/removeRecords', 'IncomeExpendController@removeRecords');
    Route::post('/exportRecords', 'ImportExportController@exportRecords');
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


Route::get('/test', function(){
	
    $str = "我是李云";
    $key = "123qwe.0198609050111161X";
    $cipher = MCRYPT_RIJNDAEL_128;
    $mode = MCRYPT_MODE_ECB;
    $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher,$mode),MCRYPT_RAND);
    echo "原文：".$str."<br>";
    $str_encrypt = mcrypt_encrypt($cipher,$key,$str,$mode,$iv);
    echo "加密后的内容是：".$str_encrypt."<br>";
    $str_decrypt = mcrypt_decrypt($cipher,$key,$str_encrypt,$mode,$iv);
    echo "解密后的内容：".$str_decrypt."<br>";
});


    