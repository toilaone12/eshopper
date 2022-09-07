@extends('dashboard')
@section('content')
<form action="{{route('product.insertProduct')}}" method="POST" enctype="multipart/form-data"> {{--sử dụng route() --}}


    @csrf
    <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
    <div class="form-group">
        <p class="text-danger">
            <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if(isset($message)){
                    echo $message;
                    Session::put('message','');
                }
            ?>
        </p>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Ảnh sản phẩm</label>
        <input type="file" class="form-control-file" name="image_product" id="exampleFormControlFile1">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Tên danh mục</label>
        <select name="name_category" class="form-control" id="exampleFormControlFile1">
            @foreach($selectCategory as $key => $c)
            <option value="{{$c->id_category}}">{{$c->name_category}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Tên thương hiệu</label>
        <select name="name_brand" class="form-control" id="exampleFormControlFile1">
            @foreach($selectBrand as $key => $b)
            <option value="{{$b->id_brand}}">{{$b->name_brand}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name_product" id="exampleFormControlInput1" placeholder="Nhập tên">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Số lượng</label>
        <input type="number" min=0 class="form-control" name="quantity_product" id="exampleFormControlInput1" placeholder="Nhập số lượng">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect2">Giá</label>
        <input type="number" min=0 class="form-control" name="price_product" id="exampleFormControlInput1" placeholder="Nhập giá">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
        <textarea class="form-control" name="description_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả"></textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Thêm sản phẩm" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
