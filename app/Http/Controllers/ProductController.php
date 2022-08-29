<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index(){
        $get_product = DB::table('product')->get();
        return view('product.index')->with('g_product',$get_product);
    }
}
