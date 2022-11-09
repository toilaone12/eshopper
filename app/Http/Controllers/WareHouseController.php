<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WareHouseController extends Controller
{
    //
    public function listWareHouse(){
        $wareHouse = WareHouse::all();
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
        $priceProduct = $data['price_product'];
        $quantityWareHouse = $data['quantity_product'];
        $product = Product::where('name_product',$data['name_product'])->get();
        $wareHouse = WareHouse::where('name_product_warehouse',$data['name_product'])->get();
        $wareHouse->toQuery()->update([
            'quantity_product_warehouse' => 0,
        ]);
        if(count($product) == 1){
            $priceWareHouse = $product[0]->price_product_warehouse;
            if($priceProduct < $priceWareHouse){
                Session::put('message',"Giá bán sản phẩm của cửa hàng phải lớn hơn giá nhập hàng!");
                return redirect()->route('warehouse.listWareHouse'); // k sử dụng redirect::to. 
            }else{
                $quantityProduct = $product[0]->quantity_product;
                $quantityAll = $quantityProduct + $quantityWareHouse;
                $product->quantity_product_warehouse = $quantityAll;
                $product->toQuery()->update([
                    'quantity_product' => $quantityAll,
                ]);
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
                    $imageProduct->move('images/product',$newImage);
                    $db['id_brand'] = $data['name_brand'];
                    $db['id_category'] = $data['name_category'];
                    $db['name_product'] = $data['name_product'];
                    $db['image_product'] = $newImage;
                    $db['quantity_product'] = $data['quantity_product'];
                    $db['quantity_sold_product'] = 0;
                    $db['price_product'] = $data['price_product'];
                    $db['description_product'] = $data['description_product'];
                    $db['content_product'] = $data['content_product'];
                    $db['number_reviews'] = 0;
                    $db['number_views'] = 0;
                    // created_at, updated_at có kiểu giá trị là timestamp r nên k cần set giá trị $date vào
                    $check_product = Product::create($db);
                    if($check_product){
                        Session::put('message',"Thêm sản phẩm ".$data['name_product']." thành công!");
                        return redirect()->route('product.listFormProduct'); // k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }else{
                        Session::put('message',"Thêm sản phẩm ".$data['name_product']." thất bại!");
                        return redirect()->route('product.insertFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }
                // }else{
                //     Session::put('message','Kích thước ảnh quá lớn, yêu cầu giảm kích thước ảnh!');
                //     Redirect::to('/insert-form-product');
                // }
            }else{
                Session::put('message','Không có hình ảnh, yêu cầu thêm vào!');
                return redirect()->route('product.insertFormProduct'); // lop chua cac tieu de cua Session de chuyen den URL khac
                // có thể sử dụng redirect()->back()
            }
        }
    }
}
