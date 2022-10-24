<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Order;
use App\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //
    public function checkOut(){
        $selectProvince = Province::all();
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $cart = Session::get('cart');
        if(isset($cart)){    
            return view('order.checkout',compact(
                'selectBrand',
                'selectCategory',
                'selectProvince'
            ));
        }
    }
    public function saveInfo(Request $request){
        $data = $request->all();
        // print_r($data);
        $validation = Validator::make($data,[
            'name_order' => ['required','string','max: 30'],
            'phone_order' => ['required','max:11','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'email_order' => ['required'],
            'type_shipping' => ['required'],
        ]);
        if($validation->fails()){
            return response()->json(['status' =>  0, 'error' => $validation->errors()->toArray()]);
        }else{
            $info = array(
                'nameOrder' => $data['name_order'],
                'phoneOrder' => $data['phone_order'],
                'addressOrder' => $data['address_order'],
                'emailOrder' => $data['email_order'],
                'typeShipping' => $data['type_shipping'],
                'totalOrder' => $data['total_order'],
            );
            Session::put('info',$info);
            return response()->json(['status' =>  1]);

        }
    }
    public function checkInfo(Request $request){
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $selectProvince = Province::all();
        // dd($data);
        return view('order.check_cart',compact(
            'selectBrand',
            'selectCategory',
            'selectProvince',
        ));
    }
    public function order(Request $request){
        $data = $request->all();
        $codeOrder = substr(md5(microtime()),rand(0,26),5);
        $dbOrder = array(
            'code_order' => $codeOrder,
            'name_customer' => $data['nameOrder'],
            'name_payment' => $data['namePayment'],
            'total_order' => $data['totalOrder'],
            'status_order' => $data['statusOrder'],
        );
        $order = Order::create($dbOrder);
        print_r($order);
    }
}
