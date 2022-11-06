@extends('dashboard')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
?>
<div class="row px-xl-3">
    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    @php
    $note = Session::get('note');
    $quantityAll = $note['quantity_all'];
    @endphp
    @for($i = 1; $i <= $quantityAll; $i++)
    <div class="col-3">
        <div class="form-group">
            <label for="exampleFormControlInput1" class="bg-info f-14 p-3 rounded w-100 text-white">Số thứ tự {{$i}}</label>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Tên sản phẩm</label>
            <input type="text" class="form-control name-product" name="name_product" id="exampleFormControlInput1">
            @error('name_product')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Số lượng sản phẩm </label>
            <input type="number" class="form-control quantity-product" min=1 name="quantity_product" id="exampleFormControlInput1" placeholder="Số lượng">
            @error('quantity_product')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group mb-5">
            <label for="exampleFormControlInput1">Giá sản phẩm (1 chiếc)</label>
            <input type="text" class="form-control price-product" name="price_product" placeholder="Giá" id="exampleFormControlInput1">
            @error('price_product')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>  
    @endfor
</div>
<input type="submit" class="btn btn-success mb-5 add-detail-note" value="Nhập phiếu hàng" style="display: block; margin:auto; padding:auto;">
@endsection
