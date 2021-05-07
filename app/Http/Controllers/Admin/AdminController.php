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
        return view('admin.home');
    }

    public function addProduct() 
    {
        return view('admin.add-product');
    }
}
