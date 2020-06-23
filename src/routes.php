<?php

use Illuminate\Support\Facades\Route;

Route::post('/admin/upload', 'Kakhura\LaravelSiteBases\Http\Controllers\Admin\Controller@uploadFromRedactor')->middleware(['web', 'auth']);

Route::group(['prefix' => 'admin', 'namespace' => 'Kakhura\LaravelSiteBases\Http\Controllers\Admin', 'middleware' => ['web', 'auth', 'with_db_transactions']], function () {
    Route::group(['prefix' => 'pages/edit', 'namespace' => 'Page'], function () {
        Route::get('/about', 'AboutController@about');
        Route::post('/about', 'AboutController@storeAbout');

        Route::get('/contact', 'ContactController@contact');
        Route::post('/contact', 'ContactController@storeContact');
    });

    Route::group(['prefix' => 'slides', 'namespace' => 'Slide'], function () {
        Route::get('/', 'SlideController@slides');
        Route::get('/create', 'SlideController@createSlide');
        Route::post('/create', 'SlideController@storeSlide');
        Route::get('/edit/{slide}', 'SlideController@editSlide');
        Route::post('/edit/{slide}', 'SlideController@updateSlide');
        Route::get('/delete/{slide}', 'SlideController@deleteSlide');
        Route::post('/publish', 'SlideController@publish');
        Route::post('/ordering', 'SlideController@ordering');
    });

    Route::group(['prefix' => 'projects', 'namespace' => 'Project'], function () {
        Route::get('/', 'ProjectController@projects');
        Route::get('/create', 'ProjectController@createProject');
        Route::post('/create', 'ProjectController@storeProject');
        Route::get('/edit/{project}', 'ProjectController@editProject');
        Route::post('/edit/{project}', 'ProjectController@updateProject');
        Route::get('/delete/{project}', 'ProjectController@deleteProject');
        Route::post('/publish', 'ProjectController@publish');
        Route::post('/ordering', 'ProjectController@ordering');
        Route::post('/delete-img', 'ProjectController@projectDeleteImg');
    });

    Route::group(['prefix' => 'blogs', 'namespace' => 'Blog'], function () {
        Route::get('/', 'BlogController@blogs');
        Route::get('/create', 'BlogController@createBlog');
        Route::post('/create', 'BlogController@storeBlog');
        Route::get('/edit/{blog}', 'BlogController@editBlog');
        Route::post('/edit/{blog}', 'BlogController@updateBlog');
        Route::get('/delete/{blog}', 'BlogController@deleteBlog');
        Route::post('/publish', 'BlogController@publish');
        Route::post('/ordering', 'BlogController@ordering');
        Route::post('/delaleimg', 'BlogController@blogDelaleimg');
    });

    Route::group(['prefix' => 'news', 'namespace' => 'News'], function () {
        Route::get('/', 'NewsController@news');
        Route::get('/create', 'NewsController@createNews');
        Route::post('/create', 'NewsController@storeNews');
        Route::get('/edit/{news}', 'NewsController@editNews');
        Route::post('/edit/{news}', 'NewsController@updateNews');
        Route::get('/delete/{news}', 'NewsController@deleteNews');
        Route::post('/publish', 'NewsController@publish');
        Route::post('/ordering', 'NewsController@ordering');
        Route::post('/delaleimg', 'NewsController@newsDelaleimg');
    });

    Route::group(['prefix' => 'services', 'namespace' => 'Service'], function () {
        Route::get('/', 'AdminController@services');
        Route::get('/create', 'AdminController@createService');
        Route::post('/create', 'AdminController@storeService');
        Route::get('/edit/{service}', 'AdminController@editService');
        Route::post('/edit/{service}', 'AdminController@updateService');
        Route::get('/delete/{service}', 'AdminController@deleteService');
        Route::post('/publish', 'AdminController@publish');
        Route::post('/ordering', 'AdminController@ordering');
    });
});
