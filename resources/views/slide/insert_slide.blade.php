@extends('dashboard')
@section('content')
<form action="{{route('slide.insertSlide')}}" enctype="multipart/form-data" method="POST"> {{--sử dụng route() --}}
    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            @foreach($errors->get('name_brand') as $error)
                {{$error}}
            @endforeach
        </p>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Ảnh quảng cáo</label>
        <input type="file" class="form-control" name="image_slide" id="exampleFormControlInput1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên quảng cáo</label>
        <input type="text" class="form-control" name="name_slide" id="exampleFormControlInput1" placeholder="Nhập tên quảng cáo">
    </div>
    <input type="submit" class="btn btn-success" value="Thêm quảng cáo" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
