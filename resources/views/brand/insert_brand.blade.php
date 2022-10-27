@extends('dashboard')
@section('content')
<form action="{{route('brand.insertBrand')}}" enctype="multipart/form-data" method="POST"> {{--sử dụng route() --}}
    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            @if($errors->get('name_brand'))
                {{!$errors->get('name_brand')}}
            @elseif($errors->get('desc_brand'))
                {{!$errors->get('desc_brand')}}
            @endif
        </p>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Logo thương hiệu</label>
        <input type="file" class="form-control" name="logo_brand" id="exampleFormControlInput1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên thương hiệu</label>
        <input type="text" class="form-control" name="name_brand" id="exampleFormControlInput1" placeholder="Nhập tên thương hiệu">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Mô tả</label>
        <textarea name="desc_brand" id="" class="form-control" cols="30" rows="10" placeholder="Nhập mô tả"></textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Thêm thương hiệu" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
