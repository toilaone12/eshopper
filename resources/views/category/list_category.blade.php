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
            <th>Tên danh mục</th>
            <th>Ngày khởi tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($getCategory as $key => $c)
        <tr>
            <td width="150">{{$c->id_category}}</td>
            <td width="300">{{$c->name_category}}</td>
            <td>{{$c->created_at}}</td>
            <td>{{$c->updated_at}}</td>
            <td>
                <a href="{{route('category.editFormCategory',['idCategory'=>$c->id_category])}}" class="btn btn-success" style="margin-right:15px">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{route('category.deleteCategory',['idCategory'=>$c->id_category])}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection