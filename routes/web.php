<?php
//routing for admin panel
Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::get('noti', 'Admin\DashboardController@noti');
    
    
    //for posts controller
    Route::prefix('posts')->group(function () {
        Route::get('', 'Admin\PostsController@index');
        Route::get('delete/{id}', 'Admin\PostsController@delete');
        Route::get('detail/{id}', 'Admin\PostsController@detail');
        Route::get('add', 'Admin\PostsController@addPage');
        Route::post('add', 'Admin\PostsController@addForm');
        Route::post('edit', 'Admin\PostsController@edit');
    });

    //for categotries controller
    Route::prefix('categories')->group(function () {
        Route::get('', 'Admin\CategoriesController@index');
        Route::get('delete/{id}', 'Admin\CategoriesController@delete');
        Route::get('detail/{id}', 'Admin\CategoriesController@detail');
        Route::post('add', 'Admin\CategoriesController@add');
        Route::post('edit', 'Admin\CategoriesController@edit');
    });

    //for comments controller
    Route::prefix('comments')->group(function () {
        Route::get('', 'Admin\CommentController@index');
        Route::get('delete/{id}', 'Admin\CommentController@delete');
        Route::get('detail/{id}', 'Admin\CommentController@detail');
        Route::post('confirm', 'Admin\CommentController@confirm');
        Route::get('page', 'Admin\CommentController@page');
    });
});



//routing for public area
Route::get('/', function () {
    return view('home');
});
Route::post('captcha', 'Admin\DashboardController@captchaValidate');
Route::get('refreshcaptcha', 'HomeController@refreshCaptcha');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
