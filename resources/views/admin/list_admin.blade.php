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
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tài khoản</th>
                        <th>Mật khẩu (Mã hóa)</th>
                        <th>Quản lý</th>
                        <th>Nhân viên</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($selectAdmin as $key => $a)
                        $i++;
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$a->name_admin}}</td>
                        <td>{{$a->password_admin}}</td>
                        <td><input type="checkbox" name="" id="" {{$a->id_role == 1 ? "checked" : ""}}></td>
                        <td><input type="checkbox" name="" id="" {{$a->id_role == 2 ? "checked" : ""}}></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <a href="" class="f-14 w-100 btn btn-success">In đơn hàng</a>
            </div>
        </div>
        <div class="bg-white border border-info rounded w-100 mt-4">
            <div class="form-group">
                <p class="f-16 px-3 pt-3">Tình trạng đơn hàng</p>
                <div class="border-button d-flex justify-content-center p-3">
                    @csrf
                    <select name="status_order" class="form-select change-status" id="">
                        <option value="0" data-id="">
                            Đang chờ xử lý
                        </option>
                        <option value="1" data-id="">
                            Đã tiếp nhận đơn hàng
                        </option>
                        <option value="2" data-id="">
                            Giao hàng thành công
                        </option>
                        <option value="3" data-id="">
                            Hoàn trả / Hủyhàng
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection