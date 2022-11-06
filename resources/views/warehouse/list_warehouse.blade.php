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
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng tồn kho</th>
            <th>Giá sản phẩm</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($wareHouse as $key => $w)
        @php
        $i++
        @endphp
        <tr >
            <td>{{$i}}</td>
            <td>{{$w->name_product_warehouse}}</td>
            <td>{{$w->quantity_product_warehouse}}</td>
            <td>{{number_format($w->price_product_warehouse,0,',','.')}} ₫</td>
            <td>
                <a href="" class="btn btn-info">
                    <i class="fa-solid fa-circle-info text-white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection