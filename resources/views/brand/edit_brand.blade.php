<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('brand.editBrand',['idBrand' => $findBrand->id_brand])}}" enctype="multipart/form-data" method="POST"> 
    @csrf 
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            @foreach($errors->get('name_category') as $error)
                {{$error}}
            @endforeach
        </p>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Logo thương hiệu</label>
        <input type="file" class="form-control" value="{{$findBrand->logo_brand}}" name="logo_brand" id="exampleFormControlInput1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên thương hiệu</label>
        <input type="text" class="form-control" value="{{$findBrand->name_brand}}" name="name_brand" id="exampleFormControlInput1" placeholder="Nhập tên danh mục">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Mô tả</label>
        <textarea name="desc_brand" id="" class="form-control" cols="30" rows="10" placeholder="Nhập mô tả">{{$findBrand->desc_brand}}</textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Sửa thương hiệu" style="display: block; margin:auto; padding:auto;">
</form>
@endsection