<?php

namespace App;

use App\Model;

class Comment extends Model
{
    //コメントと文章
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    //コメントしたユーザーを取得するため
    //ユーザー表と関連
    public function user()
    {

        return $this->belongsTo('App\User');
    }


}
