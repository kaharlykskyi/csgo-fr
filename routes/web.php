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

/*!!--------SITE--------!!*/

Route::get('/', 'HomeController@index')->name('home');
Route::post('/search','SearchController@index')->name('search');

/*--------CHAT--------*/
Route::group(['prefix' => 'chat', 'middleware' => ['auth']], function (){
    Route::get('/','ChatController@index')->name('all_chats');
    Route::match(['get', 'post'],'/send-massage/{name}','ChatController@sendMassage')->name('send_massage');
});

/*--------PROFILE--------*/
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function (){
    Route::get('/','ProfileController@index')->name('profile');
    Route::get('/send-confirm','ProfileController@sendConfirm')->name('send_confirm');
    Route::get('/confirm-email','ProfileController@confirmEmail')->name('confirm_email');
    Route::post('/upload-avatar','ProfileController@uploadAvatar')->name('upload_avatar');
    Route::get('/delete-avatar','ProfileController@deleteAvatar')->name('delete_avatar');
    Route::match(['get', 'post'],'/edit','ProfileController@editProfile')->name('edit_profile');
    Route::match(['get', 'post'],'/change-password','ProfileController@changePassword')->name('change_password');
});
Route::get('/profile/{name}','ProfileController@showProfile')->name('show_profile');

/*--------FORUM--------*/
Route::group(['prefix' => 'forum'], function (){
    Route::get('/','ForumController@index')->name('forum_topics');
    Route::get('/thread-page/{id}','ForumController@topicPage')->name('topic_page');
    Route::match(['get', 'post'],'/create-thread','ForumController@createThread')->name('add_thread')->middleware('auth');
    Route::get('/thread-page/{id}/topic-page/{thread_id}','ForumController@threadPost')->name('thread_page');
    Route::post('/create-post','ForumController@createPost')->name('create_post')->middleware('auth');
    Route::get('/thread-action/{id}/{action}','ForumController@threadAction')->name('thread_action')->middleware(['auth','role']);
    Route::get('/post-delete/{id}','ForumController@postDelete')->name('post_delete')->middleware(['auth','role']);
});

/*--------GALLERY--------*/
Route::group(['prefix' => 'gallery'], function (){
    Route::get('/','GalleryController@index')->name('gallery');
    Route::get('/{name}','GalleryController@gallery')->name('gallery_page');
});

/*--------MATCH--------*/
Route::get('/matches/{id}/{type?}','MatchPageController@index')->name('match_page');
Route::post('/match-comment', 'MatchPageController@writeComment')->name('match_comment');
Route::post('/match-comment-like','MatchPageController@like')->name('match_comment_like')->middleware('auth');
Route::get('/latest-matches','LatestMatchesController@index')->name('latest_matches');
Route::post('/match-voting','MatchPageController@matchVoting')->name('match_voting')->middleware('auth');

/*--------NEWS--------*/
Route::get('/news/{id}','NewsPageController@index')->name('news_page');
Route::post('/news-comment', 'NewsPageController@writeComment')->name('news_comment');
Route::post('/news-comment-like','NewsPageController@like')->name('news_comment_like')->middleware('auth');
Route::get('/all-news', 'NewsPageController@allNews')->name('all_news');

/*--------TOURNAMENT--------*/
Route::get('/tournament/{id}','TournamentPageController@index')->name('tournament_page');
Route::post('/tournament-comment', 'TournamentPageController@writeComment')->name('tournament_comment');
Route::post('/tournament-comment-like','TournamentPageController@like')->name('tournament_comment_like')->middleware('auth');
Route::get('/all-tournaments', 'TournamentPageController@allTournaments')->name('all_tournaments');

Route::get('/player/{nickname}','PlayerController@index')->name('player_page');

Route::get('/team/{name}','TeamController@index')->name('team_page');

Route::get('/stream/{name}/{service}/{id?}',function ($name,$service,$id = null){
    return view('stream_page.index',compact('name','service','id'));
})->name('stream_page');

Route::get('/delete-comment/{id}','HomeController@deleteComment')->middleware(['auth','role'])->name('delete_comment');
Route::post('/edit-comment','HomeController@editComment')->middleware(['auth'])->name('edit_comment');

/*!!--------ADMIN--------!!*/
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth','role']],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::match(['get', 'post'],'/users','DashboardController@users')->name('admin.users');
    Route::post('/users-access','DashboardController@access')->name('admin.access');
    Route::post('/users-moderators','DashboardController@moderators')->name('admin.moderators')->middleware('moderation');
    Route::match(['get', 'post'],'/announcement','DashboardController@announcement')->name('announcement');
    Route::match(['get', 'post'],'/settings','DashboardController@settings')->name('settings');

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
    Route::resource('/video','VideoController',['as' => 'admin']);
    Route::resource('/banner-image','BannerImageController',['as' => 'admin']);
    Route::resource('/forum-category','ForumCategoryController',['as' => 'admin']);
    Route::resource('/match-map','MatchMapController',['as' => 'admin']);
});


Auth::routes();