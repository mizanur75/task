<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('task', 'TaskController');
    Route::post('task-delete', 'TaskController@delete')->name('taskDelete');
});

Route::group(['as'=>'user.', 'prefix'=>'user', 'namespace'=>'User', 'middleware'=>['auth','user']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('my-task', 'TaskController');
    Route::post('task-userupdate', 'TaskController@userupdate');
});
