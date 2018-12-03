<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    //showはモデルとリンクしてる
    public function show(Topic $topic)
    {
        //文章数つきのジャンルを渡す
        $topic=Topic::withCount('postTopics')->find($topic->id);

        //ジャンルの文章リスト,時間順配列(desc),10個取得
        $posts=$topic->posts()->orderBy('created_at','desc')->take(10)->get();

        //自分のまた投稿してない文章
        $myposts=\App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

       return view('topic/show',compact('topic','posts','myposts'));
    }

    //投稿
    public function submit(Topic $topic)
    {
        $this->validate(\request(),[

            'post_ids'=>'required|array'
        ]);
        $post_ids = \request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id)
        {
            //あれば取得なければ作る
            \App\PostTopic::firstOrCreate(compact('topic_id','post_id'));
        }
        return back();

    }
}
