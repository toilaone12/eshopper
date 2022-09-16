<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Slide;

class HomeController extends Controller
{
    //
    public function homePage(){
        $selectCategory = Category::all();
        $selectBrand = Brand::take(6)->get();
        $selectOutstanding = Product::take(6)->orderBy('updated_at','asc')->get();
        $selectSlide = Slide::take(6)->where('updated_at','<',Slide::max('updated_at'))->get();
        $selectFirstSlide = Slide::where('updated_at','=',Slide::max('updated_at'))->get();
        $selectProduct = Product::join('brand as b','b.id_brand','product.id_brand')->get();
        return view('home.page',compact(
            'selectCategory',
            'selectBrand',
            'selectProduct',
            'selectOutstanding',
            'selectSlide',
            'selectFirstSlide',
        ));
        // dd($selectFirstSlide);
    }
    public function detailProduct($idProduct){
        $selectCategory = Category::all();
        $selectProductId = Product::join('category as c','c.id_category','product.id_category')->where('id',$idProduct)->first();
        $categoryId = $selectProductId->id_category;
        $selectProductByCategory = Product::where('id_category',$categoryId)->get();
        return view('home.detail_product',compact(
            'selectCategory',
            'selectProductId',
            'selectProductByCategory'
        ));
    }
}
