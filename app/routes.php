<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Validator::extend('DDEmail', function($attribute, $value, $parameters)
{
    $value = explode('@', $value);
    $domain = array_pop($value);
    return $domain == "doubledutch.me";
});

Route::get('/', array('before' => 'auth', 'uses' => 'HomeController@showMainPage'));

Route::group(array(), function()
{
    Route::resource('g', 'PageController');
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
    Route::resource('snack', 'SnackController');
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
    Route::resource('vote', 'VoteController');
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
    Route::resource('group', 'GroupController');
});

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
    Route::resource('comment', 'CommentController');
});

Route::group(array('before' => 'auth.basic'), function()
{
    Route::controller('export', 'ExportController');
});

Route::controller('users', 'UsersController');

Route::get('login', array('uses' => 'UsersController@login'));

Route::post('login', array('uses' => 'UsersController@postLogin'));

Route::post('prideLogin', array('uses' => 'UsersController@postPrideLogin'));

Route::get('logout', array('uses' => 'UsersController@logout'));

// legacy methods for getting data - should be removed
Route::get('top', array('before' => 'auth', 'uses' => 'ExportController@getTop'));
Route::get('export', array('before' => 'auth', 'uses' => 'ExportController@getExport'));
