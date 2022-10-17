<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    public function checkOut(){
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $cart = Session::get('cart');
        if(isset($cart)){    
            return view('order.checkout',compact(
                'selectBrand',
                'selectCategory'
            ));
        }
    }
}
