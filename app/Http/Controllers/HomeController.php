<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Customer;
use App\Model\Slide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    //
    public function homePage(){
        $selectCategory = Category::all();
        $selectBrand = Brand::take(6)->get();
        // DB::enableQueryLog();
        $selectOutstanding = Product::take(10)->orderBy('updated_at','asc')->get();
        // $query = DB::getQueryLog();
        // dd($query);
        $selectSlide = Slide::take(6)->where('updated_at','<',Slide::max('updated_at'))->get();
        $selectFirstSlide = Slide::where('updated_at','=',Slide::max('updated_at'))->get();
        $selectProduct = Product::join('brand as b','b.id_brand','product.id_brand')->get();
        return view('home.page',compact(
            'selectCategory',
            'selectBrand',
            'selectProduct',
            'selectOutstanding',
            'selectSlide',
            'selectFirstSlide'
        ));
        // dd($selectFirstSlide);
    }
    public function loginForm(){
        return view('home.login');
    }
    public function register(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'password_register' => ['required','min:6','max:32','confirmed'],
            'password_register_confirmation' => ['required','min:6','max:32'],
            'email_register' => ['required', 'email'],
            'name_register' => ['required', 'string', 'max:30'],
        ])->validate();
        $imageRegister = 'person.png';
        $sex = array('Nam','Nữ');
        $firstPhone = array('08','09','07','03','05');
        $sexRandom = $sex[rand(0,count($sex) - 1)];
        $phoneCustomer = $firstPhone[rand(0,count($sex) - 1)].''.substr(str_shuffle("012345678"),0,8);
        $passwordCustomer = md5($data['password_customer']);
        $rePasswordCustomer = md5($data['password_customer_confirmation']);
        $db = array();
        $db['image_customer'] = $imageRegister;
        $db['name_customer'] = $data['name_customer'];
        $db['age_customer'] = rand(18,99);
        $db['sex_customer'] = $sexRandom;
        $db['email_customer'] = $data['email_customer'];
        $db['phone_customer'] = $phoneCustomer;
        $db['address_customer'] = '';
        $db['password_customer'] = $rePasswordCustomer;
        $db['facebook_id'] = '';
        $customer = Customer::create($db);
        if($customer){
            return view('home.login');
        }
    }
    public function login(Request $request){
        // DB::enableQueryLog();
        $data = $request->all();
        Validator::make($data,[
            'email_customer' => ['required','email'],
            'password_customer' => ['required','min:6','max:32'],
        ])->validate();
        $emailCustomer = $data['email_customer'];
        $passwordCustomer = $data['password_customer'];
        $dataAuth = [
            'email_customer' => $emailCustomer,
            'password_customer' => $passwordCustomer,
        ];
        $checkLogin = Customer::where('email_customer',$emailCustomer)->where('password_customer',md5($passwordCustomer))->first();
        // $query = DB::getQueryLog();
        // dd($checkLogin->name_customer);
        $idCustomer = $checkLogin['id_customer'];
        $nameCustomer = $checkLogin['name_customer'];
        $imageCustomer = $checkLogin['image_customer'];
        if($checkLogin){
            Session::put('id',$idCustomer);
            Session::put('usernameCustomer',$emailCustomer);
            Session::put('nameCustomer',$nameCustomer);
            Session::put('imageCustomer',$imageCustomer);
            return redirect()->route('home.page');
        }else{
            // return redirect()->back();
        }
        // if(Auth::attempt())
    }
    public function logout(){
        Session::put('username',null);
        Session::put('nameCustomer',null);
        Session::put('imageCustomer',null);
        return redirect()->route('home.page');
    }
    public function checkEmail(){
        return view('home.check_email');
    }
    public function sendEmail(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'email_customer' => ['required','email'],
        ])->validate();
        $email = $data['email_customer'];
        $checkEmail = Customer::where('email_customer',$email)->get();
        $name = $email;
        // dd($checkEmail->count());
        if($checkEmail->count() > 0){
            $data = array(
                'name' => 'Mail từ EShopper',
                'body' => 'yêu cầu thay đổi mật khẩu mới đến từ tài khoản '.$email,
                'email' => $email
            );
            Mail::send('home.go_email',$data,function($message) use ($email,$name){
                $message->to($email)->subject("Quên mật khẩu ở EShopper");
                $message->from($email,$name);
            });
            return view('home.email_notification');
        }else{
            Session::put('message','Email không hợp lệ, vui lòng nhập lại!');
            return redirect()->route('home.emailNotification');
        }
    }
    public function emailNotification(){
        return view('home.email_notification');
    }
    public function changePassword(Request $request){
        $email = $request->get('email');
        return view('home.change_pass',compact('email'));
    }
    public function savePassword(Request $request){
        $email = $request->get('email');
        $data = $request->all();
        Validator::make($data,[
            'password_customer' => ['required','min:6','max:32','confirmed'],
            'password_customer_confirmation' => ['required','min:6','max:32'],
        ])->validate();
        // dd($email);
        if(isset($email)){
            // DB::enableQueryLog();
            $customer = Customer::where('email_customer',$email)->first();
            $customer->password_customer = md5($data['password_customer_confirmation']);
            $savePassword = $customer->save();
            if($savePassword){
                return view('home.login');
            }
            // $query = DB::getQueryLog();
            // dd($query);
        }else{
            Session::put('message','Không có email!');
            return redirect()->route('home.checkEmail');
        }
    }
}