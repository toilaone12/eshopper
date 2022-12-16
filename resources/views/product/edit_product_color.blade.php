<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('product.editProductColor',['id'=>$productColor->id_product_color])}}" method="POST" enctype="multipart/form-data"> 
    @csrf 
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <label for="exampleFormControlFile1">Ảnh sản phẩm</label>
        <input type="file" class="form-control-file" value="{{$productColor->image_product}}" name="image_product_color" id="exampleFormControlFile1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Màu sắc</label>
        <select name="product_color" class="form-control" id="exampleFormControlFile1">
            @foreach($color as $key => $c)
            <option @if($productColor->id_color == $c->id_color) selected @endif value="{{$c->id_color}}">{{$c->name_color}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Số lượng</label>
        <input type="number" min=0 class="form-control" value="{{$productColor->quantity_product_color}}" name="quantity_product_color" id="exampleFormControlInput1" placeholder="Nhập số lượng">
        @error('quantity_product_color')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Sửa sản phẩm" style="display: block; margin:auto; padding:auto;">
</form>
@endsection