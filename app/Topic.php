<?php

namespace App;

use App\Model;

class Topic extends Model
{
    //ジャンルに属する文章を取得
    public function posts()
    {
        //多対多                                           postとtopics関連付用のテーブル   /post_topicsとtopic関連付のキー /postとpost_topics関連付のキー
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }

    //ジャンルに属する文章の数->withCount用
    public function postTopics()
    {                                                                        //topicのid
       return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}
