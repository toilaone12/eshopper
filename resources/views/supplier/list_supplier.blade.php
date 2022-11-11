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
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nhà cung cấp</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_id" class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th>Chọn</th>
                            <th>STT</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày khởi tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($supplier as $key => $s)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td width="50" align="center"><input type="checkbox" name="" value="{{$s->id_supplier}}" class="check-supplier" id=""></td>
                            <td width="50">{{$i}}</td>
                            <td width="150">{{$s->name_supplier}}</td>
                            <td width="150">{{$s->phone_supplier}}</td>
                            <td width="500">{{$s->address_supplier}}</td>
                            <td>{{$s->created_at}}</td>
                            <td>{{$s->updated_at}}</td>
                            <td>
                                <a href="{{route('supplier.editFormSupplier',['id_supplier'=>$s->id_supplier])}}" class="btn btn-success ml-4">
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
    </div>
    <div class="col-lg-2 mt-3">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-success delete-supplier">Xóa nhà cung cấp</button>
            </div>
        </div>
    </div>
</div>

@endsection