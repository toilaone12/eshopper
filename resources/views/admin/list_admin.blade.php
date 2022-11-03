@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="row">
    <div class="col-lg-12">
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
                                <input type="hidden" name="name_admin" class="name_admin" value="{{$a->name_admin}}">
                            </td>
                            <td>{{$a->password_admin}}</td>
                            <td><input type="radio" name="role" value=1 {{$a->id_role == 1 ? "checked" : ""}}></td>
                            <td><input type="radio" name="role" value=2 {{$a->id_role == 2 ? "checked" : ""}}></td>
                            <td>
                                <button type="submit" name="abc" class="f-14 btn btn-success mr-1"><i class="fa-solid fa-hand-point-left"></i></button>
                                <a href="{{route('admin.deniedUser',['id' => $a->id_admin])}}" name="abc" class="f-14 btn btn-danger denied-permission"><i class="fa-solid fa-remove"></i></a>
                            </td>
                        </tr>
                    </form> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection