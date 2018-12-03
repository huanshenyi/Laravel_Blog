<?php
namespace App\Admin\Controllers;

class RoleController extends Controller
{

    //役割(role) list page
    public function index()
    {
        $roles = \App\AdminRole::paginate(10);

        return view("/admin/role/index",compact('roles'));

    }

    //add role page
    public function create()
    {

        return view("/admin/role/add");
    }

    //add role action
    public function store()
    {
        $this->validate(request(),[
           'name'=>'required|min:3',
           'description'=>'required',
        ]);

        \App\AdminRole::create(request(['name','description']));

        return redirect('/admin/roles');
    }

    //role and permission 関係画面
    public function permission(\App\AdminRole $role)
    {
        //すべての権限を取得
        $permissions=\App\AdminPermission::all();
        //現在ユーザーの権限を取得
        $myPermissions = $role->permissions;

        return view("/admin/role/permission",compact('permissions','myPermissions','role'));
    }
    //role and permission save
    public function storePermission(\App\AdminRole $role)
    {
      $this->validate(request(),[
         'permissions'=>'required|array'
      ]);
      $permissions = \App\AdminPermission::findMany(request('permissions'));
      $myPermissions=$role->permissions;

      $addPermissions=$permissions->diff($myPermissions);
      foreach ($addPermissions as $permission){
          $role->grantPermission($permission);
      }

      $deletePermissions = $myPermissions->diff($permissions);
      foreach ($deletePermissions as $permission){
          $role->deletePermission($permission);
      }
      return back();
    }
}