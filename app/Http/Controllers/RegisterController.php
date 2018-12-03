<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //新規ユーザー画面
    public function index()
    {
        return view('register.index');
    }

    //新規ユーザーアクション
    public function register()
    {
       //1.検証処理
        $this->validate(request(),[

            'name'=>'required|min:3|unique:users,name',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:5|max:10|confirmed',
        ],[
            //エラーメッセージ
            'name.min'=>'ユーザーネームは最低三文字',
            'name.unique'=>'ユーザーネーム既に存在します',
            'email.email'=>'メールのフォーマットが間違ってます',
            'email.unique'=>'このアドレス使用されてます',
            'password.confirmed'=>'二回の入力が合ってません',
        ]);
        //データベースへ保存
        $name=\request('name');
        $email=\request('email');
        //パスワードの暗号化
        $password=bcrypt( \request('password'));

        $user= User::create(compact('name','email','password'));
        //画面へ飛ぶ
        return redirect('login');

    }
}

