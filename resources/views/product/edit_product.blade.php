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
        <label for="exampleFormControlFile1">Tên danh mục</label>
        <select name="id_category" class="form-control" id="exampleFormControlFile1">
            @foreach($selectCategory as $key => $c)
            <option @if($selectProductId->id_category == $c->id_category) selected @endif value="{{$c->id_category}}">{{$c->name_category}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Ảnh sản phẩm</label>
        <input type="file" class="form-control-file" value="{{$selectProductId->image_product}}" name="image_product" id="exampleFormControlFile1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên sản phẩm</label>
        <input type="text" class="form-control" value="{{$selectProductId->name_product}}" name="name_product" id="exampleFormControlInput1" placeholder="Nhập tên">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Số lượng</label>
        <input type="number" min=0 class="form-control" value="{{$selectProductId->quantity_product}}" name="quantity_product" id="exampleFormControlInput1" placeholder="Nhập số lượng">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Giá</label>
        <input type="number" min=0 class="form-control" value="{{$selectProductId->price_product}}" name="price_product" id="exampleFormControlInput1" placeholder="Nhập giá">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
        <textarea class="form-control"  name="description_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả">{{$selectProductId->description_product}}</textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Sửa sản phẩm" style="display: block; margin:auto; padding:auto;">
</form>
@endsection