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
<div class="row">
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách màu sắc</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="table">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Màu sắc</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach($color as $key => $c)
                            @php
                            $i++;
                            @endphp
                            <tr>
                                <td width="50">{{$i}}</td>
                                <td width="100" contenteditable="true" class="update-color" data-color="{{$c->id_color}}">
                                    {{$c->name_color}}
                                </td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->updated_at}}</td>
                                @if(Auth::check())
                                @if(Auth::user()->id_role == 1)
                                <td>
                                    <a href="{{route('color.deleteColor',['idColor'=>$c->id_color])}}" class="btn btn-danger">
                                        <i class="fa-solid fa-rectangle-xmark"></i>
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
    </div>
    <div class="col-lg-2">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-success create-color">Thêm màu sắc</button>
            </div>
        </div>
    </div>
</div>
<form action="{{route('color.insertColor')}}" method="post">
    @csrf
    <div class="row justify-content-center align-items-center color d-none overflow-auto">
        <div class="bg-warehouse rounded">
            <h3 class="header-warehouse text-center py-3">
                Thêm màu sắc
                <div class="color-close" style="cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </h3>
            <div class="form-group">
                <label for="exampleFormControlFile1">Tên màu sắc</label>
                <input type="text" class="form-control-file" name="name_color" id="exampleFormControlFile1">
                @error('name_color')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="submit" class="btn btn-success mb-5 add-gallery" value="Thêm màu" style="display: block; margin:auto; padding:auto;">
        </div>
    </div>
</form>

@endsection