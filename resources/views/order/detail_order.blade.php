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
<table id="table_id" class="table mb-5 mt-2">
    <thead>
        <div class="d-flex justify-content-center">Danh sách người mua hàng</div>
    </thead>
    <thead class="thead-dark">
        <tr align="center">
            <th>Tên người mua</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Phương thức thanh toán</th>
            <th>Hình thức giao hàng</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$selectOrder->name_customer}}</td>
            <td>{{$selectOrder->phone_order}}</td>
            <td>
                {{$selectOrder->email_order}}
            </td>
            <td>{{$selectOrder->name_product_order}}</td>
            <td>{{($selectOrder->name_payment == null) ? "Đến cửa hàng lấy sản phẩm" : $selectOrder->name_payment}}</td>
            <td>{{$selectOrder->type_shipping}}</td>
        </tr>
    </tbody>
</table>
<table id="table_id2" class="table mt-2">
    <thead>
        <div class="d-flex justify-content-center pt-5">Danh sách chi tiết đơn hàng</div>
    </thead>
    <thead class="thead-dark">
        <tr>
            <th>Mã ID</th>
            <th>Mã sản phẩm</th>
            <th>Mã đơn hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng đặt hàng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
            <th>Khởi tạo lúc</th>
        </tr>
    </thead>
    <tbody>
        @php
            $allTotal = 0;
            $featureCoupon = $selectCoupon->feature_coupon;
            $discountCoupon = $selectCoupon->discount_coupon;
            $feeDelivery = $selectOrder->fee_delivery;
        @endphp
        @foreach($selectDetailOrder as $key => $do)
            @php
            $total = $do->price_product_order * $do->quantity_product_order;
            $allTotal += $total;
            @endphp
        <tr>
            <td>{{$do->id_order_detail}}</td>
            <td>{{$do->id_product}}</td>
            <td>
                {{$do->code_order}}
            </td>
            <td>{{$do->name_product_order}}</td>
            <td>{{$do->quantity_product_order}}</td>
            <td>{{number_format($do->price_product_order,0,',','.')}} ₫</td>
            <td>{{number_format($total,0,',','.')}} ₫</td>
            <td>{{$do->created_at}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="9" class="f-14">Tiền gốc: {{number_format($allTotal,0,',','.')}} ₫</td>
        </tr>
        <tr>
            <td colspan="9" class="f-14">Tiền mã giảm giá: 
                {{($selectCoupon !== 0) ? ($featureCoupon == 1) ? number_format($discountCoupon,0,',','.').'₫' : number_format($discountCoupon,0,',','.').'%' : "0₫" }}
            </td>
        </tr>
        <tr>
            <td colspan="9" class="f-14">Phí vận chuyển: 
                {{number_format($feeDelivery,0,',','.')}} ₫
            </td>
        </tr>
        <tr>
            <td colspan="9" class="f-14">Tổng tiền: 
                {{number_format(($featureCoupon == 1) ?  $allTotal + $feeDelivery - $discountCoupon : $allTotal + $feeDelivery - ($allTotal * ($discountCoupon / 100)),0,',','.')}} ₫
            </td>
        </tr>
    </tbody>
</table>
<div class="form-group">
    <a href="{{route('order.printOrder',['codeOrder' => $do->code_order])}}" class="f-14 btn btn-success">In đơn hàng</a>
</div>

@endsection