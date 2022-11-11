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
        <h6 class="m-0 font-weight-bold text-primary">Danh sách phí vận chuyển</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>Mã ID</th>
                        <th>Tên tỉnh, thành phố</th>
                        <th>Tên quận, huyện</th>
                        <th>Tên phường, xã</th>
                        <th>Giá vận chuyển</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($delivery as $key => $d)
                    <tr>
                        <td width="70">{{$d->id_feeship}}</td>
                        <td width="200">{{$d->name_province}}</td>
                        <td width="300">{{$d->name_district}}</td>
                        <td width="280">{{$d->name_commune}}</td>
                        <td contenteditable="true" class="edit-delivery" data-id="{{$d->id_feeship}}" width="200">{{number_format($d->price_feeship,0,',','.')}}</td>
                        <td>
                            <a href="{{route('delivery.deleteDelivery',['idDelivery'=>$d->id_feeship])}}" class="btn btn-danger">
                                <i class="fa-solid fa-xmark"></i>
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