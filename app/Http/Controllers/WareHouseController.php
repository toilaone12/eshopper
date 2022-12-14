<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WareHouseController extends Controller
{
    //
    public function listWareHouse(){
        $wareHouse = WareHouse::join('color as c','c.id_color','warehouse.id_color')->get();
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('warehouse.list_warehouse',compact(
            'wareHouse',
            'selectCategory',
            'selectBrand',
        ));
    }
    public function exportProduct(Request $request){
        $data = $request->all();
        $db = array();
        $colorProduct = $data['color_product'];
        $priceProduct = $data['price_product'];
        $quantityWareHouse = $data['quantity_product'];
        $imageProductColor = $request->file('image_product_color');
        // DB::enableQueryLog();
        $product = Product::where('name_product',$data['name_product'])->get();
        $wareHouse = WareHouse::where('name_product_warehouse',$data['name_product'])->where('id_color',$colorProduct)->get();
        $wareHouse->toQuery()->update([
            'quantity_product_warehouse' => 0,
        ]);
        // $query = DB::getQueryLog();
        // dd($query);
        if(count($product) == 1){
            $priceWareHouse = $product[0]->price_product_warehouse;
            if($priceProduct < $priceWareHouse){
                Session::put('messageWareHouse',"Giá bán sản phẩm của cửa hàng phải lớn hơn giá nhập hàng!");
                return redirect()->route('warehouse.listWareHouse'); // k sử dụng redirect::to. 
            }else{
                // DB::enableQueryLog();
                $productColor = ProductColor::where('id_color',$colorProduct)->where('id_product',$product[0]->id)->get();
                // dd(count($productColor));
                // dd(DB::getQueryLog());

                if(count($productColor) == 1){
                    $quantityProduct = $productColor[0]->quantity_product_color;
                    $quantityAll = $quantityProduct + $quantityWareHouse;
                    $productColor->toQuery()->update([
                        'quantity_product_color' => $quantityAll,
                    ]);
                }else{
                    if($imageProductColor){
                        $nameImageProductColor = $imageProductColor->getClientOriginalName(); // lay ten goc file
                        $currentImageProductColor = current(explode('.',$nameImageProductColor));
                        $extensionImageProductColor = $imageProductColor->extension(); // lay duoi ten file
                        $newImageProductColor = $currentImageProductColor.'.'.$extensionImageProductColor;
                        if($imageProductColor->move('images/product',$newImageProductColor)){
                            ProductColor::create([
                                'id_product' => $product[0]->id,
                                'id_color' => $colorProduct,
                                'image_product_color' => $newImageProductColor,
                                'quantity_product_color' => $data['quantity_product']
                            ]);
                        }
                    }else{
                        Session::put('messageWareHouse',"Không có hình ảnh, yêu cầu thêm vào!");
                        return redirect()->route('warehouse.listWareHouse');
                    }
                }
                Session::put('message',"Cập nhật số lượng sản phẩm ".$data['name_product']." thành công!");
                return redirect()->route('product.listFormProduct'); // k sử dụng redirect::to. 
            }
        }else{
            $imageProduct = $request->file('image_product');// sử dụng camelCase
            // setting trong config/app.php
            if($imageProduct){
                Validator::make($data,[
                    'price_product' => ['required'],
                    'description_product' => ['required'],
                    'content_product' => ['required'],
                ])->validate();
                // if($size_image < 20){
                    $nameImage = $imageProduct->getClientOriginalName(); // lay ten goc file
                    $currentImage = current(explode('.',$nameImage));
                    $extensionImage = $imageProduct->extension(); // lay duoi ten file
                    $newImage = $currentImage.'.'.$extensionImage;
                    $nameImageProductColor = $imageProductColor->getClientOriginalName(); // lay ten goc file
                    $currentImageProductColor = current(explode('.',$nameImageProductColor));
                    $extensionImageProductColor = $imageProductColor->extension(); // lay duoi ten file
                    $newImageProductColor = $currentImageProductColor.'.'.$extensionImageProductColor;
                    $imageProduct->move('images/product',$newImage);
                    $db['id_brand'] = $data['name_brand'];
                    $db['id_category'] = $data['name_category'];
                    $db['name_product'] = $data['name_product'];
                    $db['image_product'] = $newImage;
                    $db['quantity_sold_product'] = 0;
                    $db['price_product'] = $data['price_product'];
                    $db['description_product'] = $data['description_product'];
                    $db['content_product'] = $data['content_product'];
                    $db['number_reviews'] = 0;
                    $db['number_views'] = 0;
                    // created_at, updated_at có kiểu giá trị là timestamp r nên k cần set giá trị $date vào
                    $product = Product::create($db);
                    $imageProductColor->move('images/product',$newImageProductColor);
                    $product->productColor()->create([
                        'id_product' => $product->id,
                        'id_color' => $colorProduct,
                        'image_product_color' => $newImageProductColor,
                        'quantity_product_color' => $data['quantity_product']
                    ]);
                    if($product){
                        Session::put('message',"Thêm sản phẩm ".$data['name_product']." thành công!");
                        return redirect()->route('product.listFormProduct'); // k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }else{
                        Session::put('message',"Thêm sản phẩm ".$data['name_product']." thất bại!");
                        return redirect()->route('product.insertFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }
            }else{
                Session::put('messageWareHouse','Không có hình ảnh, yêu cầu thêm vào!');
                return redirect()->route('warehouse.listWareHouse'); // lop chua cac tieu de cua Session de chuyen den URL khac
                // có thể sử dụng redirect()->back()
            }
        }
    }
}
