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
                                <th>Hình ảnh</th>
                                <th>Tên hình ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i = 0;
                            @endphp
                            @foreach($gallery as $key => $g)
                            @php
                            $i++;
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <label for="file-{{$g->id_gallery}}">
                                        <img width="150" height="150" class="id-gallery" src="{{url('images/gallery/'.$g->image_gallery)}}" alt="" srcset="">
                                    </label>
                                    <!-- <input type="hidden" name="id_gallery" class="id-gallery" > -->
                                    <input type="file" class="mt-3 d-none update-gallery"  data-gallery="{{$g->id_gallery}}" name="image_gallery" id="file-{{$g->id_gallery}}">
                                </td>
                                <td>{{$g->name_gallery}}</td>
                                <td>
                                    <a href="{{route('product.deleteThumbnails',['idGallery'=>$g->id_gallery])}}" class="btn btn-danger">
                                        <i class="fa-solid fa-rectangle-xmark"></i>
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
    <div class="col-lg-2">
        <div class="bg-white border border-info rounded w-100 p-3">
            <p class="f-16">Chức năng</p>
            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="f-14 w-100 btn btn-success insert-gallery">Thêm hình ảnh</button>
            </div>
        </div>
    </div>
</div>
<form action="{{route('product.insertThumbnails')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center align-items-center gallery d-none overflow-auto">
        <div class="bg-warehouse rounded">
            <h3 class="header-warehouse text-center py-3">
                Thêm kho ảnh
                <div class="gallery-close" style="cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </h3>
            <div class="form-group">
                <input type="hidden" class="form-control-file" name="id_product" value="{{$idProduct}}" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Ảnh sản phẩm</label>
                <input type="file" class="form-control-file" id="file" multiple name="image_gallery[]" id="exampleFormControlFile1">
                @error('image_gallery')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="submit" class="btn btn-success mb-5 add-gallery" value="Thêm vào kho ảnh" style="display: block; margin:auto; padding:auto;">
        </div>
    </div>
</form>

@endsection