<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Model\Admin;
use App\Model\Role;
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
        $username = Session::get('usernameAdmin');
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
            Cookie::queue('usernameAdmin',$userName,10);
            Cookie::queue('password',$pass,10);
            Cookie::queue('remember','',10);
        }else{
            Cookie::queue('usernameAdmin','',10);
            Cookie::queue('password','',10);
            Cookie::queue('no-remember','',10);
            $remember = Cookie::get('remember');
            if(isset($remember)){
                Cookie::forget('remember');
            }
        }
        // $checkLogin = Admin::where('name_admin',$userName)->where('password_admin',$passMd5)->first();
        // if($checkLogin){
       // //     Session::put('username',$userName); 
        //     return redirect()->route('admin.dashboard');
        // }else{
        //     return redirect()->route('admin.login');
        // }
        $dataAuth = [
            'name_admin' => $userName,
            'password_admin' => $pass,
        ];
        $remember = $request->has('remember-me') ? true : false;
        if(Auth::attempt($dataAuth,$remember)){
            Session::put('usernameAdmin',$userName); 
            return redirect()->route('admin.dashboard');
            // echo Auth::attempt($dataAuth);
        }else{
            Session::put('message','Kiểm tra lại tài khoản và mật khẩu');
            return redirect()->route('admin.login');
            // echo Auth::attempt($dataAuth);
        }
    }
    public function logout(){
        Session::put('username',null);
        return redirect()->route('admin.login');
    }
    public function listUser(){
        $selectAdmin = Admin::all();
        return view('admin.list_admin',compact(
            'selectAdmin'
        ));
    }
    public function permissionAdmin(Request $request){ // cap quyen
        $data = $request->all();
        $name = $data['name_admin'];
        $role = $data['role'];
        $admin = Admin::where('name_admin',$name)->first();
        // print_r(Auth::check());
        if($role == 1){
            $admin->id_role = $role;
        }else if($role ==2){
            $admin->id_role = $role;
        }
        $admin->save();
        return redirect()->back();
    }
    public function deniedUser(Request $request){
        $idAdmin = $request->get('id');
        if(Auth::id() == $idAdmin){
            return redirect()->back()->with('message','Bạn không thể xóa quyền của chính mình');
        }else{
            $admin = Admin::find($idAdmin);
            $deniedUser = $admin->delete();
            if($deniedUser){
                return redirect()->back()->with('message','Xóa quyền thành công');
            }
        }
    }
    public function insertFormUser(){
        $role = Role::all();
        return view('user.insert_user',compact('role'));
    }
    public function insertUser(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'username' => ['required'],
            'password' => ['required','max:32','min:6'],
        ])->validate();
        $user = Admin::create([
            'name_admin' => $data['username'],
            'password_admin' => md5($data['password']),
            'id_role' => $data['name_role'],
        ]);
        if($user){
            return redirect()->route('admin.listUser')->with('message','Cấp tài khoản thành công');
        }else{
            return redirect()->route('admin.listUser')->with('message','Cấp tài khoản thất bại');
        }
    }
}
