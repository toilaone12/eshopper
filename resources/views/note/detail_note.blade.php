@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="row">
    <div class="col-lg-10">
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
        <div class="border bg-white p-3 mb-5">
            <table id="table_id" class="table table-bordered mb-5 mt-2">
                <thead>
                    <div class="d-flex justify-content-center">Danh sách nhà cung cấp</div>
                </thead>
                <thead class="thead-dark">
                    <tr align="center">
                        <th>Tên nhà cung cấp</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$note->name_supplier}}</td>
                        <td>{{$note->phone_supplier}}</td>
                        <td>{{$note->address_supplier}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border bg-white p-3">
            <table id="table_id2" class="table table-bordered mt-2">
                <thead>
                    <div class="d-flex justify-content-center pt-5">Danh sách chi tiết đơn hàng</div>
                </thead>
                <thead class="thead-dark">
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Khởi tạo lúc</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $allTotal = 0;
                        $i = 0;
                    @endphp
                    @foreach($detailNote as $key => $detail)
                        @php
                        $i++;
                        $total = $detail->price_product * $detail->quantity_product;
                        $allTotal += $total;
                        @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>
                            {{$detail->code_note}}
                        </td>
                        <td>{{$detail->name_product}}</td>
                        <td>
                            <span class="quantity-order">{{$detail->quantity_product}}</span>
                        </td>
                        <td>{{number_format($detail->price_product,0,',','.')}} ₫</td>
                        <td>{{number_format($total,0,',','.')}} ₫</td>
                        <td>{{$detail->created_at}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="9" class="f-14">Tổng tiền: {{number_format($allTotal,0,',','.')}} ₫</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Xuất hóa đơn phiếu hàng</p>
            <div class="form-group d-flex justify-content-center">
                <a href="{{route('note.printNote',['codeNote' => $note->code_note])}}" class="f-14 w-100 btn btn-success">In phiếu</a>
            </div>
        </div>
        <div class="bg-white border border-info rounded w-100 p-3 mt-5">
            <p class="f-16">Xuất về kho hàng</p>
            <div class="form-group d-flex justify-content-center">
                <a href="{{route('note.exportToWarehouse',['codeNote'=>$note->code_note])}}" class="f-14 w-100 btn btn-success">Xuất hàng</a>
            </div>
        </div>
    </div>
    <!-- <form action="" method="post">
        <div class="row justify-content-center align-items-center warehouse d-none">
            <div class="bg-warehouse rounded">
                <h3 class="header-warehouse text-center py-3">
                    Xuất kho
                    <div class="close-warehouse close-warehouse" style="cursor:pointer;">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </h3>
                <div class="form-group mx-2">
                    <label for="exampleFormControlInput1">Số lượng muốn xuất kho</label>
                    <input type="text" class="form-control" name="quantity_export" id="exampleFormControlInput1">
                    <input type="text" class="form-control" name="code_" id="exampleFormControlInput1">
                </div>
                <input type="submit" class="btn btn-success mb-5" value="Xuất về kho" style="display: block; margin:auto; padding:auto;">
            </div>
        </div>
    </form> -->
</div>

@endsection