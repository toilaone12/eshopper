<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
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
}
