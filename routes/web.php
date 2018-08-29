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

/*--------SITE--------*/

Route::get('/', 'HomeController@index')->name('home');
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function (){
    Route::get('/','ProfileController@index')->name('profile');
    Route::get('/send-confirm','ProfileController@sendConfirm')->name('send_confirm');
    Route::get('/confirm-email','ProfileController@confirmEmail')->name('confirm_email');
});
Route::get('/matches/{id}/{type?}','MatchPageController@index')->name('match_page');
Route::post('/match-comment', 'MatchPageController@writeComment')->name('match_comment');

Route::get('/news/{id}','NewsPageController@index')->name('news_page');
Route::post('/news-comment', 'NewsPageController@writeComment')->name('news_comment');

Route::get('/tournament/{id}','TournamentPageController@index')->name('tournament_page');
Route::post('/tournament-comment', 'TournamentPageController@writeComment')->name('tournament_comment');

Route::get('/player/{nickname}','PlayerController@index')->name('player_page');

/*--------ADMIN--------*/
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth','role']],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::resource('/news', 'NewsController',['as' => 'admin']);
    Route::resource('/tournaments','TournamentController',['as' => 'admin']);
    Route::resource('/matches','MatchController',['as' => 'admin']);
    Route::resource('/streams', 'StreamController', ['as' => 'admin']);
    Route::resource('/players','PlayerController',['as' => 'admin']);
    Route::resource('/teams','TeamController',['as' => 'admin']);
});

Auth::routes();