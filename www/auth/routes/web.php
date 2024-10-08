<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//定义路由 登录界面
Route::get('/login', 'LoginController@index')->name('login');
Route::get('/home','HomeController@index')->middleware('check.jwt')->name('home');
//auth/v1 路由组
Route::prefix('auth/v1')->group(function () {
    Route::post('token','JwtController@index');
    Route::get('me','JwtController@me')->middleware('auth.jwt')->name('me');

});

