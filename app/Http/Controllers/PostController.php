<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //リストページ
    public function index()
    {                                           //関連表のデータ数を取得   //ページング
        $posts=Post::orderBy('created_at','desc')->withCount(["comments","zans"])->paginate(6);

        return view('post.index',compact('posts'));
    }

    //文章詳細
    public function show(Post $post)
    {
        $post->load('comments');
        return view('post.show',['post'=>$post]);
    }

    //新しい文章
    public function create()
    {
       return view('post.create');
    }

    //新しい文章の受け取り
    public function store()
    {
        //検証
       $this->validate(request(),[
          //検証条件
           'title'=>'required|string|max:100|min:5',
           'content'=>'required|string|min:10',
       ],[
           //エラーメッセージ
           'title.min'=>'タイトルは最低５文字必要',
           'title.required'=>'タイトルは記入しなければならない',
           'content.required'=>'内容記入しなければならない'
       ]) ;
       //ユーザーデータを保存
        $user_id = Auth::id();
        $params = array_merge(\request(['title','content']),compact('user_id'));

        $post=Post::create($params);

       return redirect("/posts");
    }

    //文章編集
    public function edit(Post $post)
    {

       return view('post.edit',compact('post'));

    }

    //文章編集の具体的な処理
    public function update(Post $post)
    {
        //検証
        $this->validate(request(),[
            //検証条件
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10',
        ],[
            //エラーメッセージ
            'title.min'=>'タイトルは最低５文字必要',
            'title.required'=>'タイトルは記入しなければならない',
            'content.required'=>'内容記入しなければならない'
        ]) ;
        //post権限
        $this->authorize('update',$post);

        //
        $post->title=request('title');
        $post->content=request('content');
        $post->save();

        //view
        return redirect("/posts/{$post->id}");

    }
    //文章削除
    public function delete(Post $post)
    {
        //ユーザー権限を確認
        $this->authorize('delete',$post);

        $post->delete();
        return redirect("/posts");

    }

    //画像アップロード
    public function imageUpload(Request $request)
    {
        $path= $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/'.$path);
    }

    //コメント提出
    public function comment(Post $post)
    {

        //検証
        $this->validate(request(),[
            'content'=>'required|min:3',
        ]);

        //処理
        $comment = new Comment();
        $comment->user_id=\Auth::id();
        $comment->content = \request('content');
        $post->comments()->save($comment);
        //画面
        return back();

    }

    //いいね
    public function zan(Post $post)
    {
        $param=[
            'user_id'=>\Auth::id(),
            'post_id'=>$post->id,
        ];

          //firstOrCreateもしあれば探すなければ追加
        Zan::firstOrCreate($param);
        return back();
    }

    //いいねキャンセル
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    //検索結果表示
    public function search()
    {
        //検証
        $this->validate(\request(),[
           'query'=>'required'
        ]);
        //処理
        $query=\request('query');
        $posts = \App\Post::search($query)->paginate(2);
        //ビューへ

        return view("post/search",['posts'=>$posts,'query'=>$query]);
    }
}
