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
        <th scope="col">Mã danh mục</th>
        <th scope="col">Tên danh mục</th>
        <th rowspan="2" scope="col">Chức năng</th>
    </tr>
</thead>
@foreach($selectBrand as $key => $b)
<tbody>
    <tr align="center">
        <th scope="row">{{$b->id_brand}}</th>
        <td>{{$b->name_brand}}</td>
        <td>{{$b->desc_brand}}</td>
        <td>
            <a href="{{route('brand.editFormBrand',['idBrand'=>$b->id_brand])}}" class="btn btn-success" style="margin-right:30px">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="{{route('brand.deleteBrand',['idBrand'=>$b->id_brand])}}" class="btn btn-danger">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </td>
    </tr>
</tbody>
@endforeach
</table>

@endsection