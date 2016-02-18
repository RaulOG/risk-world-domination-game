<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    include('Routes/Auth.php');

    Route::get('/', 'LandingController@index')->name('landing');

    Route::get('/welcome', 'WelcomeController@index')->name('welcome');

    Route::resource('users', 'UsersController');

    Route::post('games', 'GamesController@store')->name('games.store');
    Route::get('games/join', 'GamesController@join')->name('games.join');
    Route::get('games/{id}/start', 'GamesController@start')->name('games.start');
    Route::post('games/{id}/action', 'GamesController@action')->name('games.action');
    Route::get('games/{id}', 'GamesController@show')->name('games.show');
});
