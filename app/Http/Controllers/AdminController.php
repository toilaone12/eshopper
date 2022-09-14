<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Model\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function login(){
        return view('admin.login');
    }
    public function dashboard(){
        $username = Session::get('username');
        if($username){
            return view('admin.content');
        }else{
            return redirect()->route('admin.login');
        }
    }
    public function saveLogin(Request $request){
        $data = $request->all();
        $userName = $data['username'];
        $pass = $data['pass'];
        $passMd5 = md5($data['pass']);
        // $remember = has('remember-me');
        Validator::make($data,[
            'username' => ['required','string','max:255'],
            'pass'=> ['max:32','min:6'],
        ])->validate();
        if($request->has('remember-me')){
            Cookie::queue('username',$userName,10);
            Cookie::queue('password',$pass,10);
            Cookie::queue('remember','',10);
        }else{
            Cookie::queue('username','',10);
            Cookie::queue('password','',10);
            Cookie::queue('no-remember','',10);
            $remember = Cookie::get('remember');
            if(isset($remember)){
                Cookie::forget('remember');
            }
        }
        // $checkLogin = Admin::where('name_admin',$userName)->where('password_admin',$passMd5)->first();
        // if($checkLogin){
        //     Session::put('username',$userName); 
        //     return redirect()->route('admin');
        // }else{
        //     return redirect()->route('admin.login');
        // }
        $dataAuth = [
            'name_admin' => $userName,
            'password_admin' => $pass,
        ];
        if(Auth::attempt($dataAuth)){
            Session::put('username',$userName); 
            return redirect()->route('admin');
            // echo Auth::attempt($dataAuth);
        }else{
            return redirect()->route('admin.login');
            // echo Auth::attempt($dataAuth);
        }
    }
    public function logout(){
        Session::put('username',null);
        return redirect()->route('admin.login');
    }
}
