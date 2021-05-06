<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
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
            $request->session()->put('LoggedAdmin', $created->id);
            return redirect()->route('admin-home');
        }else {
            return back()->with('fail', 'Something went wrong!');
        }
    } 
    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('email',$request->email)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $request->session()->put('LoggedAdmin', $admin->id);
                return redirect()->route('admin-home');
            }else {
                return back()->with('fail', 'Invalid Password');
            }

        }else{
            return back()->with('fail', 'Invalid Email or Password');
        }
    }
    public function logOut() 
    {
        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');
            return redirect()->route('admin-login');
        }
    }
}
