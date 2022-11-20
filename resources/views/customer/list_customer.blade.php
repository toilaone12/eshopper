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
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_id" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Tuổi</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Thuộc khách hàng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($customer as $key => $c)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td width="50">{{$i}}</td>
                            <td>{{$c->name_customer}}</td>
                            <td>{{$c->age_customer}}</td>
                            <td>{{$c->sex_customer}}</td>
                            <td>{{$c->phone_customer}}</td>
                            <td>{{$c->address_customer}}</td>
                            <td class="text-white {{($c->vip_customer == 1) ? "bg-success" : "bg-info"}}">{{($c->vip_customer == 1) ? "Khách hàng VIP" : "Khách hàng thường"}}</td>
                            <td>
                            
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
                <button type="submit" class="f-14 w-100 btn btn-success delete-supplier">Xóa nhà cung cấp</button>
            </div>
        </div>
    </div>
</div>

@endsection