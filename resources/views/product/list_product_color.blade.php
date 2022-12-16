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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách màu sắc sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $allQuantityProduct = 0;
                    $i = 0;
                    @endphp
                    @foreach($productColor as $key => $pc)        
                    @php
                    $i++;
                    @endphp       
                    <tr>
                        <td width="50">{{$i}}</td>
                        <td><img width="150" height="150" src="{{url('images/product/'.$pc->image_product_color)}}" alt="" srcset=""></td>
                        <td>{{$pc->name_product}}</td>
                        <td >{{$pc->name_color}}</td>
                        <td >{{$pc->quantity_product_color}}</td>
                        <td width="150">{{number_format($pc->price_product,0,',','.')}} đ</td>
                        <td>
                            <a href="{{route('product.formEditProductColor',['id'=>$pc->id_product_color])}}" class="btn btn-success mb-2" >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection