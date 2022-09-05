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
        <th scope="col">Mã sản phẩm</th>
        <th scope="col">Tên danh mục</th>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Giá sản phẩm</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Thông tin</th>
        <th rowspan="2" scope="col">Chức năng</th>
    </tr>
</thead>
@foreach($getProduct as $key => $p)
<tbody>
    <tr align="center">
        <th scope="row">{{$p->id}}</th>
        <th scope="row">{{$p->name_category}}</th>
        <th scope="row"><img width="150" src="{{URL::to('images/product/'.$p->image_product)}}" alt=""></th>
        <td>{{$p->name_product}}</td>
        <td>{{$p->price_product}}</td>
        <td>{{$p->quantity_product}}</td>
        <td>{{$p->description_product}}</td>
        <td>
            <a href="{{route('product.editFormProduct',['idProduct'=>$p->id])}}" class="btn btn-success" style="margin-right:30px">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="{{route('product.deleteProduct',['idProduct'=>$p->id])}}" class="btn btn-danger">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </td>
    </tr>
</tbody>
@endforeach
</table>

@endsection