<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function saveCart(Request $request){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('cart.cart_page',compact(
            'selectCategory',
            'selectBrand'
        ));
    }
}
