<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Coupon;
use App\Model\Delivery;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\Province;
use App\Model\Statistic;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $selectDetailOrder = OrderDetail::join('product_color as pc','pc.id_product_color','order_detail.color_product_order')
        ->join('color as c','c.id_color','pc.id_color')
        ->where('code_order',$codeOrder)->get();
        // dd($selectDetailOrder);
        $nameCoupon = $selectOrder->coupon_order;
        if($nameCoupon !== ''){
            $selectCoupon = Coupon::where('name_coupon',$nameCoupon)->first();
        }else{
            $selectCoupon = 0;
        }
        // dd($selectDetailOrder);
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
        ))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('H??a ????n c???a '.$nameOrder.'.pdf');
    }
    public function changeStatus(Request $request){
        $data = $request->all();
        // print_r($data);
        $orderId = $data['orderId'];
        $status = $data['status'];
        $quantityOrder = $data['quantityOrder'];
        $productId = $data['productId'];
        $productColorId = $data['productColorId'];
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
                $totalAll = $totalOrder + $totalStatistic;
                $statistic->toQuery()->update([
                    'quantity_statistic' => $quantityAll,
                    'price_statistic' => $totalAll,
                    'date_statistic' => $date_order,
                ]);
            }else{
                $quantityAll = $allQuantity;
                $totalAll = $totalOrder;
                $arrayStatistic = array(
                    'quantity_statistic' => $quantityAll,
                    'price_statistic' => $totalAll,
                    'date_statistic' => $date_order,
                );
                Statistic::create($arrayStatistic);
                // print_r($createStatistic);
            }
        }else if($changeStatus->status_order == 3){
            foreach($productColorId as $keyProductColor => $pc){
                foreach($productId as $keyProduct => $p){
                    $product = Product::find($p);
                    $productColor = ProductColor::where('id_product',$p)->where("id_color",$pc)->first();
                    if($keyProduct == $keyProductColor){
                        $quantity = $productColor->quantity_product_color;
                        $quantitySold = $product->quantity_sold_product;
                        foreach($quantityOrder as $keyQuantity => $q){
                            if($keyProduct == $keyQuantity){
                                $product->quantity_sold_product -= $q;
                                $productColor->quantity_product_color += $q;
                                $productColor->save();
                                $product->save();
                            }
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
        $priceDelivery = "";
        // print_r($data);
        $validation = Validator::make($data,[
            'name_order' => ['required','string','max: 30'],
            'phone_order' => ['required','max:11','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'email_order' => ['required'],
            'type_shipping' => ['required'],
            'address_order' => ['required'],
            'fee_delivery' => ['required']
        ],
        [
            'required' => 'D??? li???u n??y kh??ng ???????c ????? tr???ng, y??u c???u nh???p l???i!',
            'string' => 'D??? li???u ph???i l?? chu???i k?? t???, y??u c???u nh???p l???i!',
            'max' => 'D??? li???u qu?? k?? t??? cho ph??p, y??u c???u nh???p l???i!'
        ]
        );
        if($validation->fails()){
            return response()->json(['status' =>  0, 'error' => $validation->errors()->toArray()]);
        }else{
            $province = $data['fee_delivery'];
            Session::get('fee');
            if($province == 1){
                $delivery = Delivery::where('province_feeship',1)->get();
                foreach($delivery as $key => $d){
                    $priceDelivery = $d->price_feeship;
                }
            }else if($province == 0){
                $priceDelivery = 0;
            }else{
                $delivery = Delivery::where('province_feeship',$province)->get();
                foreach($delivery as $key => $d){
                    $priceDelivery = $d->price_feeship;
                }
            }
            $info = array(
                'nameOrder' => $data['name_order'],
                'phoneOrder' => $data['phone_order'],
                'addressOrder' => $data['address_order'],
                'emailOrder' => $data['email_order'],
                'typeShipping' => $data['type_shipping'],
                'totalOrder' => $data['total_order'],
            );
            Session::put('fee',$priceDelivery);
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
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url); // tai nguyen curl
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // du lieu 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // thiet lap true khi truy van
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); //thiet lap ket noi trong vong 
        //execute post
        $result = curl_exec($ch); // thuc hien truy van y/c
        //close connection
        curl_close($ch);
        return $result;
    }
    public function paymentWithMomo($total,$codeOrder){
        $totalOrder = preg_replace('/[^0-9\-]/','',$total);
        // print_r($filterTotal);
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh to??n qua MoMo";
        $amount = $totalOrder;
        // $orderId = time() ."";
        $redirectUrl = route('cart.checkCart');
        $ipnUrl = route('cart.checkCart');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $codeOrder . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey); //tao ra chu ky so
        // dd($signature);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $codeOrder,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        return $jsonResult['payUrl'];
        //Just a example, please check more in there

        // header('Location: ' . $jsonResult['payUrl']);
    }
    public function paymentWithVnpay($total,$codeOrder){
        $totalOrder = preg_replace('/[^0-9\-]/','',$total);
        $vnp_TmnCode = "B4RZJMOA"; //Website ID in VNPAY System
        $vnp_HashSecret = "NBZQOJBRWPKGEIKLBLOILROSJXDUMXBP"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('cart.checkCart');
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $vnp_TxnRef = $codeOrder; //M?? ????n h??ng. Trong th???c t??? Merchant c???n insert ????n h??ng v??o DB v?? g???i m?? n??y sang VNPAY
        $vnp_OrderInfo = "Thanh to??n b???ng VNPAY";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $totalOrder * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'VISA';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if ($codeOrder != "") {
                return $vnp_Url;
                die();
            } else {
                return json_encode($returnData);
            }
    }
    public function order(Request $request){
        $data = $request->all();
        $email = $data['emailOrder'];
        $name = $data['nameOrder'];
        $typePayment = $data['typeCard'];
        $totalOrder = $data['totalOrder'];
        $codeOrder = substr(md5(microtime()),rand(0,26),5);
        $coupon = Session::get('coupon');
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
            $cartOrder = Session::get('cart');
            $dbOrderDetail = '';
            // dd($cart);
            foreach($cartOrder as $key => $c){
                $productIdColor = array($key);
                $quantityOrder = array($c['quantityProduct']);
                $productColor = ProductColor::find($key);
                $dbOrderDetail = array(
                    'id_product_color' => $key,
                    'id_product' => $c['idProduct'],
                    'code_order' => $codeOrder,
                    'name_product_order' => $c['nameProduct'],
                    'color_product_order' => $productColor->id_product_color,
                    'quantity_product_order' => $c['quantityProduct'],
                    'price_product_order' => $c['priceProduct'],
                );
                $orderDetail = OrderDetail::create($dbOrderDetail);    
                foreach($productIdColor as $keyProductColor => $p){
                    $product = Product::find($productColor->id_product);
                    foreach($quantityOrder as $keyQuantity => $q){
                        $product->quantity_sold_product += $q;
                        $productColor->quantity_product_color -= $q;
                        $checkProduct = $product->save();
                        $productColor->save();
                        if($checkProduct){
                            $data = array(
                                'name' => $data['nameOrder'],
                                'body' => 'B???n v???a mua m???t ????n h??ng t??? eShopper',
                                'email' => $data['emailOrder'],
                                'codeOrder' => $codeOrder,
                            );
                            Mail::send('order.email_order',$data,function($message) use ($email,$name){
                                $message->to($email)->subject("H??a ????n t??? eShopper");
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
            if($typePayment == 0){
                $paymentWithMomo = $this->paymentWithMomo($totalOrder,$codeOrder);
                return $paymentWithMomo;
            }else if($typePayment == 1){
                $paymentWithVnpay = $this->paymentWithVnpay($totalOrder,$codeOrder);
                return $paymentWithVnpay;
            }
        }
    }

    public function checkDelivery(){
        $selectCategory = Category::all();
        $selectBrand = Brand::take(6)->get();
        return view('order.check_delivery',compact(
            'selectCategory',
            'selectBrand'
        ));
    }
    public function filterDelivery(Request $request){
        $data = $request->all();
        $phoneOrder = $data['phone_order'];
        $codeOrder = $data['code_order'];
        Validator::make($data,[
            'phone_order' => ['required'],
            'code_order' => ['required']
        ],
        [
            'required' => "Th??ng tin b??? thi???u y??u c???u ??i???n v??o"
        ])->validate();
        $filterDelivery = Order::where('order.phone_order',$phoneOrder)->where('order.code_order',$codeOrder)
        ->first();
        // echo $filterDelivery->status_order;
        if(isset($filterDelivery) && $filterDelivery->status_order !== 3){
            DB::enableQueryLog();
            $detailOrder = OrderDetail::join('product_color as pc','pc.id_product_color','order_detail.color_product_order')
            ->join('color as c','c.id_color','pc.id_color')
            ->where('order_detail.code_order',$codeOrder)
            ->get();
            // dd(DB::getQueryLog());
            $selectCategory = Category::all();
            $selectBrand = Brand::take(6)->get();
            return view('order.history_order',compact(
                'detailOrder',
                'selectCategory',
                'selectBrand',
                'filterDelivery'
            ));
        }else if($filterDelivery->status_order == 3){
            Session::put('error','????n h??ng n??y ???? ???????c h???y b???!');
            return redirect()->route('order.checkDelivery');
        }else{  
            Session::put('error','Kh??ng t??m th???y m?? ????n h??ng b???n v???a nh???p!');
            return redirect()->route('order.checkDelivery');
        }
    }

    public function cancelOrder(Request $request){
        $data = $request->all();
        $statusOrder = $data['statusOrder'];
        $idOrder = $data['idOrder'];
        $changeStatus = Order::find($idOrder);
        $changeStatus->status_order = $statusOrder;
        $changeStatus->save();
        if(isset($changeStatus)){
            return response()->json(['message'=>'done'],200);
        }else{
            return response()->json(['message'=>'error'],200);
        }
    }
}
