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
            <table id="" class="table table-bordered">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tài khoản</th>
                        <th>Mật khẩu (Mã hóa)</th>
                        <th>Quản lý</th>
                        <th>Nhân viên</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                    $i = 0;
                    @endphp
                    @foreach($selectAdmin as $key => $a)
                    @php
                    $i++;
                    @endphp
                    <form action="{{route('admin.permissionAdmin')}}" method="POST">
                        @csrf
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                {{$a->name_admin}}
                                <input type="hidden" name="name_admin" value="{{$a->name_admin}}">
                            </td>
                            <td>{{$a->password_admin}}</td>
                            <td><input type="radio" name="role" value=1 {{$a->id_role == 1 ? "checked" : ""}}></td>
                            <td><input type="radio" name="role" value=2 {{$a->id_role == 2 ? "checked" : ""}}></td>
                            <td>
                                <!-- <button type="submit" name="abc" class="f-14 btn btn-success"><i class="fa-solid fa-hand-point-left"></i></button> -->
                                <input type="submit" value="Cấp quyền" class="f-14 text-white btn btn-info">
                            </td>
                        </tr>
                    </form> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <a href="" class="f-14 w-100 btn btn-success">Cấp quyền</a>
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