<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //ファンユーザーを取得
    public function fuser()
    {
        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    //フォローしたユーザーを取得する
    public function suser()
    {
        return $this->hasOne(\App\User::class,'id','star_id');
    }


}
