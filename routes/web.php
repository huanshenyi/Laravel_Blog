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

Route::get('/', function () {
    return redirect('login');
});

//ユーザーフロントのログイン
//新規ユーザー画面
Route::get('register','RegisterController@index');
//新規ユーザーアクション
Route::post('register','RegisterController@register');
//ログイン画面
Route::get('login','LoginController@index')->name("login");
//ログインアクション
Route::post('login','LoginController@login');



Route::group(['middleware'=>'auth:web'],function (){

    //ログアウトアクション
    Route::get('logout','LoginController@logout');
    //個人設定
    Route::get('user/me/setting','UserController@setting');
    //個人設定アクション
    Route::post('user/me/setting','UserController@settingStore');



    //文章リスト
    Route::get('posts','PostController@index');
    //新しい文章
    Route::get('posts/create','PostController@create');
    Route::post('posts','PostController@store');

    //検索エンジン
    Route::get('posts/search','PostController@search');

    //文章詳細
    Route::get('posts/{post}','PostController@show');

    Route::post('posts','PostController@store');
    //文章編集
    Route::get('posts/{post}/edit','PostController@edit');
    Route::Put('posts/{post}','PostController@update');
    //削除
    Route::get('posts/{post}/delete','PostController@delete');

    //画像アップロード
    Route::post('/posts/image/upload','PostController@imageUpload');

    //コメントする
    Route::post('/posts/{post}/comment','PostController@comment');

    //いいね！機能
    Route::get('/posts/{post}/zan','PostController@zan');

    //いいね！キャンセル
    Route::get('/posts/{post}/unzan','PostController@unzan');

    //プロフィール
    Route::get('/user/{user}','UserController@show');
    //フォロー
    Route::post('/user/{user}/fan','UserController@fan');
    //フォローキャンセル
    Route::post('/user/{user}/unfan','UserController@unfan');

    //文章カテゴリー
    Route::get('/topic/{topic}','TopicController@show');
    //ユーザーが自分の文章をカテゴリーへと投稿
    Route::post('/topic/{topic}/submit','TopicController@submit');
    //通知
    Route::get('/notices','\App\Http\Controllers\NoticeController@index');
});

include_once ('admin.php');


