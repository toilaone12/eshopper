@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <c class="text-success">
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
<table id="table_id" class="table">
    <thead>
        <tr align="center">
            <th>Mã ID</th>
            <th>Tên người gửi</th>
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm bình luận</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listComment as $key => $c)
        <tr>
            <td width="150">{{$c->id_comment}}</td>
            <td width="300">{{$c->name_comment}}</td>
            <td width="300" class="d-inline-block">
                <p>
                    {{$c->content_comment}}
                </p>
                <textarea name="" id="" cols="30" rows="5" class="mb-2"></textarea>
                <button class="btn btn-primary">
                    Trả lời bình luận
                </button>
            </td>
            <td>{{$c->created_at}}</td>
            <td>{{$c->name_product}}</td>
            <td>
                <a href="" class="btn btn-success" style="margin-right:15px">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection