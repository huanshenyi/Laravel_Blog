<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //プロフィール画面
    public function setting()
    {
        $user = \Auth::user();
       return view('user.setting',compact('user'));
    }

    //プロフィールアクション
    public function settingStore(Request $request)
    {
        //データ受け取り ,画像の拡張子の確認はまた今度

        //検証
        $this->validate(\request(),[
            'name'=>'required|min:3',
        ]);

        //操作
        $name = \request('name');
        $user = \Auth::user();
        //もしデータベースの名前と違う,ネームの操作がある
        if($name!= $user->name)
        {
          if(User::where('name',$name)->count()>0)
          {
              return back()->withErrors('ユーザーネーム存在します');
          }

          $user->name = $name;
        }

        if($request->file('avatar'))
        {
            $path = $request->file('avatar')->storePublicly($user->id);
            $user->avatar = "/storage/".$path;
        }

        $user->save();

        //画面
        return back();
    }

    //プロフィール画面
    public function show(User $user)
    {
        //該当ユーザーのデータ フォロー　フォロワー　文章データ
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //最初の10件を取得
        $posts=$user->posts()->orderBy('created_at','desc')->take(10)->get();
        //フォローしたユーザーのフォロー関係データ
        $stars=$user->stars;
                                                              //数を取得した
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //フォロワーを取得する　及びフォロワーのデータ
        $fans=$user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user/show',compact('user','posts','susers','fusers'));
    }

    //ユーザーをフォロー
    public function fan(User $user)
    {

        $me = \Auth::user();
        $me->doFan($user->id);
        //ajax使用してjsonを返す
        return[
            'error'=>0,
            'msg'=>''
        ];
    }

    //フォローキャンセル
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnfan($user->id);
        //ajax使用してjsonを返す
        return[
          'error'=>0,
            'msg'=>''
        ];
    }

}
