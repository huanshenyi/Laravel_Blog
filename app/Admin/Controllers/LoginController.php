<?php
namespace App\Admin\Controllers;

class LoginController extends Controller
{

    //ログイン画面見せる
    public function index()
    {
       return view('admin.login.index');
    }

    //ログイン操作
    public function login()
    {
        //検証
        $this->validate(request(),[
            'name'=>'required|min:2',
            'password'=>'required|min:5|max:10',
        ]);
        //操作
        $user=request(['name','password']);
        if(\Auth::guard("admin")->attempt($user)){
            return redirect('/admin/home');
        }
        //ログイン失敗したら
        return \Redirect::back()->withErrors("データ見つかりません");
    }
    //ログアウトアクション
    public function logout()
    {
        \Auth::guard("admin")->logout();
        return redirect('/admin/login');


    }
}