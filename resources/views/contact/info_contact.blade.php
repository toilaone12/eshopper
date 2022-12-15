@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <c class="text-success">
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
                <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="table">
                        <thead>
                            <tr align="center">
                                <th>STT</th>
                                <th>Thông tin liên hệ</th>
                                <th>Địa chỉ map</th>
                                <th>Ngày khởi tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i = 0;
                            @endphp
                            @foreach($contact as $key => $c)
                            @php 
                            $i++;
                            @endphp
                            <tr>
                                <td width="150">{{$i}}</td>
                                <td width="300">{{$c->info_contact}}</td>
                                <td width="500">{{$c->map_contact}}</td>
                                <td>{{$c->created_at}}</td>
                                <td>{{$c->updated_at}}</td>
                                @if(Auth::check())
                                @if(Auth::user()->id_role == 1)
                                <td>
                                    <a href="{{route('contact.editContactForm',['idContact'=>$c->id_contact])}}" class="btn btn-success mb-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{route('contact.deleteContact',['idContact'=>$c->id_contact])}}" class="btn btn-danger" >
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
    @if(count($contact) !== 1)
    <div class="col-lg-2">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-success open-contact">Thêm thông tin liên hệ</button>
            </div>
        </div>
    </div>
    @endif
</div>
<form action="{{route('contact.insertContact')}}" method="post">
    <div class="row justify-content-center align-items-center overflow-auto warehouse d-none">
        <div class="bg-warehouse rounded">
            <h3 class="header-warehouse text-center py-3">
                Thông tin liên hệ
                <div class="close-warehouse" style="cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </h3>
            @csrf
            <div class="form-group mx-2">
                <label for="exampleFormControlInput1">Thông tin liên hệ</label>
                <textarea name="info_contact" id="ckeditor1" cols="30" rows="10" class="form-control"></textarea>
                @error('info_contact')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group mx-2">
                <label for="exampleFormControlInput1">Địa chỉ trên GoogleMaps</label>
                <textarea name="map_contact" id="ckeditor2" cols="30" rows="10" class="form-control"></textarea>
                @error('map_contact')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="submit" class="btn btn-success mb-5" value="Thêm thông tin" style="display: block; margin:auto; padding:auto;">
        </div>
    </div>
</form>
@endsection