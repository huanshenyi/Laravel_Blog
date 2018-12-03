<?php
namespace App\Admin\Controllers;

class HomeController extends Controller
{

    //ホームページ
    public function index()
    {
        return view('admin.home.index');

    }

}