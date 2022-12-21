<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    //
    public function brandList(){
        $getBrand = Brand::all();
        return view('brand.list_brand',compact('getBrand'));
    }
    public function formInsertBrand(){
        return view('brand.insert_brand');
    }
    public function insertBrand(Request $request){
        $data = $request->all();
        $image = $request->file('logo_brand');
        if($image){
            if($image->getSize() < 2000000){
                $nameImage = $image->getClientOriginalName();
                $currentImage = current(explode('.',$nameImage));
                $extensionImage = $image->extension(); // lay duoi ten file
                $newImage = $currentImage.'.'.$extensionImage;
                $image->move('images/brand',$newImage);
                Validator::make($data,[
                    'name_brand' => ['required','unique:brand'],
                    'desc_brand' => ['required']
                ])->validate();
                $insertBrand = Brand::create([
                    'name_brand' => $data['name_brand'],
                    'desc_brand' => $data['desc_brand'],
                    'logo_brand' => $newImage,
                ]);
                if($insertBrand){
                    Session::put('message','Thêm thương hiệu '.$data['name_brand'].' thành công!');
                    return redirect()->route('brand.listBrand');
                }
            }else{
                echo "1";
            }
        }else{
            echo "2";

        }    
    }
    public function formEditBrand($idBrand){
        $findBrand = Brand::find($idBrand);
        return view('brand.edit_brand',compact('findBrand'));
    }
    public function editBrand(Request $request,$idBrand){
        $data = $request->all();
        $image = $request->file('logo_brand');
        if($image){
            if($image->getSize() < 2000000){
                $nameImage = $image->getClientOriginalName();
                $currentImage = current(explode('.',$nameImage));
                $extensionImage = $image->extension(); // lay duoi ten file
                $newImage = $currentImage.'.'.$extensionImage;
                $image->move('images/brand',$newImage);
                Validator::make($data,[
                    'name_brand' => ['required'],
                    'desc_brand' => ['required']
                ])->validate();
                $brand = Brand::find($idBrand);
                $brand->name_brand = $data['name_brand'];
                $brand->desc_brand = $data['desc_brand'];
                $brand->logo_brand = $newImage;
                $editBrand = $brand->save();
                if($editBrand){
                    Session::put('message','Sửa thương hiệu '.$data['name_brand'].' thành công!');
                    return redirect()->route('brand.listBrand');
                }
            }else{
                echo "1";
            }
        }else{
            Validator::make($data,[
                'name_brand' => ['required'],
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
    }

    public function deleteBrand($idBrand){
        $deleteBrand = Brand::where('id_brand',$idBrand)->delete();
        $deleteProduct = Product::where('id_brand',$idBrand)->delete();
        if($deleteBrand){
            Session::put('message','Xóa thương hiệu thành công!');
            return redirect()->route('brand.listBrand');
        }else{
            Session::put('error','Xóa thương hiệu không thành công!');
            return redirect()->route('brand.listBrand');
        }
    }
    public function productByBrand($nameBrand,Request $request){
        $filterPrice = $request->get('filterPrice');
        $min = $request->get('min');
        $max = $request->get('max');
        $searchProduct = $request->get('search');
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        $selectByBrand = Brand::where('name_brand',$nameBrand)->first();
        // DB::enableQueryLog();
        $errorFilter = "";
        $selectProductByBrand = Product::join('brand as b','b.id_brand','product.id_brand')
        ->where('b.name_brand',$nameBrand);
        if($filterPrice == 'asc' || $filterPrice == 'desc'){
            $selectProductByBrand = $selectProductByBrand
            ->orderBy('product.price_product',$filterPrice);
        }
        if(isset($searchProduct)){
            $selectProductByBrand = $selectProductByBrand
            ->where('product.name_product','like','%'.$searchProduct.'%');
        }
        if($filterPrice == 'name'){
            $selectProductByBrand = $selectProductByBrand
            ->orderBy('product.name_product','asc'); 
        }
        if($filterPrice == 'evaluate'){
            $selectProductByBrand = $selectProductByBrand->orderBy('product.number_comments','asc');
        }
        if($filterPrice == 'popular'){
            $selectProductByBrand = $selectProductByBrand->orderBy('product.number_views','asc');
        }
        if(isset($max)){
            $selectProductByBrand = $selectProductByBrand
            ->where('product.price_product','<=',$max);
        }
        if(isset($max) && isset($min)){
            if($max < $min){
                $errorFilter = "Lỗi lọc giá yêu cầu lọc lại!";
            }else if($max == "" || $min == ""){
                $selectProductByBrand = $selectProductByBrand;
            }else{
                $selectProductByBrand = $selectProductByBrand
                ->where('product.price_product','<=',$max)
                ->where('product.price_product','>=',$min);
            }
        }
        if(isset($min)){
            $selectProductByBrand = $selectProductByBrand
            ->where('product.price_product','>=',$min);
        }
        $selectProductByBrand = $selectProductByBrand->paginate(10);
        // $query = DB::getQueryLog();
        // dd($query);
        $numberFindProduct = count($selectProductByBrand);
        // dd($selectProductByBrand);
        return view('brand.page_brand',compact(
            'selectCategory',
            'selectBrand',
            'selectByBrand',
            'selectProductByBrand',
            'searchProduct',
            'numberFindProduct',
            'errorFilter',
            'max',
            'min'
        )); //compact: truyen du lieu cho view
    }
}
