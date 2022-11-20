<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\Province;
use App\Model\Statistic;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    //admin
    public function listOrder(){
        $selectOrder = Order::all();
        return view('order.list_order',compact('selectOrder'));
    }
    public function detailOrder($codeOrder){
        $selectOrder = Order::where('code_order',$codeOrder)->first();
        $selectDetailOrder = OrderDetail::where('code_order',$codeOrder)->get();
        $nameCoupon = $selectOrder->coupon_order;
        if($nameCoupon !== ''){
            $selectCoupon = Coupon::where('name_coupon',$nameCoupon)->first();
        }else{
            $selectCoupon = 0;
        }
        return view('order.detail_order',compact(
            'selectDetailOrder',
            'selectOrder',
            'selectCoupon'
        ));
    }
    public function printPDF($codeOrder){
        $selectOrder = Order::where('code_order',$codeOrder)->first();
        $selectDetailOrder = OrderDetail::where('code_order',$codeOrder)->get();
        $nameOrder = $selectOrder->name_customer;
        $nameCoupon = $selectOrder->coupon_order;
        if($nameCoupon !== ''){
            $selectCoupon = Coupon::where('name_coupon',$nameCoupon)->first();
        }else{
            $selectCoupon = 0;
        }
        $pdf = FacadePdf::loadView('order.file_pdf',compact(
            'selectOrder',
            'selectDetailOrder',
            'selectCoupon'
        ));
        return $pdf->download('Hóa đơn của '.$nameOrder.'.pdf');
    }
    public function changeStatus(Request $request){
        $data = $request->all();
        print_r($data);
        $orderId = $data['orderId'];
        $status = $data['status'];
        $quantityOrder = $data['quantityOrder'];
        $productId = $data['productId'];
        $totalOrder = $data['totalOrder'];
        $changeStatus = Order::find($orderId);
        $changeStatus->status_order = $status;
        $changeStatus->save();
        if($changeStatus->status_order == 2){
            $date_order = $changeStatus->updated_at;
            $date_order = date("Y-m-d",strtotime($changeStatus->updated_at));
            $statistic = Statistic::where('date_statistic',$date_order)->get();
            // print_r($statistic);
            $allQuantity = 0;
            foreach($quantityOrder as $keyQuantity => $q){
                $allQuantity+=$q;
            }
            if(count($statistic) == 1){
                $quantityStatistic = $statistic[0]->quantity_statistic;
                $totalStatistic = $statistic[0]->price_statistic;
                $quantityAll = $allQuantity + $quantityStatistic;
                // print_r($allQuantity);
                $totalAll = $totalOrder + $totalStatistic;
                $statistic->toQuery()->update([
                    'quantity_statistic' => $quantityAll,
                    'price_statistic' => $totalAll,
                    'date_statistic' => $date_order,
                ]);
                // echo "1";
            }else{
                $quantityAll = $allQuantity;
                $totalAll = $totalOrder;
                $arrayStatistic = array(
                    'quantity_statistic' => $quantityAll,
                    'price_statistic' => $totalAll,
                    'date_statistic' => $date_order,
                );
                $createStatistic = Statistic::create($arrayStatistic);
                // print_r($createStatistic);
            }
        }else if($changeStatus->status_order == 3){
            foreach($productId as $keyProduct => $p){
                $product = Product::find($p);
                $quantity = $product->quantity_product;
                $quantitySold = $product->quantity_sold_product;
                foreach($quantityOrder as $keyQuantity => $q){
                    if($keyProduct == $keyQuantity){
                        if($quantitySold <= $quantity){
                            $product->quantity_sold_product -= $q;
                            $product->quantity_product += $q;
                            $product->save();
                        }else{
                            echo "Hết";
                        }
                    }
                }
            }
        }
    }
    //page
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
        }else{
            return redirect()->route('cart.checkCart');
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
        $cart = Session::get('cart');
        if(isset($cart)){
            // dd($data);
            return view('order.check_cart',compact(
                'selectBrand',
                'selectCategory',
                'selectProvince'
            ));
        }else{
            return redirect()->route('cart.checkCart');
        }
    }
    public function order(Request $request){
        $data = $request->all();
        $email = $data['emailOrder'];
        $name = $data['nameOrder'];
        $codeOrder = substr(md5(microtime()),rand(0,26),5);
        // $coupon = Session::get('coupon');
        if($data['discountOrder'] !== ''){
            $coupon = Coupon::where('name_coupon',$data['discountOrder'])->get();
            if(count($coupon) == 1){
                $quantityCoupon = $coupon[0]->quantity_coupon;
                $quantityAfter = $quantityCoupon - 1;
                $coupon[0]->quantity_coupon = $quantityAfter;
                $coupon[0]->save();
            }
        }
        $dbOrder = array(
            'code_order' => $codeOrder,
            'name_customer' => $name,
            'phone_order' => $data['phoneOrder'],
            'email_order' => $email,
            'address_order' => $data['addressOrder'],
            'name_payment' => $data['namePayment'],
            'total_order' => $data['totalOrder'],
            'type_shipping' => $data['statusOrder'],
            'coupon_order' => $data['discountOrder'],
            'fee_delivery' => $data['feeDelivery'],
            'status_order' => 0,
        );
        $order = Order::create($dbOrder);
        if($order){
            $cart = Session::get('cart');
            $dbOrderDetail = '';
            foreach($cart as $key => $c){
                $dbOrderDetail = array(
                    'id_product' => $key,
                    'code_order' => $codeOrder,
                    'name_product_order' => $c['nameProduct'],
                    'quantity_product_order' => $c['quantityProduct'],
                    'price_product_order' => $c['priceProduct'],
                );
                $orderDetail = OrderDetail::create($dbOrderDetail);
                $productId = array($key);
                $quantityOrder = array($c['quantityProduct']);
                foreach($productId as $keyProduct => $p){
                    $product = Product::find($p);
                    $productColor = ProductColor::where('id_product',$p)->first();
                    foreach($quantityOrder as $keyQuantity => $q){
                        $product->quantity_sold_product += $q;
                        $productColor->quantity_product_color -= $q;
                        $checkProduct = $product->save();
                        $productColor->save();
                        if($checkProduct){
                            $data = array(
                                'name' => $data['nameOrder'],
                                'body' => 'Bạn vừa mua một đơn hàng từ eShopper',
                                'email' => $data['emailOrder'],
                                'codeOrder' => $codeOrder,
                            );
                            Mail::send('order.email_order',$data,function($message) use ($email,$name){
                                $message->to($email)->subject("Hóa đơn từ eShopper");
                                $message->from($email,$name);
                            });
                            Session::forget('$cart');
                            Session::forget('$fee');
                            Session::forget('$coupon');
                            Session::flush();
                        }else{
                        }
                    }
                }
            }
        }
    }
}
