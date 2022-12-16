<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('product.editProduct',['idProduct'=>$selectProductId->id])}}" method="POST" enctype="multipart/form-data"> 
    @csrf 
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            <?php
                $message = Session::get('message');
                if(isset($message)){
                    echo $message;
                    Session::put('message','');
                }
            ?>
        </p>
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control-file" value="{{$selectProductId->id_product_color}}" name="product_color" id="exampleFormControlFile1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Ảnh sản phẩm</label>
        <input type="file" class="form-control-file" value="{{$selectProductId->image_product}}" name="image_product" id="exampleFormControlFile1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Tên danh mục</label>
        <select name="id_category" class="form-control" id="exampleFormControlFile1">
            @foreach($selectCategory as $key => $c)
            <option @if($selectProductId->id_category == $c->id_category) selected @endif value="{{$c->id_category}}">{{$c->name_category}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Tên thương hiệu</label>
        <select name="name_brand" class="form-control" id="exampleFormControlFile1">
            @foreach($selectBrand as $key => $b)
            <option @if($selectProductId->id_brand == $b->id_brand) selected @endif value="{{$b->id_brand}}">{{$b->name_brand}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên sản phẩm</label>
        <input type="text" class="form-control" value="{{$selectProductId->name_product}}" name="name_product" id="exampleFormControlInput1" placeholder="Nhập tên">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Giá</label>
        <input type="number" min=0 class="form-control" value="{{$selectProductId->price_product}}" name="price_product" id="exampleFormControlInput1" placeholder="Nhập giá">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
        <textarea class="form-control" id="ckeditor1"  name="description_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả">{{$selectProductId->description_product}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Thông tin sản phẩm</label>
        <textarea class="form-control" id="ckeditor2" name="content_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập thông tin">{{$selectProductId->content_product}}</textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Sửa sản phẩm" style="display: block; margin:auto; padding:auto;">
</form>
@endsection