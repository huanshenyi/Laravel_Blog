<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //注入可のカラムを設定
    protected $fillable=[
        'name','email','password'
    ];

    //ユーザーの文章リスト
    public function posts()
    {
        return $this->hasMany(\App\Post::class,'user_id','id');
    }

    //フォロワー Fanモデル
    public function fans()
    {
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    //フォローしたユーザーモデル
    public function stars()
    {
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    //誰かをフォロー
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    //フォローをキャンセル
    public function doUnfan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    //誰かにフォローされたかどうか
    public function hasFan($uid)
    {
        //もしあればリターン値は0より大きい

        return $this->fans()->where('fan_id',$uid)->count();
    }

    //誰かに対して現在ユーザーフォローしたかどうか
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

    //ユーザー受ける通知
    public function notices()
    {

        return $this->belongsToMany(\App\Notice::class,'user_notice','user_id','notice_id')
            ->withPivot(['user_id','notice_id']);
    }

    //ユーザーに通知を増やす
    public function addNotice($notice)
    {

        return $this->notices()->save($notice);
    }

}
