<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    //
    public function brandList(){
        $selectBrand = Brand::all();
        return view('brand.list_brand',compact('selectBrand'));
    }
    public function formInsertBrand(){
        return view('brand.insert_brand');
    }
    public function insertBrand(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_brand' => ['required','unique:brand'],
            'desc_brand' => ['required']
        ])->validate();
        $insertBrand = Brand::create([
            'name_brand' => $data['name_brand'],
            'desc_brand' => $data['desc_brand'],
        ]);
        if($insertBrand){
            Session::put('message','Thêm thương hiệu '.$data['name_brand'].' thành công!');
            return redirect()->route('brand.listBrand');
        }
    }
    public function formEditBrand($idBrand){
        $findBrand = Brand::find($idBrand);
        return view('brand.edit_brand',compact('findBrand'));
    }
    public function editBrand(Request $request,$idBrand){
        $data = $request->all();
        Validator::make($data,[
            'name_brand' => ['required','unique:brand'],
            'desc_brand' => ['required']
        ])->validate();
        $brand = Brand::find($idBrand);
        $brand->name_brand = $data['name_brand'];
        $brand->desc_brand = $data['desc_brand'];
        $editBrand = $brand->save();
        if($editBrand){
            Session::put('message','Sửa thương hiệu '.$data['name_brand'].' thành công!');
            return redirect()->route('brand.listBrand');
        }
    }

    public function deleteBrand($idBrand){
        $deleteBrand = Brand::where('id_brand',$idBrand)->delete();
        if($deleteBrand){
            Session::put('message','Xóa thương hiệu thành công!');
            return redirect()->route('brand.listBrand');
        }else{
            Session::put('error','Xóa thương hiệu không thành công!');
            return redirect()->route('brand.listBrand');
        }
    }
}
