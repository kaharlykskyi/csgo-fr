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
Route::get('/matches/{id}','MatchPageController@index')->name('match_page');
Route::post('/match-comment', 'MatchPageController@writeComment')->name('match_comment');

/*--------ADMIN--------*/
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth','role']],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::resource('/news', 'NewsController',['as' => 'admin']);
    Route::resource('/tournaments','TournamentController',['as' => 'admin']);
    Route::resource('/matches','MatchController',['as' => 'admin']);
});

Auth::routes();