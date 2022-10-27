<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('category.editCategory',['idCategory' => $findCategory->id_category])}}" method="POST"> 
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
        <label for="exampleFormControlInput1">Tên danh mục</label>
        <input type="text" class="form-control" value="{{$findCategory->name_category}}" name="name_category" id="exampleFormControlInput1" placeholder="Nhập tên danh mục">
    </div>
    <input type="submit" class="btn btn-success" value="Sửa danh mục" style="display: block; margin:auto; padding:auto;">
</form>
@endsection