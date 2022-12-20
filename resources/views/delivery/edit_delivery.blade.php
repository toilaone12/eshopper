<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('dashboard')
@section('content')
<form action="{{route('delivery.editDelivery',['idDelivery' => $delivery->id_feeship])}}" method="POST"> {{--sử dụng route() --}}
    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên tỉnh, thành phố</label>
        <select name="province_feeship" id="province" class="form-control choose province">
            {{-- <option value="" class="f-14">Tỉnh / Thành phố</option> --}}
            <option value="{{$delivery->province_feeship}}">{{$delivery->name_province}}</option>
            @foreach($province as $key => $p)
            <option value="{{$p->id_province}}" class="f-14">
                {{$p->name_province}}
            </option>
            @endforeach
        </select>
        @error('province_feeship')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Tên quận, huyện</label>
        <select name="district_feeship" id="district" class="form-control choose">
            {{-- <option value="" class="f-14">Quận / Huyện</option> --}}
            <option value="{{$delivery->district_feeship}}">{{$delivery->name_district}}</option>
        </select>
        @error('district_feeship')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Tên phường, xã</label>
        <select name="commune_feeship" id="commune" class="form-control choose">
            <option value="{{$delivery->commune_feeship}}">{{$delivery->name_commune}}</option>
        </select>
        @error('commune_feeship')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput6">Phí vận chuyển</label>
        <input type="number" class="form-control" min=0 name="fee_ship" value="{{$delivery->price_feeship}}" id="exampleFormControlInput6" placeholder="Phí vận chuyển">
        @error('fee_ship')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Sửa phí vận chuyển" style="display: block; margin:auto; padding:auto;">
</form>
@endsection