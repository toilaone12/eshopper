<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function categoryList(){
        $selectList = Category::all();
        //compact: nhan 1 tham so, moi tham so chua 1 bien hoac 1 mang
        return view('category.list_category',compact('selectList'));
    }
}
