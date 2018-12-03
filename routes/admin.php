<?php

//admin管理者画面
Route::group(['prefix'=>'admin'],function (){
    //ログイン画面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');

    //ログイン操作
    Route::post('/login','\App\Admin\Controllers\LoginController@login');

    //ログアウトアクション
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware'=>'auth:admin'],function (){

        //ホームページ
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware'=>'can:system'],function (){
            //管理者モジュール関係
            Route::get("/users",'\App\Admin\Controllers\UserController@index');
            //管理者を作る
            Route::get("/users/create",'\App\Admin\Controllers\UserController@create');
            //
            Route::post("/users/store",'\App\Admin\Controllers\UserController@store');
            //役割と管理者の関連付
            Route::get("/users/{user}/role",'\App\Admin\Controllers\UserController@role');
            //役割を修正
            Route::post("/users/{user}/role",'\App\Admin\Controllers\UserController@storeRole');

            //役割関連
            Route::get("/roles",'\App\Admin\Controllers\RoleController@index');
            Route::get("/roles/create",'\App\Admin\Controllers\RoleController@create');
            Route::post("/roles/store",'\App\Admin\Controllers\RoleController@store');
            //役割と権限の関係
            Route::get("/roles/{role}/permission",'\App\Admin\Controllers\RoleController@permission');
            Route::post("/roles/{role}/permission",'\App\Admin\Controllers\RoleController@storePermission');

            //権限
            //表示list
            Route::get("/permissions",'\App\Admin\Controllers\PermissionController@index');
            Route::get("/permissions/create",'\App\Admin\Controllers\PermissionController@create');
            Route::post("/permissions/store",'\App\Admin\Controllers\PermissionController@store');
        });

        Route::group(['middleware'=>'can:post'],function (){
            //審査
            Route::get('/posts','\App\Admin\Controllers\PostController@index');
            Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');
        });

        //カテゴリー
        Route::group(['middleware'=>'can:topic'],function (){
            Route::resource('topics','\App\Admin\Controllers\TopicController',['only'=>['index','create','create','store','destroy']]);
        });
        //通知

        Route::group(['middleware'=>'can:notice'],function (){

            Route::resource('notices','\App\Admin\Controllers\NoticeController',['only'=>['index','create','store']]);

        });




    });


});



