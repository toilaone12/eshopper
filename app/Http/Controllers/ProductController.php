<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Category;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Comment as ModelComment;
use App\Model\Rating;
use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // đổi các biến underscore thành camelCase

    public function productList(){
        $getProduct = Product::join('category as c','c.id_category','product.id_category')
        ->join('brand as b','b.id_brand','product.id_brand')->get(); // sử dụng camelCase https://topdev.vn/blog/quy-chuan-dat-ten-trong-lap-trinh-camelcase-underscore-hay-pascalcase/
        return view('product.list_product',compact('getProduct'));
    }
    public function formInsertProduct(){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('product.insert_product',compact('selectCategory','selectBrand'));//nhan 1 tham so, tham so do co the la bien co the la mang
    }
    public function insertProduct(Request $request){
        $data = $request->all();
        $db = array();
        $imageProduct = $request->file('image_product');// sử dụng camelCase
        // setting trong config/app.php
        if($imageProduct){
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
    public function deleteProduct($idProduct){
        $deleteProduct = Product::where('id',$idProduct)->delete();
        if($deleteProduct){
            Session::put('message',"Xóa thành công sản phẩm!");
            return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }else{
            Session::put('message',"Xóa không thành công sản phẩm!");
            return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }
    }
    public function editFormProduct($idProduct){
        $selectProductId = Product::where('id',$idProduct)->first();
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        // dd($selectProductId);
        // compact() nhan mot tham so, moi tham so chua chuoi cua 1 bien hoac 1 mang cua bien
        return view('product.edit_product',compact('selectProductId','selectCategory','selectBrand')); // k dùng ->with mà hãy sử dụng compact()
    }
    public function editProduct(Request $request, $idProduct){
        $data = $request->all();
        $imageProduct = $request->file('image_product');
        // setting trong config/app.php
        $product = Product::find($idProduct);
        if($imageProduct){
            $sizeImage = $imageProduct->getSize();
            if($sizeImage < 100000){
                $nameImage = $imageProduct->getClientOriginalName(); // lay ten goc file
                $currentImage = current(explode('.',$nameImage));
                $extensionImage = $imageProduct->extension(); // lay duoi ten file
                $newImage = $currentImage.'.'.$extensionImage;
                if($imageProduct->move('images/product',$newImage)){
                    $product->id_brand = $data['name_brand'];
                    $product->id_category = $data['id_category'];
                    $product->name_product = $data['name_product'];
                    $product->image_product = $newImage;
                    $product->quantity_product = $data['quantity_product'];
                    $product->price_product = $data['price_product'];
                    $product->description_product = $data['description_product'];
                    $product->content_product = $data['content_product'];
                    $checkProduct = $product->save();
                    if($checkProduct){
                        Session::put('message',"Sửa sản phẩm ".$data['name_product']." thành công!");
                        return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }else{
                        Session::put('message',"Sửa sản phẩm ".$data['name_product']." thất bại!");
                        return redirect()->route('product.editFormProduct',['id_product'=>$idProduct]);// k sử dụng redirect::to. chuyển thành redirect()->route('')
                    }
                }else{
                    Session::put('message','Không thêm được ảnh vào folder!');
                    return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                } // trường hợp move fail thì sao?
            }else{
                Session::put('message','Kích thước ảnh quá lớn, yêu cầu giảm kích thước ảnh!');
                return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
                // return redirect()->route('product.editFormProduct',['id_product'=>$id_product]);// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }
        }else{
            $product->id_brand = $data['name_brand'];
            $product->id_category = $data['id_category'];
            $product->name_product = $data['name_product'];
            $product->quantity_product = $data['quantity_product'];
            $product->price_product = $data['price_product'];
            $product->description_product = $data['description_product'];
            $product->content_product = $data['content_product'];
            $checkProduct = $product->save();
            if($checkProduct){
                Session::put('message',"Sửa sản phẩm ".$data['name_product']." thành công!");
                return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }else{
                Session::put('message',"Sửa sản phẩm ".$data['name_product']." thất bại!");
                return redirect()->route('product.editFormProduct',['id_product'=>$idProduct]);// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }
            // return redirect()->route('product.editFormProduct',['id_product'=>$id_product]); // lop chua cac tieu de cua Session de chuyen den URL khac
        }

        // trường hợp k update ảnh thì sao?
    }

    //page
    public function detailProduct($idProduct){
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $selectProductId = Product::join('category as c','c.id_category','product.id_category')->where('id',$idProduct)->first();
        $categoryId = $selectProductId->id_category;
        $selectProductByCategory = Product::where('id_category',$categoryId)->whereNotIn('id',[$idProduct])->get();
        $selectReview = Review::where('id_product',$idProduct)->get();
        $selectComment = Comment::where('id_product',$idProduct)->get();
        $selectAvgReview = Review::where('id_product',$idProduct)->avg('rating');
        // if(isset($idProduct)){
        //     $product = Product::find($idProduct);
        //     $product->number_views += 1;
        //     $product->save();
        // }
        // dd($selectReview);
        return view('product.detail_product',compact(
            'selectCategory',
            'selectProductId',
            'selectProductByCategory',
            'selectBrand',
            'selectReview',
            'selectComment',
            'selectAvgReview'
        ));
    }
}
