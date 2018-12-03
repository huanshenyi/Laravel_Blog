<?php
namespace App\Admin\Controllers;

use App\AdminUser;

class PermissionController extends Controller
{

    //Permission list page
    public function index()
    {
        $permissions=\App\AdminPermission::paginate(10);
       return view('/admin/permission/index',compact('permissions'));

    }

    //permission action page
    public function create()
    {

        return view('/admin/permission/add');
    }
    //add permission action
    public function store()
    {

        $this->validate(request(),[
           'name'=>'required|min:3',
           'description'=>'required'
        ]);
        \App\AdminPermission::create(request(['name','description']));
        return redirect('/admin/permissions');

    }
}