<?php

namespace App;



class AdminRole extends Model
{
    //
    protected $table="admin_roles";

    //役割を持つ権限を取得
    public function permissions()
    {
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','role_id','permission_id')
            ->withPivot(['permission_id','role_id']);
    }

    //役割に権限を与える
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    //役割に与えた権限をキャンセル
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    //役割に権限あるかどうか
    public function hasPermission($permission)
    {
       return $this->permissions->contains($permission);
    }
}
