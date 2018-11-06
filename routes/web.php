<?php
//routing for admin panel
Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::get('posts', 'Admin\PostsController@index');
});



//routing for public area
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
