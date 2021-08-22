<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;
    
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function adminLogin() 
    {
        return view('admin.login');
    }

    public function adminRegister() 
    {
        return view('admin.register');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $data = $request->all();
        $created = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);;
        
        if ($created) {
            return redirect()->route('admin-home');
        }else {
            return back()->with('fail', 'Something went wrong!');
        }
    } 
    public function check(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('admin-home');
        }
        return back()->with('fail', 'Invalid Email or Password');
    }
}
