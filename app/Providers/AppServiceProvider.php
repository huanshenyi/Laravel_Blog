<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //ビューのcomposer方法使用
        \View::composer('layout.sidebar',function($view){
            //モデルからすべてのデータ取得
            $topics = \App\Topic::all();
            $view->with('topics',$topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
