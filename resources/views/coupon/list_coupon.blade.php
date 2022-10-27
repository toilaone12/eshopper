@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <p class="text-success">
        <?php
            use Illuminate\Support\Facades\Session;
            $message = Session::get('message');
            if(isset($message)){
                // echo "<script>alert('$message');</script>";
                echo $message;
                Session::put('message','');
            }
        ?>
    </p>
</div>
<table id="table_id" class="table">
    <thead>
        <tr align="center">
            <th>Mã ID</th>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Số tiền được giảm</th>
            <th>Tính năng áp dụng</th>
            <th>Ngày khởi tạo</th>
            <th>Ngày hết mã giảm giá</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($selectCoupon as $key => $c)
        <tr>
            <td width="70">{{$c->id_coupon}}</td>
            <td width="150">{{$c->name_coupon}}</td>
            <td width="100">{{$c->code_coupon}}</td>
            <td width="100">{{$c->quantity_coupon}}</td>
            <td width="100">{{$c->discount_coupon}}</td>
            <td width="150">
                {{($c->feature_coupon == 0) ? 'Giảm giá theo phần trăm' : 'Giảm giá theo giá tiền'}}
            </td>
            <td>{{$c->created_at}}</td>
            <td>{{$c->time_coupon}}</td>
            <td>
                <a href="{{route('coupon.editFormCoupon',['idCoupon'=>$c->id_coupon])}}" class="btn btn-success" style="margin-right:15px">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{route('coupon.deleteCoupon',['idCoupon'=>$c->id_coupon])}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection