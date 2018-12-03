<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //ログイン画面
    public function index()
    {
        if(\Auth::check() ){
             return \redirect("posts");
        }
        return view('login.index');
    }

    //ログインアクション
    public function login()
    {
         //1.検証

        $this->validate(\request(),[
            'email'=>'required|email',
            'password'=>'required|min:5|max:10',
            'is_remember'=>'integer'
        ]);
        //セッションへ保存
        $user=\request(['email','password']);
        $is_remember = boolval(\request('is_remember'));
        if(Auth::attempt($user,$is_remember))
        {
            //ログイン成功
            return redirect('posts');
        }

        return Redirect::back()->withErrors('ユーザーとパスワード合ってません');
        //画面を表示
    }

    //ログアウトアクション
    public function logout()
    {

        Auth::logout();
        return redirect('login');
    }
}
