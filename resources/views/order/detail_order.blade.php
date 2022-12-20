@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="row">
    <div class="col-lg-10">
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
        <div class="border bg-white p-3 mb-5">
            <table id="table_id" class="table table-bordered mb-5 mt-2">
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
                        <td>{{$selectOrder->address_order}}</td>
                        <td>{{($selectOrder->name_payment == null) ? "Đến cửa hàng lấy sản phẩm" : $selectOrder->name_payment}}</td>
                        <td>{{$selectOrder->type_shipping}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border bg-white p-3">
            <table id="table_id2" class="table table-bordered mt-2">
                <thead>
                    <div class="d-flex justify-content-center">Danh sách chi tiết đơn hàng</div>
                </thead>
                <thead class="thead-dark">
                    <tr>
                        <th>Mã ID</th>
                        <th>Mã sản phẩm</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Khởi tạo lúc</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $allTotal = 0;
                        if($selectCoupon != 0){
                            $featureCoupon = $selectCoupon->feature_coupon;
                            $discountCoupon = $selectCoupon->discount_coupon;
                            $feeDelivery = $selectOrder->fee_delivery;
                        }else{
                            $featureCoupon = 2;
                            $discountCoupon = 0;
                            $feeDelivery = 0;
                        }
                    @endphp
                    @foreach($selectDetailOrder as $key => $do)
                        @php
                        $total = $do->price_product_order * $do->quantity_product_order;
                        $allTotal += $total;
                        $allTotalChange = 0;
                        if($featureCoupon == 1){
                            $allTotalChange = ($allTotal + $feeDelivery - $discountCoupon);
                        }
                        elseif($featureCoupon == 0){
                            $allTotalChange = $allTotal + $feeDelivery - ($allTotal * ($discountCoupon / 100));
                        }
                        else{
                            $allTotalChange = $allTotal;
                        }
                        @endphp
                    <tr>
                        <td>{{$do->id_order_detail}}</td>
                        <td>{{$do->id_product}}</td>
                        <td>
                            {{$do->code_order}}
                        </td>
                        <td>{{$do->name_product_order}}</td>
                        <td>{{$do->name_color}}</td>
                        <td style="width: 50px; text-align:center;">
                            <span class="quantity-order">{{$do->quantity_product_order}}</span>
                            <input type="hidden" name="product_id" class="product-id" value="{{$do->id_product}}">
                            <input type="hidden" name="product_color_id" class="product-id" value="{{$do->color_product_order}}">
                        </td>
                        <td style="width: 130px;">{{number_format($do->price_product_order,0,',','.')}} ₫</td>
                        <td style="width: 130px;">{{number_format($total,0,',','.')}} ₫</td>
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
                            <span class="f-14 total-order" data-total="{{$allTotalChange}}">{{number_format($allTotalChange,0,',','.')}}</span>₫
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">In hóa đơn sản phẩm</p>
            <div class="form-group d-flex justify-content-center">
                <a href="{{route('order.printOrder',['codeOrder' => $selectOrder->code_order])}}" class="f-14 w-100 btn btn-success">In đơn hàng</a>
            </div>
        </div>
        <div class="bg-white border border-info rounded w-100 mt-4">
            <div class="form-group">
                <p class="f-16 px-3 pt-3">Tình trạng đơn hàng</p>
                <div class="border-button d-flex justify-content-center p-3">
                    @csrf
                    <select name="status_order" class="form-select change-status" id="">
                        <option value="0" data-id="{{$selectOrder->id_order}}" {{($selectOrder->status_order == 0) ? 'selected' : ''}}>
                            Đang chờ xử lý
                        </option>
                        <option value="1" data-id="{{$selectOrder->id_order}}" {{($selectOrder->status_order == 1) ? 'selected' : ''}}>
                            Đã tiếp nhận đơn hàng
                        </option>
                        <option value="2" data-id="{{$selectOrder->id_order}}" {{($selectOrder->status_order == 2) ? 'selected' : ''}}>
                            Giao hàng thành công
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection