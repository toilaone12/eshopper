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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Mã giảm giá</th>
                        <th>Phí vận chuyển</th>
                        <th width="120">Tổng tiền</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Khởi tạo lúc</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($selectOrder as $key => $o)
                    <tr>
                        <td>{{$o->code_order}}</td>
                        <td>{{$o->name_customer}}</td>
                        <td>{{$o->coupon_order}}</td>
                        <td>{{number_format($o->fee_delivery,0,',','.')}} ₫</td>
                        <td>{{$o->total_order}}</td>
                        <td class="{{
                                ($o->status_order == 1) ? 'bg-info' : 
                                (($o->status_order == 2) ? 'bg-success' :
                                ((($o->status_order == 3) ? 'bg-danger' : 'bg-warning')))
                            }} text-white">
                            {{
                                ($o->status_order == 1) ? 'Đã tiếp nhận đơn hàng' : 
                                (($o->status_order == 2) ? "Giao hàng thành công" :
                                ((($o->status_order == 3) ? "Hoàn trả / Hủy hàng" : "Đang chờ xử lý")))
                            }}
                        </td>
                        <td>{{$o->created_at}}</td>
                        <td>
                            <a href="{{route('order.detailOrder',['codeOrder'=>$o->code_order])}}" style="margin: 0 auto;" class="btn btn-success">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection