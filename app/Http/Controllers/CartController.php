<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
session_start();

class CartController extends Controller
{
    //
    public function checkCart(){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('cart.cart_page',compact(
            'selectCategory',
            'selectBrand',
        ));
    }
    public function addCart(Request $request){
        $data = $request->all();
        if($request->has('quantity_product')){
            $quantityProduct = $data['quantity_product'];
        }
        $cart = Session::get('cart');
        $idProduct = $data['id_product'];
        $product = Product::find($idProduct);
        $imageProduct = $product->image_product;
        $nameProduct = $product->name_product;
        $priceProduct = $product->price_product;
        if(isset($quantityProduct)){
            $quantity = $quantityProduct;
        }else{
            $quantity = 1;
        }
        if(isset($cart[$idProduct])){
            $cart[$idProduct]['quantityProduct'] = $cart[$idProduct]['quantityProduct'] + $quantity;
        }else{
            $cart[$idProduct] = [
                "imageProduct" => $imageProduct,
                "nameProduct" => $nameProduct,
                "quantityProduct" => $quantity,
                "priceProduct" => $priceProduct,
            ];
        }
        echo "done";
        Session::put('cart',$cart);
        return redirect()->route('cart.checkCart');
        // // $check = Session::get('cart');
        // return print_r($cart);
        // echo "done";
        // return view('cart.cart_page',compact(
        //     'selectCategory',
        //     'selectBrand',
        //     'cart'
        // ));
    }
    public function updateCart(Request $request){
        $id = $request->get('id_product');
        $product = Product::find($id);
        $quantityProduct = $request->get('quantity_product');
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            if($quantityProduct <= $product->quantity_product){
                $cart[$id]['quantityProduct'] = $quantityProduct;
            }else{
                $cart[$id]['quantityProduct'] = $cart[$id]['quantityProduct'];
            }
        }else{
            $cart[$id]['quantityProduct'] = $cart[$id]['quantityProduct'];
        }
        Session::put('cart',$cart);
        // return print_r($cart);
        echo "done";
    }
    public function removeCart(Request $request){
        $id = $request->get('id_product');
        $carts = Session::get('cart');
        unset($carts[$id]);
        Session::put('cart',$carts);
        if(count($carts) == 0){
            Session::flush();
        }
        echo "done";
        // return print_r($data);
    }
}
