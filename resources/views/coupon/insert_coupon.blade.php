@extends('dashboard')
@section('content')
<form action="{{route('coupon.insertCoupon')}}" method="POST"> {{--sử dụng route() --}}
    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên mã giảm giá</label>
        <input type="text" class="form-control" name="name_coupon" id="exampleFormControlInput1">
        @error('name_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Mã giảm giá</label>
        <input type="text" class="form-control" name="code_coupon" id="exampleFormControlInput2" placeholder="Nhập mã giảm giá">
        @error('code_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Số lượng</label>
        <input type="number" class="form-control" min=1 name="quantity_coupon" id="exampleFormControlInput3" placeholder="Nhập số lượng mã">
        @error('quantity_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput4">Điều kiện áp dụng</label>
        <select name="feature_coupon" id="exampleFormControlInput4" class="form-control">
            <option value="0">Giảm theo phần trăm</option>
            <option value="1">Giảm theo giá tiền</option>
        </select>
        @error('feature_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput5">Số phần trăm hoặc số tiền giảm giá</label>
        <input type="text" class="form-control" name="discount_coupon" id="exampleFormControlInput5" placeholder="Nhập số phần trăm hoặc số tiền giảm giá">
        @error('discount_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput6">Thời gian hết hạn mã</label>
        <input type="text" class="form-control datetime" name="time_coupon" id="exampleFormControlInput6" placeholder="Nhập ngày hết hạn">
        @error('time_coupon')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Thêm mã giảm giá" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
