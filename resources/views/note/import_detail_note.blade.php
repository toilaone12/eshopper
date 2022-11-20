@extends('dashboard')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
?>
<!-- <form action="{{route('note.importDetailNote')}}" method="post"> -->
    @csrf
    <div class="row px-xl-3">
        <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
        @php
        $note = Session::get('note');
        $quantityAll = $note['quantity_all'];
        @endphp
        @for($i = 1; $i <= $quantityAll; $i++)
        <div class="col-4">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="bg-info f-14 p-3 rounded w-100 text-white">Số thứ tự {{$i}}</label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Tên sản phẩm</label>
                <input type="text" class="form-control name-product" name="name_product" id="name-{{$i}}">
                @error('name_product')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="row">
                @foreach($color as $key => $c)
                <div class="col-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Màu sắc</label>
                        <div class="d-block">
                            <input type="checkbox" class="mr-1 color-product" value="{{$c->id_color}}" data-stt="{{$i}}" name="color_product" id="">
                            {{$c->name_color}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Số lượng</label>
                        <input type="number" class="form-control quantity-product" min=1 name="quantity_product" id="number-{{$c->id_color}}-{{$i}}" placeholder="Số lượng">
                        @error('quantity_product')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>
            <div class="form-group mb-5">
                <label for="exampleFormControlInput1">Giá sản phẩm (1 chiếc)</label>
                <input type="text" class="form-control price-product" name="price_product" placeholder="Giá" id="price-{{$i}}">
                @error('price_product')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>  
        @endfor
    </div>
    <input type="submit" class="btn btn-success mb-5 add-detail-note" value="Nhập phiếu hàng" style="display: block; margin:auto; padding:auto;">
<!-- </form> -->

@endsection
