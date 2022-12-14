<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use App\Model\Category;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Comment as ModelComment;
use App\Model\Gallery;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\ProductColor;
use App\Model\Rating;
use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // đổi các biến underscore thành camelCase

    public function productList(){
        $getProduct = Product::join('category as c','c.id_category','product.id_category')
        ->join('brand as b','b.id_brand','product.id_brand')->get(); // sử dụng camelCase https://topdev.vn/blog/quy-chuan-dat-ten-trong-lap-trinh-camelcase-underscore-hay-pascalcase/
        $listProductColor = ProductColor::join('color as c','c.id_color','product_color.id_color')->get();
        return view('product.list_product',compact('getProduct','listProductColor'));
    }
    public function formInsertProduct(){
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        return view('product.insert_product',compact('selectCategory','selectBrand'));//nhan 1 tham so, tham so do co the la bien co the la mang
    }

    public function deleteProduct($idProduct){
        $comment = Comment::where('id_product',$idProduct)->delete();
        $review = Review::where('id_product',$idProduct)->delete();
        $orderDetail = OrderDetail::where('id_product',$idProduct)->first();
        $thumbnails = Gallery::where('id_product',$idProduct)->delete();
        $productColor = ProductColor::where('id_product',$idProduct)->delete(); 
        if($orderDetail){
            $deleteCodeOrder = Order::where('code_order',$orderDetail->code_order)->delete();
            $deleteProduct = Product::where('id',$idProduct)->delete();
            if($deleteProduct){
                Session::put('message',"Xóa thành công sản phẩm!");
                return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }else{
                Session::put('message',"Xóa không thành công sản phẩm!");
                return redirect()->route('product.listFormProduct');// k sử dụng redirect::to. chuyển thành redirect()->route('')
            }
        }

    }
    public function editFormProduct($idProduct){
        $selectProductId = Product::join('product_color as pc','pc.id_product','product.id')->where('id',$idProduct)->first();
        $selectCategory = Category::all();
        $selectBrand = Brand::all();
        $selectColor = Color::all();
        // dd($selectProductId);
        // compact() nhan mot tham so, moi tham so chua chuoi cua 1 bien hoac 1 mang cua bien
        return view('product.edit_product',compact('selectProductId','selectCategory','selectBrand','selectColor')); // k dùng ->with mà hãy sử dụng compact()
    }
    public function editProduct(Request $request, $idProduct){
        $data = $request->all();
        Validator::make($data,[
            'name_product' => ['required','string'],
            'price_product' => ['required']
        ])->validate();
        $imageProduct = $request->file('image_product');
        // setting trong config/app.php
        $product = Product::find($idProduct);
        // dd($productColor);
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
    
    public function createThumbnails($idProduct){
        $gallery = Gallery::where('id_product',$idProduct)->get();
        return view('product.thumbnails_image',compact(
            'idProduct',
            'gallery'
        ));
    }

    public function insertThumbnails(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'image_gallery' => ['required']
        ])->validate();
        $arrayImage = $request->file('image_gallery');
        foreach($arrayImage as $keyImage => $image){
            $nameImage = $image->getClientOriginalName(); // lay ten goc file
            $currentImage = current(explode('.',$nameImage));
            $extensionImage = $image->extension(); // lay duoi ten file
            $newImage = $currentImage.'.'.$extensionImage;
            $idProduct = $data['id_product'];
            if($image->move('images/gallery',$newImage)){
                $gallery = Gallery::create([
                        'id_product' => $idProduct,
                        'image_gallery' => $newImage,
                        'name_gallery' => $newImage,
                ]);
            }else{
                // echo "2";
                Session::put('message','Không thêm được ảnh vào folder!');
                return redirect()->route('product.createThumbnails',['idProduct'=>$idProduct]);// k sử dụng redirect::to. chuyển thành redirect()->route('')
            } // trường hợp move fail thì sao?
            // print_r($image);
        }
        Session::put('message',"Thêm ảnh vào kho ảnh thành công!");
        return redirect()->route('product.createThumbnails',['idProduct'=>$idProduct]);
    }
    
    public function deleteThumbnails($idGallery){
        $gallery = Gallery::find($idGallery);
        unlink(public_path('/images/gallery/'.$gallery->image_gallery));
        $gallery->delete();
        if($gallery){
            Session::put('message',"Xóa thành công sản phẩm!");
            return redirect()->back();// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }else{
            Session::put('message',"Xóa không thành công sản phẩm!");
            return redirect()->back();// k sử dụng redirect::to. chuyển thành redirect()->route('')
        }
    }

    public function updateThumbnails(Request $request){
        $data = $request->all();
        $image = $request->file('image_gallery');
        if($image){
            $nameImage = $image->getClientOriginalName(); // lay ten goc file
            $currentImage = current(explode('.',$nameImage));
            $extensionImage = $image->extension(); // lay duoi ten file
            $newImage = $currentImage.'.'.$extensionImage;
            $idGallery = $data['id_gallery'];
            $gallery = Gallery::find($idGallery);
            // unlink(public_path('/images/gallery/'.$gallery->image_gallery));
            if($image->move('images/gallery',$newImage)){
                $gallery->image_gallery = $newImage;
                $gallery->name_gallery = $newImage;
                $gallery->save();
            }
        }
        // print_r($data);
    }

    public function listProductColor(Request $request){
        $idProduct = $request->get('idProduct');
        $productColor = ProductColor::join('product as p','p.id','product_color.id_product')
        ->join('color as c','c.id_color','product_color.id_color')
        ->where('id_product',$idProduct)->get();
        // dd($productColor);
        return view('product.list_product_color',compact('productColor'));
    }

    public function formEditProductColor(Request $request){
        $productColor = ProductColor::find($request->get('id'));
        $color = Color::all();
        return view('product.edit_product_color',compact(
            'productColor',
            'color'
        ));
    }

    public function editProductColor(Request $request){
        $data = $request->all();
        $idProductColor = $request->get('id');
        $productColor = ProductColor::find($idProductColor);
        Validator::make($data,[
            'quantity_product_color' => ['required']
        ],
        [
            'required' => 'Dữ liệu này không được để trống!'
        ])->validate();
        $image = $request->file('image_product_color');
        if($image){
            $nameImage = $image->getClientOriginalName(); // lay ten goc file
            $currentImage = current(explode('.',$nameImage));
            $extensionImage = $image->extension(); // lay duoi ten file
            $newImage = $currentImage.'.'.$extensionImage;
            unlink(public_path('/images/product/'.$productColor->image_product_color));
            if($image->move('images/product',$newImage)){
                $productColor->quantity_product_color = $data['quantity_product_color'];
                $productColor->id_color = $data['product_color'];
                $productColor->save();
                if(isset($productColor)){
                    Session::put('message',"Sửa thông tin thành công!");
                    return redirect()->route('product.listProductColor',['idProduct'=>$productColor->id_product]);
                }else{
                    Session::put('message',"Sửa thông tin không thành công!");
                    return redirect()->route('product.listProductColor',['idProduct'=>$productColor->id_product]);
                }
            }
        }else{
            $productColor->quantity_product_color = $data['quantity_product_color'];
            $productColor->id_color = $data['product_color'];
            $productColor->save();
            if(isset($productColor)){
                Session::put('message',"Sửa thông tin thành công!");
                return redirect()->route('product.listProductColor',['idProduct'=>$productColor->id_product]);
            }else{
                Session::put('message',"Sửa thông tin không thành công!");
                return redirect()->route('product.listProductColor',['idProduct'=>$productColor->id_product]);
            }
        }
    }

    //page
    public function detailProduct($idProduct){
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $selectProductId = Product::join('category as c','c.id_category','product.id_category')->join('product_color as pc','pc.id_product','product.id')
        ->where('id',$idProduct)->first();
        $selectProductColorId = ProductColor::join('color as cl','cl.id_color','product_color.id_color')->where('id_product',$idProduct)->get();
        $categoryId = $selectProductId->id_category;
        $selectProductByCategory = Product::where('id_category',$categoryId)->whereNotIn('id',[$idProduct])->get();
        $selectReview = Review::where('id_product',$idProduct)->get();
        $selectComment = Comment::where('id_product',$idProduct)->get();
        $selectAvgReview = Review::where('id_product',$idProduct)->avg('rating');
        $galleryProduct = Gallery::where('id_product',$idProduct)->take(4)->get();
        // dd($selectProductId);
        // // if(isset($idProduct)){
        // //     $product = Product::find($idProduct);
        // //     $product->number_views += 1;
        // //     $product->save();
        // // }
        $countProduct = 0;
        foreach($selectProductColorId as $key => $pc){
            $countProduct += $pc->quantity_product_color;
        }
        return view('product.detail_product',compact(
            'selectCategory',
            'selectProductId',
            'selectProductByCategory',
            'selectBrand',
            'selectReview',
            'selectComment',
            'selectAvgReview',
            'galleryProduct',
            'selectProductColorId',
            'countProduct'
        ));
    }
    public function changeColor(Request $request){
        $data = $request->all();
        $idColor = $data['idColor'];
        $idProduct = $data['idProduct'];
        $productColor = ProductColor::where('id_color',$idColor)->where('id_product',$idProduct)->first();
        return response()->json([
            'image' => url('images/product/'.$productColor->image_product_color),
            'quantity' => $productColor->quantity_product_color,
            'id' => $productColor->id_product_color
        ]);
    }
}
