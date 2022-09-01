<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // đổi các biến underscore thành camelCase

    public function productList(){
        $get_product = Product::all(); // sử dụng camelCase https://topdev.vn/blog/quy-chuan-dat-ten-trong-lap-trinh-camelcase-underscore-hay-pascalcase/
        return view('product.list_product')->with('g_product',$get_product);
    }
    public function formInsertProduct(){
        return view('product.insert_product');
    }
    public function insertProduct(Request $request){
        $data = $request->all();
        $image_product = $request->file('image_product');// sử dụng camelCase
        date_default_timezone_set("Asia/Ho_Chi_Minh"); // setting trong config/app.php
        $date = date("Y-m-d H:i:s");
        if($image_product){
            // if($size_image < 20){
                $product = new Product();
                $name_image = $image_product->getClientOriginalName(); // lay ten goc file
                $current_image = current(explode('.',$name_image));
                $extension_image = $image_product->extension(); // lay duoi ten file
                $new_image = $current_image.'.'.$extension_image;
                $image_product->move('images/product',$new_image);
                $product->name_product = $data['name_product'];
                $product->image_product = $new_image;
                $product->quantity_product = $data['quantity_product'];
                $product->price_product = $data['price_product'];
                $product->description_product = $data['description_product'];
                // created_at, updated_at có kiểu giá trị là timestamp r nên k cần set giá trị $date vào
                $product->created_at = $date;
                $product->updated_at = $date;
                //
                $check_product = $product->save();
                if($check_product){
                    Session::put('message',"Thêm sản phẩm ".$data['name_product']." thành công!");
                    return redirect()->route(''); // k sử dụng redirect::to. chuyển thành redirect()->route('')
                }else{
                    Session::put('message',"Thêm sản phẩm ".$data['name_product']." thất bại!");
                    return Redirect::to('/insert-form-product');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                }
            // }else{
            //     Session::put('message','Kích thước ảnh quá lớn, yêu cầu giảm kích thước ảnh!');
            //     Redirect::to('/insert-form-product');
            // }
        }else{
            Session::put('message','Không có hình ảnh, yêu cầu thêm vào!');
            return Redirect::to('/insert-form-product'); // lop chua cac tieu de cua Session de chuyen den URL khac
            // có thể sử dụng redirect()->back()
        }
    }
    public function deleteProduct($id_product){
        $delete_product = Product::where('id',$id_product)->delete();
        if($delete_product){
            Session::put('message',"Xóa thành công sản phẩm!");
            return Redirect::to('/list-product');// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }else{
            Session::put('message',"Xóa không thành công sản phẩm!");
            return Redirect::to('/list-product');// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }
    }
    public function editFormProduct($id_product){
        $select_product_id = Product::where('id',$id_product)->get();
        // dd($select_product_id);
        return view('product.edit_product')->with('product_by_id',$select_product_id); // k dùng ->with mà hãy sử dụng compact()
    }
    public function editProduct(Request $request, $id_product){
        $data = $request->all();
        $image_product = $request->file('image_product');
        date_default_timezone_set("Asia/Ho_Chi_Minh");// setting trong config/app.php
        $date = date("Y-m-d H:i:s");
        if($image_product){
            $size_image = $image_product->getSize();
            if($size_image < 100000){
                $product = Product::find($id_product);
                $name_image = $image_product->getClientOriginalName(); // lay ten goc file
                $current_image = current(explode('.',$name_image));
                $extension_image = $image_product->extension(); // lay duoi ten file
                $new_image = $current_image.'.'.$extension_image;
                $image_product->move('images/product',$new_image); // trường hợp move fail thì sao?
                $product->name_product = $data['name_product'];
                $product->image_product = $new_image;
                $product->quantity_product = $data['quantity_product'];
                $product->price_product = $data['price_product'];
                $product->description_product = $data['description_product'];
                $product->created_at = $date;//
                $product->updated_at = $date;//
                $check_product = $product->save();
                if($check_product){
                    Session::put('message',"Sửa sản phẩm ".$data['name_product']." thành công!");
                    return Redirect::to('/list-product');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                }else{
                    Session::put('message',"Sửa sản phẩm ".$data['name_product']." thất bại!");
                    return Redirect::to("/edit-form-product/$id_product");// k sử dụng redirect::to. chuyển thành redirect()->route('')
                }
            }else{
                Session::put('message','Kích thước ảnh quá lớn, yêu cầu giảm kích thước ảnh!');
                return Redirect::to("/edit-form-product/$id_product");// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }
        }else{
            Session::put('message','Không có hình ảnh, yêu cầu thêm vào!');
            return Redirect::to("/edit-form-product/$id_product"); // lop chua cac tieu de cua Session de chuyen den URL khac
        }

        // trường hợp k update ảnh thì sao?
    }
}
