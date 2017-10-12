<?php

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destroy')->name('logout');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('users', 'UsersController');

//    Route::get('/login', 'SessionsController@create')->name('login');
//    Route::post('/login', 'SessionsController@store')->name('login');
//    Route::delete('/logout', 'SessionsController@destroy')->name('logout');

    Route::get('/configs', 'ConfigsController@index')->name('configs.index');
    Route::post('/configs/setConfig', 'ConfigsController@setConfig')->name('configs.setConfig');

    Route::resource('posids', 'PosidsController');
    Route::post('/posids/delete', 'PosidsController@delete')->name('posids.delete');

    Route::get('/types/{id}', 'TypesController@index')->name('types.index');

    Route::get('/menu', 'MenuController@index')->name('menu.index');
    Route::get('/menu/create/{parentid}', 'MenuController@create')->name('menu.create');
    Route::post('/menu/store', 'MenuController@store')->name('menu.store');
    Route::post('/menu/delete', 'MenuController@delete')->name('menu.delete');
    Route::get('/menu/{id}/edit', 'MenuController@edit')->name('menu.edit');
    Route::patch('/menu/{id}', 'MenuController@update')->name('menu.update');
    Route::post('/menu/setListOrder', 'MenuController@setListOrder')->name('menu.setListOrder');

    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
    Route::post('/categories/setListOrder', 'CategoriesController@setListOrder')->name('categories.setListOrder');
    Route::get('/categories/create/{parentid}', 'CategoriesController@create')->name('categories.create');
    Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
    Route::post('/categories/delete', 'CategoriesController@delete')->name('categories.delete');
    Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::patch('/categories/{id}', 'CategoriesController@update')->name('categories.update');

    Route::get('/articles/create/{catid}', 'ArticlesController@create')->name('articles.create');
    Route::post('/articles/store', 'ArticlesController@store')->name('articles.store');
    Route::get('/articles', 'ArticlesController@index')->name('articles.index');
    Route::get('/articles/{article}/edit', 'ArticlesController@edit')->name('articles.edit');
    Route::post('/articles/delete', 'ArticlesController@delete')->name('articles.delete');
    Route::patch('/articles/{article}', 'ArticlesController@update')->name('articles.update');
    Route::post('/articles/setListOrder', 'ArticlesController@setListOrder')->name('articles.setListOrder');

    Route::get('/products', 'ProductsController@index')->name('products.index');
    Route::get('/products/create/{catid}', 'ProductsController@create')->name('products.create');
    Route::post('/products/store', 'ProductsController@store')->name('products.store');
    Route::get('/products/{product}/edit', 'ProductsController@edit')->name('products.edit');
    Route::patch('/products/{product}', 'ProductsController@update')->name('products.update');
    Route::post('/products/setListOrder', 'ProductsController@setListOrder')->name('products.setListOrder');
    Route::post('/products/delete', 'ProductsController@delete')->name('products.delete');

    Route::get('/pictures', 'PicturesController@index')->name('pictures.index');
    Route::get('/pictures/create/{catid}', 'PicturesController@create')->name('pictures.create');
    Route::post('/pictures/store', 'PicturesController@store')->name('pictures.store');
    Route::get('/pictures/{picture}/edit', 'PicturesController@edit')->name('pictures.edit');
    Route::patch('/pictures/{picture}', 'PicturesController@update')->name('pictures.update');
    Route::post('/pictures/setListOrder', 'PicturesController@setListOrder')->name('pictures.setListOrder');
    Route::post('/pictures/delete', 'PicturesController@delete')->name('pictures.delete');

    Route::get('/downloads', 'DownloadsController@index')->name('downloads.index');
    Route::get('/downloads/create/{catid}', 'DownloadsController@create')->name('downloads.create');
    Route::post('/downloads/store', 'DownloadsController@store')->name('downloads.store');
    Route::get('/downloads/{download}/edit', 'DownloadsController@edit')->name('downloads.edit');
    Route::patch('/downloads/{download}', 'DownloadsController@update')->name('downloads.update');
    Route::post('/downloads/setListOrder', 'DownloadsController@setListOrder')->name('downloads.setListOrder');
    Route::post('/downloads/delete', 'DownloadsController@delete')->name('downloads.delete');

    Route::get('/feedbacks', 'FeedbacksController@index')->name('feedbacks.index');
    Route::get('/feedbacks/{feedback}/edit', 'FeedbacksController@edit')->name('feedbacks.edit');
    Route::patch('/feedbacks/{feedback}', 'FeedbacksController@update')->name('feedbacks.update');
    Route::post('/feedbacks/setListOrder', 'FeedbacksController@setListOrder')->name('feedbacks.setListOrder');
    Route::post('/feedbacks/delete', 'FeedbacksController@delete')->name('feedbacks.delete');

    Route::get('/guestbooks', 'GuestbooksController@index')->name('guestbooks.index');
    Route::post('/guestbooks/setListOrder', 'GuestbooksController@setListOrder')->name('guestbooks.setListOrder');
    Route::get('/guestbooks/{guestbook}/edit', 'GuestbooksController@edit')->name('guestbooks.edit');
    Route::patch('/guestbooks/{guestbook}', 'GuestbooksController@update')->name('guestbooks.update');
    Route::post('/guestbooks/delete', 'GuestbooksController@delete')->name('guestbooks.delete');

    Route::get('/modules/{type}', 'ModulesController@index')->name('modules.index');
    Route::get('/modules/{name}/colums', 'ModulesController@colums')->name('modules.colums');
    Route::get('/modules/{module}/edit', 'ModulesController@edit')->name('modules.edit');
    Route::patch('/modules/{module}', 'ModulesController@update')->name('modules.update');
    Route::post('/modules/setStatus', 'ModulesController@setStatus')->name('modules.setStatus');
    Route::post('/modules/delete', 'ModulesController@delete')->name('modules.delete');

    Route::get('/links', 'LinksControllerController@index')->name('links.index');
});