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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>Mã ID</th>
                        <th>Logo thương hiệu</th>
                        <th>Tên thương hiệu</th>
                        <th>Mô tả về thương hiệu</th>
                        <th>Ngày khởi tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getBrand as $key => $b)
                    <tr>
                        <td width="150">{{$b->id_brand}}</td>
                        <td width="150"><img width="100" height="100" src="{{url('images/brand/'.$b->logo_brand)}}" alt="" srcset=""></td>
                        <td width="300">{{$b->name_brand}}</td>
                        <td width="300">{{$b->desc_brand}}</td>
                        <td>{{$b->created_at}}</td>
                        <td>{{$b->updated_at}}</td>
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <td>
                            <a href="{{route('brand.editFormBrand',['idBrand'=>$b->id_brand])}}" class="btn btn-success" style="margin-right:15px">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="{{route('brand.deleteBrand',['idBrand'=>$b->id_brand])}}" class="btn btn-danger">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                        @else
                        <td>
                        </td>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection