<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;

class AdminController extends Controller
{
    public function home() 
    {
        $admin = Admin::where('id', session('LoggedAdmin'))->first();
        $data = [
            'LoggedAdminInfo' =>  $admin
        ];
        return view('admin.index')->with($data);
    }
}
