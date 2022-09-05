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
<table id="table_id" class="table">
<thead>
    <tr align="center">
        <th scope="col">Mã danh mục</th>
        <th scope="col">Tên danh mục</th>
        <th rowspan="2" scope="col">Chức năng</th>
    </tr>
</thead>
@foreach($selectList as $key => $c)
<tbody>
    <tr align="center">
        <th scope="row">{{$c->id_category}}</th>
        <td>{{$c->name_category}}</td>
        <td>
            <a href="{{route('category.editFormCategory',['idCategory'=>$c->id_category])}}" class="btn btn-success" style="margin-right:30px">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="{{route('category.deleteCategory',['idCategory'=>$c->id_category])}}" class="btn btn-danger">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </td>
    </tr>
</tbody>
@endforeach
</table>

@endsection