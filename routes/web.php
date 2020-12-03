<?php
Route::view('/', function() {
	return phpinfo();
});
Auth::routes();

Route::get('/adminlogin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/writerlogin', 'Auth\LoginController@showWriterLoginForm')->name('login.writer');
Route::get('/adminregister', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/writerregister', 'Auth\RegisterController@showWriterRegisterForm')->name('register.writer');

Route::post('/adminlogin', 'Auth\LoginController@adminLogin');
Route::post('/writerlogin', 'Auth\LoginController@writerLogin');
Route::post('/adminregister', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/writerregister', 'Auth\RegisterController@createWriter')->name('register.writer');

Route::view('/home', 'home')->middleware('auth');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::group(['middleware' => 'auth:writer'], function () {
    Route::view('/writer', 'writer');
});
