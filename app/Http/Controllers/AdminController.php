<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use MongoDB\Driver\Session;

class AdminController extends Controller
{

    public function login(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $saved = $admin->save();
        if ($saved){
            return redirect()->back()->with('msg' , 'account created successfully');
        }else{
            return redirect()->back()->with('msg' , 'account not created ');
        }


    }

    public function loginAdmin(Request $request){
//        dd($request->all());
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $admin = Admin::where('email' , '=' , $request->email)->first();
//        dd($admin);
        if ($admin){
                if (Hash::check($request->password , $admin->password)){
//                    session()->put('loginId' , $admin->id);
                    return redirect('/');
                    Auth::guard('admin')->login();
                    return redirect()->back()->with('msg' , 'تم تسجيل الدخول');

                }else{
                    return redirect()->back()->with('msg' , 'email and password not match');
                }
        }else{
            return redirect()->back()->with('msg' , 'email not register');

        }
    }

    public function logout()
    {
        if (session()->has('loginId')){
            session()->pull('loginId');
            return redirect()->route('admin.login');
        }

    }

}
