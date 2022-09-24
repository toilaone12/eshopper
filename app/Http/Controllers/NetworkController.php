<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class NetworkController extends Controller
{
    //
    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callBackFacebook(){
        $sex = array('Nam','Nữ');
        $firstPhone = array('08','09','07','03','05');
        $sexRandom = $sex[rand(0,count($sex) - 1)];
        $phoneCustomer = $firstPhone[rand(0,count($sex) - 1)].''.substr(str_shuffle("012345678"),0,8);
        $provider = Socialite::driver('facebook')->stateless()->user();
        $saveUser = Customer::firstOrCreate([
            'facebook_id' => $provider->getId()],
            [   
                'image_customer' => $provider->getAvatar(),
                'name_customer' => $provider->getName(),
                'sex_customer' => $sexRandom,
                'phone_customer' => $phoneCustomer,
                'email_customer' => $provider->getEmail(),
                'address_customer' => '',
                'password_customer' => '',
                'age_customer' => rand(0,99),
            ]);
        Auth::loginUsingId($saveUser->id_user);
        Session::put("username",$provider->getEmail());
        Session::put("nameCustomer",$provider->getName());
        return redirect()->route('home.page');
    }
}
