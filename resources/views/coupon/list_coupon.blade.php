@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="row">
    <div class="col-10">
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
                <h6 class="m-0 font-weight-bold text-primary">Danh sách mã giảm giá</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="table">
                        <thead>
                            <tr align="center">
                                <th></th>
                                <th>STT</th>
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
                            @php
                                $i = 0;
                            @endphp
                            @foreach($selectCoupon as $key => $c)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td width="30"><input type="checkbox" name="" value="{{$c->id_coupon}}" id=""></td>
                                <td width="50">{{$i}}</td>
                                <td width="150">{{$c->name_coupon}}</td>
                                <td width="100">{{$c->code_coupon}}</td>
                                <td width="100">{{$c->quantity_coupon}}</td>
                                <td width="100">{{$c->discount_coupon}}</td>
                                <td width="100">
                                    {{($c->feature_coupon == 0) ? 'Giảm giá theo phần trăm' : 'Giảm giá theo giá tiền'}}
                                </td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->time_coupon}}</td>
                                <td>
                                    <a href="{{route('coupon.editFormCoupon',['idCoupon'=>$c->id_coupon])}}" class="btn btn-success mb-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{route('coupon.deleteCoupon',['idCoupon'=>$c->id_coupon])}}" class="btn btn-danger">
                                        <i class="fa-solid fa-rectangle-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-success upload-coupon-vip">Cấp mã giảm giá cho khách VIP</button>
            </div>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-info text-white upload-coupon-normal">Cấp mã giảm giá cho khách thường</button>
            </div>
        </div>
    </div>
</div>

@endsection