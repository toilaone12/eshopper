@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <p class="text-success">
        <?php
            use Illuminate\Support\Facades\Session;
            $message = Session::get('message');
            $error = Session::get('error');
            if(isset($message)){
                // echo "<script>alert('$message');</script>";
                echo $message;
                Session::put('message','');
        ?>
    </p>
    <p class="text-danger">
        <?php
            }else if(isset($error)){
                echo $error;
                Session::put('error','');
            }
        ?>
    </p>
</div>
<table id="table_id" class="table">
    <thead>
        <tr align="center">
            <th>Mã ID</th>
            <th>Ảnh quảng cáo</th>
            <th>Tên quảng cáo</th>
            <th>Ngày khởi tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($selectSlide as $key => $s)
        <tr>
            <td width="150">{{$s->id_slide}}</td>
            <td width="150"><img src="{{url('images/slide/'.$s->image_slide)}}" alt="" srcset=""></td>
            <td width="300">{{$s->name_slide}}</td>
            <td>{{$s->created_at}}</td>
            <td>{{$s->updated_at}}</td>
            <td>
                <a href="{{route('slide.editFormSlide',['idSlide'=>$s->id_slide])}}" class="btn btn-success" style="margin-right:15px">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{route('slide.deleteSlide',['idSlide'=>$s->id_slide])}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection