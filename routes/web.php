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
    Route::get('/menu/{id}/edit', 'MenuController@edit')->name('menu.edit');
    Route::post('/menu/store', 'MenuController@store')->name('menu.store');
    Route::post('/menu/setListOrder', 'MenuController@setListOrder')->name('menu.setListOrder');
    Route::post('/menu/delete', 'MenuController@delete')->name('menu.delete');

    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
    Route::post('/categories/setListOrder', 'CategoriesController@setListOrder')->name('categories.setListOrder');
    Route::get('/categories/create/{parentid}', 'CategoriesController@create')->name('categories.create');
    Route::post('/categories/store', 'CategoriesController@store')->name('categories.store');
    Route::post('/categories/delete', 'CategoriesController@delete')->name('categories.delete');
    Route::get('/categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');
    Route::patch('/categories/{id}', 'CategoriesController@update')->name('categories.update');

    Route::get('/articles/create/{catid}', 'ArticlesController@create')->name('articles.create');
    Route::post('/articles/store', 'ArticlesController@store')->name('articles.store');
});