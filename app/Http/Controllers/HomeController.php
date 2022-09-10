<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;

class HomeController extends Controller
{
    //
    public function homePage(){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        $selectOutstanding = Product::take(6)->orderBy('updated_at','asc')->get();
        $selectProduct = Product::join('brand as b','b.id_brand','product.id_brand')->get();
        return view('home.page',compact(
            'selectCategory',
            'selectBrand',
            'selectProduct',
            'selectOutstanding'
        ));
    }
}
