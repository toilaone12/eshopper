@extends('dashboard')
@section('content')
<form action="{{route('admin.insertUser')}}" method="POST"> {{--sử dụng route() --}}
    @csrf
    
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if(isset($message)){
                    echo $message;
                    Session::put('message','');
                }
            ?>
        </p>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên tài khoản</label>
        <input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="Tài khoản">
        @error('username')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Mật khẩu</label>
        <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="Mật khẩu">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Quyền người dùng</label>
        <select name="name_role" id="" class="form-select">
            @foreach($role as $key => $r)
            <option value="{{$r->id_role}}">{{$r->name_role}}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" class="btn btn-success" value="Thêm tài khoản" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
