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
            <th>Mã ID</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thông tin sản phẩm</th>
            <th>Ngày khởi tạo</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($getProduct as $key => $p)
        <tr>
            <td width="50">{{$p->id}}</td>
            <td>{{$p->name_category}}</td>
            <td>{{$p->name_brand}}</td>
            <td><img width="100" height="50" src="{{url('images/product/'.$p->image_product)}}" alt="" srcset=""></td>
            <td>{{$p->name_product}}</td>
            <td>{{$p->quantity_product}} chiếc</td>
            <td>{{number_format($p->price_product,0,',','.')}} đ</td>
            <td>{{$p->description_product}}</td>
            <td>{{$p->created_at}}</td>
            <td>{{$p->updated_at}}</td>
            <td>
                <a href="{{route('product.editFormProduct',['idProduct'=>$p->id])}}" class="btn btn-success" style="margin-right:15px">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{route('product.deleteProduct',['idProduct'=>$p->id])}}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection