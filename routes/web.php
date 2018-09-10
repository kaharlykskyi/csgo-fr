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

/*--------FORUM--------*/
Route::group(['prefix' => 'forum'], function (){
    Route::get('/','ForumController@index')->name('forum_topics');
    Route::get('/topic-page/{id}','ForumController@topicPage')->name('topic_page');
    Route::match(['get', 'post'],'/create-thread','ForumController@createThread')->name('add_thread')->middleware('auth');
    Route::get('/topic-page/{id}/thread-page/{thread_id}','ForumController@threadPost')->name('thread_page');
    Route::post('/create-post','ForumController@createPost')->name('create_post')->middleware('auth');
    Route::get('/thread-action/{id}/{action}','ForumController@threadAction')->name('thread_action')->middleware(['auth','role']);
    Route::get('/post-delete/{id}','ForumController@postDelete')->name('post_delete')->middleware(['auth','role']);
});

Route::get('/matches/{id}/{type?}','MatchPageController@index')->name('match_page');
Route::post('/match-comment', 'MatchPageController@writeComment')->name('match_comment');
Route::post('/match-comment-like','MatchPageController@like')->name('match_comment_like')->middleware('auth');

Route::get('/news/{id}','NewsPageController@index')->name('news_page');
Route::post('/news-comment', 'NewsPageController@writeComment')->name('news_comment');
Route::post('/news-comment-like','NewsPageController@like')->name('news_comment_like')->middleware('auth');

Route::get('/tournament/{id}','TournamentPageController@index')->name('tournament_page');
Route::post('/tournament-comment', 'TournamentPageController@writeComment')->name('tournament_comment');
Route::post('/tournament-comment-like','TournamentPageController@like')->name('tournament_comment_like')->middleware('auth');

Route::get('/player/{nickname}','PlayerController@index')->name('player_page');

Route::get('/team/{name}','TeamController@index')->name('team_page');

Route::get('/latest-matches','LatestMatchesController@index')->name('latest_matches');

/*--------ADMIN--------*/
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth','role']],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::resource('/news', 'NewsController',['as' => 'admin']);
    Route::resource('/tournaments','TournamentController',['as' => 'admin']);
    Route::resource('/matches','MatchController',['as' => 'admin']);
    Route::resource('/streams', 'StreamController', ['as' => 'admin']);
    Route::resource('/players','PlayerController',['as' => 'admin']);
    Route::resource('/teams','TeamController',['as' => 'admin']);
    Route::resource('/news-category','NewsCategoryController',['as' => 'admin']);
    Route::resource('/forum-topic','ForumTopicController',['as' => 'admin']);
    Route::resource('/gallery','GalleryController',['as' => 'admin']);
    Route::resource('/image','ImageController',['as' => 'admin']);
});


Auth::routes();