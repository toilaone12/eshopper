<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;

class CategoryController extends Controller
{
    //admin
    public function categoryList(){
        $getCategory = Category::all();
        //compact: nhan 1 tham so, moi tham so chua 1 bien hoac 1 mang
        return view('category.list_category',compact('getCategory'));
    }
    public function formInsertCategory(){
        return view('category.insert_category');
    }
    public function insertCategory(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_category' => ['required','unique:category'],
        ])->validate();
        $db = array();
        $db['name_category'] = $data['name_category'];
        $insertCategory = Category::create($db);
        // dd(Category::all())
        if($insertCategory){
            Session::put('message',"Thêm mới danh mục ".$data['name_category']." thành công!");
            return redirect()->route('category.listCategory');
        }else{
            Session::put('message',"Thêm mới danh mục ".$data['name_category']." không thành công!");
            return redirect()->route('category.insertFormCategory');
        }
    }
    public function editFormCategory($idCategory){
        $findCategory = Category::find($idCategory);
        return view('category.edit_category',compact('findCategory'));
    }
    public function editCategory(Request $request, $idCategory){
        $data = $request->all();
        Validator::make($data,[
            'name_category' => ['required','unique:category'],
        ])->validate();
        $category = Category::find($idCategory);
        $category->name_category = $data['name_category'];
        $editCategory = $category->save();
        if($editCategory){
            Session::put('message','Sửa thành công danh mục '.$data['name_category']);
            return redirect()->route('category.listCategory');
        }
    }
    public function deleteCategory($idCategory){
        $deleteCategory = Category::where('id_category',$idCategory)->delete();
        if($deleteCategory){
            Session::put('message','Xóa thành công danh mục!');
            return redirect()->route('category.listCategory');
        }else{
            Session::put('message','Xóa không thành công danh mục!');
            return redirect()->route('category.listCategory');
        }
    }

    //page
    public function productByCategory($nameCategory, Request $request){
        // $isChecked = $data['checked'];
        $filterPrice = $request->get('filterPrice');
        $min = $request ->get('min');
        $max = $request ->get('max');
        $searchProduct = $request->get('search');
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        $selectByCategory = Category::where('name_category',$nameCategory)->first();
        // DB::enableQueryLog();
        $selectProductByCategory = Product::join('category as ca','ca.id_category','product.id_category')
        ->where('ca.name_category',$nameCategory);
        if($filterPrice == 'asc' || $filterPrice == 'desc'){
            $selectProductByCategory = $selectProductByCategory
            ->orderBy('product.price_product',$filterPrice);
        }
        if(isset($searchProduct)){
            $selectProductByCategory = $selectProductByCategory
            ->where('product.name_product','like','%'.$searchProduct.'%');
        }
        if($filterPrice == 'name'){
            $selectProductByCategory = $selectProductByCategory
            ->orderBy('product.name_product','asc'); 
        }
        if($filterPrice == 'evaluate'){
            $selectProductByCategory = $selectProductByCategory->orderBy('product.number_comments','asc');
        }
        if($filterPrice == 'popular'){
            $selectProductByCategory = $selectProductByCategory->orderBy('product.number_views','asc');
        }
        if(isset($max)){
            $selectProductByCategory = $selectProductByCategory
            ->where('product.price_product','<=',$max);
        }
        if(isset($max) && isset($min)){
            $selectProductByCategory = $selectProductByCategory
            ->whereBetween('product.price_product',$min,$max);
        }
        if(isset($min)){
            $selectProductByCategory = $selectProductByCategory
            ->where('product.price_product','>=',$min);
        }
        $selectProductByCategory = $selectProductByCategory->paginate(10);
        // $query = DB::getQueryLog();
        // dd($query);
        $numberFindProduct = count($selectProductByCategory);
        // dd($selectProductByCategory);
        return view('category.page_category',compact(
            'selectCategory',
            'selectBrand',
            'selectByCategory',
            'selectProductByCategory',
            'searchProduct',
            'numberFindProduct',
            'max',
            'min'
        )); //compact: truyen du lieu cho view
    }
}
