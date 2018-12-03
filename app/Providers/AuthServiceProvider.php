<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    //postの権限入れる
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post'=>'App\Policies\PostPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //権限のルート設定
        //Gateの設定
        $permissions = \App\AdminPermission::all();
        foreach ($permissions as $permission){
            Gate::define($permission->name,function ($user)use($permission){
                return$user->hasPermission($permission);
            });
        }

        //
    }
}
