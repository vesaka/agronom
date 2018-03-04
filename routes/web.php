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
Route::post('/message/post', ['as' => 'post.message', 'uses' => 'HomeController@post']);

Route::get('/',  ['as' => 'index', 'uses' => 'HomeController@index']);
Route::get('/start', ['as' => 'start', 'uses' => 'HomeController@index']);

Route::get('/за-нас', ['as' => 'about', 'uses' => function () {
    return view('company.about-us');
}]);

Route::get('/услуги', ['as' => 'services', 'uses' => 'HomeController@services']);
Route::get('/проекти', ['as' => 'projects', 'uses' => 'HomeController@projects']);
Route::get('/дейности', ['as' => 'activities', 'uses' => 'HomeController@activities']);

Route::get('/контакти', ['as' => 'contacts', 'uses' => function() {
    return view('company.contacts');
}]);

Route::post('/post', ['as' => 'post', 'uses' => 'HomeController@post']);
Route::get('/{type}/view/{slug}', ['as' => 'guest.view', 'uses' => 'HomeController@view']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/settings', 'SettingsController@index')->name('home');
    Route::get('/messages', ['as' => 'messages', 'uses' => 'MessageController@index']);
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::get('/', ['as' => 'index', 'uses' => 'SettingsController@index']);
        Route::get('/edit', ['as' => 'edit', 'uses' => 'SettingsController@edit']);
        Route::post('/update', ['as' => 'update', 'uses' => 'SettingsController@update']);
    });
    Route::group(['prefix' => 'service', 'as' => 'service.'], function() {
        Route::get('/', ['as' => 'list', 'uses' => 'ServiceController@index']);
        Route::get('/new', ['as' => 'new', 'uses' => 'ServiceController@create']);
        Route::post('/store/', ['as' => 'store', 'uses' => 'ServiceController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ServiceController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ServiceController@update']);
        Route::post('/delete/{id}', ['as' => 'remove', 'uses' => 'ServiceController@remove']);
        Route::get('/view/{id}', ['as' => 'view', 'uses' => 'ServiceController@view']);
    });

    Route::group(['prefix' => 'project', 'as' => 'project.'], function() {
        Route::get('/', ['as' => 'list', 'uses' => 'ProjectController@index']);
        Route::get('/new', ['as' => 'new', 'uses' => 'ProjectController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ProjectController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ProjectController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ProjectController@update']);
        Route::post('/delete/{id}', ['as' => 'remove', 'uses' => 'ProjectController@remove']);
        Route::get('/view/{id}', ['as' => 'view', 'uses' => 'ProjectController@view']);
    });

    Route::group(['prefix' => 'activity', 'as' => 'activity.'], function() {
        Route::get('/', ['as' => 'list', 'uses' => 'ActivityController@index']);
        Route::get('/new', ['as' => 'new', 'uses' => 'ActivityController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ActivityController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ActivityController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ActivityController@update']);
        Route::post('/delete/{id}', ['as' => 'remove', 'uses' => 'ActivityController@remove']);
        Route::get('/view/{id}', ['as' => 'view', 'uses' => 'ActivityController@view']);
    });

    Route::group(['prefix' => 'map', 'as' => 'map.'], function() {
        Route::get('/settings', ['as' => 'settings', 'uses' => 'MapController@settings']);
        Route::get('/save', ['as' => 'save', 'uses' => 'MapController@save']);
    });
});

Auth::routes();