<?php

namespace App;

use App\Model;
use Laravel\Scout\Builder;
use Laravel\Scout\Searchable;
use phpDocumentor\Reflection\Types\Parent_;
use phpDocumentor\Reflection\Types\Static_;

class Post extends Model
{
    use Searchable;

    //セッティング内のタイプを定義
    public function searchableAs()
    {
        return "post";
    }

    //どの文字列の段落が検索対象になるかを定義
    public function toSearchableArray()
    {
      return[
          'title'=>$this->title,
          'content'=>$this->content,
      ];
    }

    //ユーザー表関連付ける
  public function user()
  {                                                 //user表のuser_id         postのid
      return $this->belongsTo('App\User','user_id','id');
  }

  //コメント表と関連 一対複数
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //いいね表とユーザー表と関連付け
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    //いいねの数
    public function zans()
    {
       return $this->hasMany(\App\Zan::class);
    }

    //某作者に属する文章を探し出す
    public function scopeAuthorBy(\Illuminate\Database\Eloquent\Builder $query,$user_id)
    {
        return $query->where('user_id',$user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }

    //某ジャンルに属しない文章
    public function scopeTopicNotBy(\Illuminate\Database\Eloquent\Builder $query,$topic_id)
    {
      return $query->doesntHave('postTopics','and',function($q) use ($topic_id){
          $q->where('topic_id',$topic_id);
      });
    }
    //グローバルscope
    protected static function boot()
    {
//        parent::boot();
//        static::addGlobalScope("avaiable",function (Builder $builder){
//            $builder->where('status',[0,1]);
//        });
    }

}
