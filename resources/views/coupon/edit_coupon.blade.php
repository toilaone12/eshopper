<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('coupon.editCoupon',['idCoupon' => $selectCoupon->id_coupon])}}" enctype="multipart/form-data" method="POST"> 
    @csrf 
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên mã giảm giá</label>
        <input type="text" class="form-control" name="name_coupon" value="{{$selectCoupon->name_coupon}}" id="exampleFormControlInput1">
        @error('name_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Mã giảm giá</label>
        <input type="text" class="form-control" name="code_coupon" value="{{$selectCoupon->code_coupon}}" id="exampleFormControlInput2" placeholder="Nhập mã giảm giá">
        @error('code_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Số lượng</label>
        <input type="number" class="form-control" min=1 name="quantity_coupon" value="{{$selectCoupon->quantity_coupon}}" id="exampleFormControlInput3" placeholder="Nhập số lượng mã">
        @error('quantity_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">Điều kiện áp dụng</label>
        <select name="feature_coupon" id="exampleFormControlInput4" class="form-control">
            <option {{($selectCoupon->feature_coupon == 0) ? 'selected' : ''}} value="0">Giảm theo phần trăm</option>
            <option {{($selectCoupon->feature_coupon == 1) ? 'selected' : ''}} value="1">Giảm theo giá tiền</option>
        </select>
        @error('feature_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput5">Số phần trăm hoặc số tiền giảm giá</label>
        <input type="text" class="form-control" value="{{$selectCoupon->discount_coupon}}" name="discount_coupon" id="exampleFormControlInput5" placeholder="Nhập số phần trăm hoặc số tiền giảm giá">
        @error('discount_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput6">Thời gian hết hạn mã</label>
        <input type="text" class="form-control datetime" name="time_coupon" placeholder="Nhập ngày hết hạn" value="{{$selectCoupon->time_coupon}}" id="exampleFormControlInput6">
        @error('time_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Sửa thương hiệu" style="display: block; margin:auto; padding:auto;">
</form>
@endsection