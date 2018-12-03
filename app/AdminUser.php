<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $rememberTokenName='';
    protected $guarded=[];
    //ユーザーあるの役割
    public function roles()
    {
        //多対多の関係
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','user_id','role_id')
            ->withPivot(['user_id','role_id']);
    }
    //とある役割あるかどうかの判断
    public function isInRoles($roles)
    {
        return !!$roles->intersect($this->roles)->count();
    }

    //ユーザーに役割を与える
    public function assignRole($role)
    {

        return $this->roles()->save($role);
    }

    //ユーザーの役割をキャンセル
    public function deleteRole($role)
    {
        return $this->roles()->detach($role);
    }

    //ユーザーに権限あるかどうか
    public function hasPermission($permission)
    {
        return $this->isInRoles($permission->roles);
    }
}
