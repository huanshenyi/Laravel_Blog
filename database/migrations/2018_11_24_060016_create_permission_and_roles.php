<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //役割表
        Schema::create('admin_roles',function(Blueprint $table){
           $table->increments('id');
           $table->string('name',30)->default('');
           $table->string('description',100)->default('');
           $table->timestamps();
        });

        //権限表
        Schema::create('admin_permissions',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->default('');
            $table->string('description',100)->default('');
            $table->timestamps();
        });

        //権限役割表
        Schema::create('admin_permission_role',function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->timestamps();
        });
        //ユーザー役割表
        Schema::create('admin_role_user',function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_roles');
        Schema::drop('admin_permissions');
        Schema::drop('admin_permission_role');
        Schema::drop('admin_role_user');

    }
}
