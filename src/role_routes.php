<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Kakhura\LaravelSiteBases\Http\Controllers\Admin', 'middleware' => array_merge(['web', 'auth', 'with_db_transactions'], config('kakhura.site-bases.use_two_type_users') ? ['admin'] : [])], function () {
    Route::post('/upload', 'Controller@uploadFromRedactor');

    Route::get('/', 'Controller@index');

    Route::group(['prefix' => 'pages/edit', 'namespace' => 'Page', 'middleware' => ['permission:view-pages']], function () {
        Route::get('/about', 'AboutController@about')->middleware('permission:update-about-pages');
        Route::post('/about', 'AboutController@storeAbout')->middleware('permission:update-about-pages');

        Route::get('/rules', 'RuleController@rules')->middleware('permission:update-rules-pages');
        Route::post('/rules', 'RuleController@storeRules')->middleware('permission:update-rules-pages');

        Route::get('/contact', 'ContactController@contact')->middleware('permission:update-contact-pages');
        Route::post('/contact', 'ContactController@storeContact')->middleware('permission:update-contact-pages');
    });

    Route::group(['prefix' => 'slides', 'namespace' => 'Slide'], function () {
        Route::get('/', 'SlideController@slides')->middleware('permission:view-slides');
        Route::get('/create', 'SlideController@createSlide')->middleware('permission:create-slide');
        Route::post('/create', 'SlideController@storeSlide')->middleware('permission:create-slide');
        Route::get('/edit/{slide}', 'SlideController@editSlide')->middleware('permission:update-slide');
        Route::post('/edit/{slide}', 'SlideController@updateSlide')->middleware('permission:update-slide');
        Route::get('/delete/{slide}', 'SlideController@deleteSlide')->middleware('permission:delete-slide');
        Route::post('/publish', 'SlideController@publish')->middleware('permission:publish-slide');
        Route::post('/ordering', 'SlideController@ordering')->middleware('permission:ordering-slide');
    });

    Route::group(['prefix' => 'projects', 'namespace' => 'Project'], function () {
        Route::get('/', 'ProjectController@projects')->middleware('permission:view-projects');
        Route::get('/create', 'ProjectController@createProject')->middleware('permission:create-project');
        Route::post('/create', 'ProjectController@storeProject')->middleware('permission:create-project');
        Route::get('/edit/{project}', 'ProjectController@editProject')->middleware('permission:update-project');
        Route::post('/edit/{project}', 'ProjectController@updateProject')->middleware('permission:update-project');
        Route::get('/delete/{project}', 'ProjectController@deleteProject')->middleware('permission:delete-project');
        Route::post('/publish', 'ProjectController@publish')->middleware('permission:publish-projects');
        Route::post('/ordering', 'ProjectController@ordering')->middleware('permission:ordering-projects');
        Route::post('/delete-project-img', 'ProjectController@projectDeleteImg')->middleware('permission:delete-project-img');
    });

    Route::group(['prefix' => 'products', 'namespace' => 'Product'], function () {
        Route::get('/', 'ProductController@products')->middleware('permission:view-products');
        Route::get('/create', 'ProductController@createProduct')->middleware('permission:create-product');
        Route::post('/create', 'ProductController@storeProduct')->middleware('permission:create-product');
        Route::get('/edit/{product}', 'ProductController@editProduct')->middleware('permission:update-product');
        Route::post('/edit/{product}', 'ProductController@updateProduct')->middleware('permission:update-product');
        Route::get('/delete/{product}', 'ProductController@deleteProduct')->middleware('permission:delete-product');
        Route::post('/publish', 'ProductController@publish')->middleware('permission:publish-products');
        Route::post('/ordering', 'ProductController@ordering')->middleware('permission:ordering-products');
        Route::post('/delete-product-img', 'ProductController@productDeleteImg')->middleware('permission:delete-product-img');
    });

    Route::group(['prefix' => 'categories', 'namespace' => 'Category'], function () {
        Route::get('/', 'CategoryController@categories')->middleware('permission:view-categories');
        Route::get('/create', 'CategoryController@createCategory')->middleware('permission:create-category');
        Route::post('/create', 'CategoryController@storeCategory')->middleware('permission:create-category');
        Route::get('/edit/{category}', 'CategoryController@editCategory')->middleware('permission:update-category');
        Route::post('/edit/{category}', 'CategoryController@updateCategory')->middleware('permission:update-category');
        Route::get('/delete/{category}', 'CategoryController@deleteCategory')->middleware('permission:delete-category');
        Route::post('/publish', 'CategoryController@publish')->middleware('permission:publish-category');
        Route::post('/ordering', 'CategoryController@ordering')->middleware('permission:ordering-category');
    });

    Route::group(['prefix' => 'blogs', 'namespace' => 'Blog'], function () {
        Route::get('/', 'BlogController@blogs')->middleware('permission:view-blogs');
        Route::get('/create', 'BlogController@createBlog')->middleware('permission:create-blog');
        Route::post('/create', 'BlogController@storeBlog')->middleware('permission:create-blog');
        Route::get('/edit/{blog}', 'BlogController@editBlog')->middleware('permission:update-blog');
        Route::post('/edit/{blog}', 'BlogController@updateBlog')->middleware('permission:update-blog');
        Route::get('/delete/{blog}', 'BlogController@deleteBlog')->middleware('permission:delete-blog');
        Route::post('/publish', 'BlogController@publish')->middleware('permission:publish-blog');
        Route::post('/ordering', 'BlogController@ordering')->middleware('permission:ordering-blog');
        Route::post('/delete-blog-img', 'BlogController@blogDeleteImg')->middleware('permission:delete-product-blog');
    });

    Route::group(['prefix' => 'pages', 'namespace' => 'DynamicPage'], function () {
        Route::get('/', 'PageController@pages')->middleware('permission:view-pages');
        Route::get('/create', 'PageController@createPage')->middleware('permission:create-page');
        Route::post('/create', 'PageController@storePage')->middleware('permission:create-page');
        Route::get('/edit/{page}', 'PageController@editPage')->middleware('permission:update-page');
        Route::post('/edit/{page}', 'PageController@updatePage')->middleware('permission:update-page');
        Route::get('/delete/{page}', 'PageController@deletePage')->middleware('permission:delete-page');
        Route::post('/publish', 'PageController@publish')->middleware('permission:publish-page');
        Route::post('/ordering', 'PageController@ordering')->middleware('permission:ordering-page');
        Route::post('/delete-page-img', 'PageController@pageDeleteImg')->middleware('permission:delete-product-page');
    });

    Route::group(['prefix' => 'photos', 'namespace' => 'Photo'], function () {
        Route::get('/', 'PhotoController@photos')->middleware('permission:view-photos');
        Route::get('/create', 'PhotoController@createPhoto')->middleware('permission:create-photo');
        Route::post('/create', 'PhotoController@storePhoto')->middleware('permission:create-photo');
        Route::get('/edit/{photo}', 'PhotoController@editPhoto')->middleware('permission:update-photo');
        Route::post('/edit/{photo}', 'PhotoController@updatePhoto')->middleware('permission:update-photo');
        Route::get('/delete/{photo}', 'PhotoController@deletePhoto')->middleware('permission:delete-photo');
        Route::post('/publish', 'PhotoController@publish')->middleware('permission:publish-photo');
        Route::post('/ordering', 'PhotoController@ordering')->middleware('permission:ordering-photo');
        Route::post('/delete-photo-img', 'PhotoController@photoDeleteImg')->middleware('permission:delete-product-photo');
    });

    Route::group(['prefix' => 'news', 'namespace' => 'News'], function () {
        Route::get('/', 'NewsController@news')->middleware('permission:view-news');
        Route::get('/create', 'NewsController@createNews')->middleware('permission:create-news');
        Route::post('/create', 'NewsController@storeNews')->middleware('permission:create-news');
        Route::get('/edit/{news}', 'NewsController@editNews')->middleware('permission:update-news');
        Route::post('/edit/{news}', 'NewsController@updateNews')->middleware('permission:update-news');
        Route::get('/delete/{news}', 'NewsController@deleteNews')->middleware('permission:delete-news');
        Route::post('/publish', 'NewsController@publish')->middleware('permission:publish-news');
        Route::post('/ordering', 'NewsController@ordering')->middleware('permission:ordering-news');
        Route::post('/delete-news-img', 'NewsController@newsDeleteImg')->middleware('permission:delete-news-img');
    });

    Route::group(['prefix' => 'services', 'namespace' => 'Service'], function () {
        Route::get('/', 'ServiceController@services')->middleware('permission:view-services');
        Route::get('/create', 'ServiceController@createService')->middleware('permission:create-service');
        Route::post('/create', 'ServiceController@storeService')->middleware('permission:create-service');
        Route::get('/edit/{service}', 'ServiceController@editService')->middleware('permission:update-service');
        Route::post('/edit/{service}', 'ServiceController@updateService')->middleware('permission:update-service');
        Route::get('/delete/{service}', 'ServiceController@deleteService')->middleware('permission:delete-service');
        Route::post('/publish', 'ServiceController@publish')->middleware('permission:publish-service');
        Route::post('/ordering', 'ServiceController@ordering')->middleware('permission:ordering-service');
    });

    Route::group(['prefix' => 'partners', 'namespace' => 'Partner'], function () {
        Route::get('/', 'PartnerController@partners')->middleware('permission:view-partners');
        Route::get('/create', 'PartnerController@createPartner')->middleware('permission:create-partner');
        Route::post('/create', 'PartnerController@storePartner')->middleware('permission:create-partner');
        Route::get('/edit/{partner}', 'PartnerController@editPartner')->middleware('permission:update-partner');
        Route::post('/edit/{partner}', 'PartnerController@updatePartner')->middleware('permission:update-partner');
        Route::get('/delete/{partner}', 'PartnerController@deletePartner')->middleware('permission:delete-partner');
        Route::post('/publish', 'PartnerController@publish')->middleware('permission:publish-partner');
        Route::post('/ordering', 'PartnerController@ordering')->middleware('permission:ordering-partner');
    });

    Route::group(['prefix' => 'brands', 'namespace' => 'Brand'], function () {
        Route::get('/', 'BrandController@brands')->middleware('permission:view-brands');
        Route::get('/create', 'BrandController@createBrand')->middleware('permission:create-brand');
        Route::post('/create', 'BrandController@storeBrand')->middleware('permission:create-brand');
        Route::get('/edit/{brand}', 'BrandController@editBrand')->middleware('permission:update-brand');
        Route::post('/edit/{brand}', 'BrandController@updateBrand')->middleware('permission:update-brand');
        Route::get('/delete/{brand}', 'BrandController@deleteBrand')->middleware('permission:delete-brand');
        Route::post('/publish', 'BrandController@publish')->middleware('permission:publish-brand');
        Route::post('/ordering', 'BrandController@ordering')->middleware('permission:ordering-brand');
    });

    Route::group(['prefix' => 'videos', 'namespace' => 'Video'], function () {
        Route::get('/', 'VideoController@videos')->middleware('permission:view-videos');
        Route::get('/create', 'VideoController@createVideo')->middleware('permission:create-video');
        Route::post('/create', 'VideoController@storeVideo')->middleware('permission:create-video');
        Route::get('/edit/{video}', 'VideoController@editVideo')->middleware('permission:update-video');
        Route::post('/edit/{video}', 'VideoController@updateVideo')->middleware('permission:update-video');
        Route::get('/delete/{video}', 'VideoController@deleteVideo')->middleware('permission:delete-video');
        Route::post('/publish', 'VideoController@publish')->middleware('permission:publish-video');
        Route::post('/ordering', 'VideoController@ordering')->middleware('permission:ordering-video');
    });

    Route::group(['prefix' => 'admins', 'namespace' => 'Admin'], function () {
        Route::get('/', 'AdminController@admins')->middleware('permission:view-admins');
        Route::get('/create', 'AdminController@createAdmin')->middleware('permission:create-admin');
        Route::post('/create', 'AdminController@storeAdmin')->middleware('permission:create-admin');
        Route::get('/edit/{admin}', 'AdminController@editAdmin')->middleware('permission:update-admin');
        Route::post('/edit/{admin}', 'AdminController@updateAdmin')->middleware('permission:update-admin');
        Route::get('/delete/{admin}', 'AdminController@deleteAdmin')->middleware('permission:delete-admin');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web'], 'namespace' => 'Kakhura\LaravelSiteBases\Http\Controllers\Website'], function () {
    foreach (config('kakhura.site-bases.routes_mapper') as $module) {
        Route::group(['namespace' => Arr::get($module, 'namespace')], function () use ($module) {
            Route::get(sprintf('/%s', Arr::get($module, 'main_url')), sprintf('%s@%s', Arr::get($module, 'controller'), Arr::get($module, 'main_method_name')))->name(Arr::get($module, 'main_method_name'));
            if (Arr::get($module, 'item_url', false) && Arr::get($module, 'item_method_name', false)) {
                Route::get(sprintf('/%s/{%s}', Arr::get($module, 'main_url'), Arr::get($module, 'item_url')), sprintf('%s@%s', Arr::get($module, 'controller'), Arr::get($module, 'item_method_name')))->name(Arr::get($module, 'item_method_name'));
            }
        });
    }
});
