<?php
namespace App\Admin\Controllers;

use \App\AdminUser;


class UserController extends Controller
{
    //管理者リスト
    public function index()
    {
        $users=AdminUser::paginate(10);
        return view('/admin/user/index',compact('users'));

    }

    //新規管理者画面
    public function create()
    {
        return view('/admin/user/add');

    }

    //新規管理者の操作
    public function store()
    {
      $this->validate(request(),[
          'name'=>'required|min:3',
          'password'=>'required'
      ]);

      $name=request('name');
      $password =bcrypt(request('password'));
      AdminUser::create(compact('name','password'));
      return redirect("/admin/users");
    }
    //管理者と役割画面
    public function role(\App\AdminUser $user)
    {
        $roles=\App\AdminRole::all();
        $myRoles=$user->roles;
       return view('/admin/user/role',compact('roles','myRoles','user'));
    }

    //ユーザーと役割を保存
    public function storeRole(\App\AdminUser $user)
    {
        $this->validate(request(),[
            'roles'=>'required|array'
        ]);
        $roles=\App\AdminRole::findMany(request('roles'));
        $myRoles=$user->roles;

        //増加の
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role)
        {
            $user->assignRole($role);
        }
        //削除の
        $deleteRoles=$myRoles->diff($roles);
        foreach ($deleteRoles as $role)
        {
            $user->deleteRole($role);
        }
        return back();

    }

}