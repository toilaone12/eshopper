<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\Product;
use App\Model\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

session_start();

class CartController extends Controller
{
    //
    public function checkCart(){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('cart.cart_page',compact(
            'selectCategory',
            'selectBrand'
        ));
    }
    public function addCart(Request $request){
        $data = $request->all();
        // dd($data);
        if($request->has('quantity_product')){
            $quantityProduct = $data['quantity_product'];
        }
        // echo $quantityProduct;
        $cart = Session::get('cart');
        $idProduct = $data['id_product'];
        $idProductColor = $data['id_product_color'];
        $product = Product::find($idProduct);
        $productColor = ProductColor::join('color as c','c.id_color','product_color.id_color')
        ->where('id_product_color',$idProductColor)->first();
        $imageProduct = $productColor->image_product_color;
        $nameProduct = $product->name_product;
        $colorProduct = $productColor->name_color;
        $priceProduct = $product->price_product;
        if(isset($quantityProduct)){
            $quantity = $quantityProduct;
        }else{
            $quantity = 1;
        }
        if(isset($cart[$idProductColor])){
            // echo $productColor->quantity_product_color;
            // echo $cart[$idProductColor]['quantityProduct'];
            $nowQuantity = $cart[$idProductColor]['quantityProduct'] + $quantity;
            if($nowQuantity > $productColor->quantity_product_color){
                return response()->json(["statusAdd" => "fail"],200);
            }else{
                $cart[$idProductColor]['quantityProduct'] = $cart[$idProductColor]['quantityProduct'] + $quantity;
            }
        }else{
            $cart[$idProductColor] = [
                "idProduct" => $idProduct,
                "idProductColor" => $idProductColor,
                "imageProduct" => $imageProduct,
                "nameProduct" => $nameProduct,
                "colorProduct" => $colorProduct,
                "quantityProduct" => $quantity,
                "priceProduct" => $priceProduct,
            ];
        }
        Session::put('cart',$cart);
        $count = count($cart);
        return response()->json(["statusGo" => "done","statusAdd" =>"done","count" => $count],200);
    }
    public function updateCart(Request $request){
        $id = $request->get('id_product');
        $idProductColor = $request->get('idProductColor');
        $product = ProductColor::where('id_product_color',$idProductColor)->first();
        $quantityProduct = $request->get('quantity_product');
        $cart = Session::get('cart');
        if(isset($cart[$idProductColor])){
            if($quantityProduct <= $product->quantity_product_color){
                $cart[$idProductColor]['quantityProduct'] = $quantityProduct;
            }else{
                $cart[$idProductColor]['quantityProduct'] = $cart[$idProductColor]['quantityProduct'];
            }
        }else{
            $cart[$idProductColor]['quantityProduct'] = $cart[$idProductColor]['quantityProduct'];
        }
        Session::put('cart',$cart);
        // return print_r($cart);
        echo "done";
    }
    public function removeCart(Request $request){
        $id = $request->get('id_product_color');
        $carts = Session::get('cart');
        unset($carts[$id]);
        Session::put('cart',$carts);
        if(count($carts) == 0){
            Session::forget('cart');
        }
        echo "done";
        // return print_r($data);
    }
    public function checkCoupon(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_coupon' => ['required'],
        ])->validate();
        $checkCoupon = Coupon::where('code_coupon',$data['name_coupon'])->first();
        // dd($checkCoupon);
        if($checkCoupon){
            $countCoupon = $checkCoupon->count();
            $checkDate = strtotime($checkCoupon->time_coupon);
            $date = strtotime(date("Y-m-d H:i:s"));
            // print_r($checkDate.'-'.$date);
            if($date < $checkDate){
                if($countCoupon > 0){
                    $couponSession = Session::get('coupon');
                    if($couponSession){
                        $available = 0;
                        if($available == 0){
                            $coupon[] = array(
                                'name_coupon' => $checkCoupon->name_coupon,
                                'code_coupon' => $checkCoupon->code_coupon,
                                'discount_coupon' => $checkCoupon->discount_coupon,
                                'quantity_coupon' => $checkCoupon->quantity_coupon,
                                'feature_coupon' => $checkCoupon->feature_coupon,
                            );
                            Session::put('coupon',$coupon);
                        }
                    }else{
                        $coupon[] = array(
                            'name_coupon' => $checkCoupon->name_coupon,
                            'code_coupon' => $checkCoupon->code_coupon,
                            'discount_coupon' => $checkCoupon->discount_coupon,
                            'quantity_coupon' => $checkCoupon->quantity_coupon,
                            'feature_coupon' => $checkCoupon->feature_coupon,
                        );
                        Session::put('coupon',$coupon);
                    }
                    Session::save();
                    return redirect()->back()->with('message',"Thêm mã giảm giá thành công");
                }
            }else{
                return redirect()->back()->with('message',"Mã giảm giá đã hết hạn");
            }
        }else{
            return redirect()->back()->with('message',"Mã giảm giá không tồn tại");
        }
    }
}
