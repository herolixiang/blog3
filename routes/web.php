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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::prefix('/admin')->group(function(){
	Route::get('index','Admin\IndexController@index');
	Route::get('login','Admin\IndexController@login');
	Route::any('login_do','Admin\IndexController@login_do');
});

//restfu风格路由

//用户信息
// Route::resource('user','Api\UserController');

//用户信息
Route::prefix('/api')->group(function(){
	Route::any('add','Api\UserController@add');
	Route::any('list','Api\UserController@list');
	Route::any('delete','Api\UserController@delete');
	Route::any('edit','Api\UserController@edit');
	Route::any('update','Api\UserController@update');
});
//用户信息接口添加页面/
Route::any('/admin/useradd',function(){
	return view('admin.useradd');
});
//用户信息接口展示页面
Route::get('/admin/userlist',function(){
	return view('admin.userlist');
});
//用户信息接口修改页面
Route::get('/admin/useredit',function(){
	return view('admin.useredit');
});