<?php

namespace App;



class AdminPermission extends Model
{
    //
    protected $table="admin_permissions";
    //権限はどの役割にあるか
    public function roles()
    {
        //多対多
        return $this->belongsToMany(\App\AdminRole::class,'admin_permission_role','permission_id','role_id')
            ->withPivot(["permission_id","role_id"]);
    }
}
