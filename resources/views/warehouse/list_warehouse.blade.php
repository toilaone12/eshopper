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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách kho hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Số lượng tồn kho</th>
                        <th>Giá sản phẩm</th>
                        <th>Ngày cập nhật</th>
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <th>Chức năng</th>
                        @endif
                        @endif
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
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$w->name_product_warehouse}}</td>
                        <td>{{$w->name_color}}</td>
                        <td>{{$w->quantity_product_warehouse}}</td>
                        <td>{{number_format($w->price_product_warehouse,0,',','.')}} ₫</td>
                        <td>{{$w->updated_at}}</td>
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <td>
                            @if($w->quantity_product_warehouse)
                            <button type="submit" 
                            data-name="{{$w->name_product_warehouse}}" 
                            data-quantity="{{$w->quantity_product_warehouse}}" 
                            data-color-id="{{$w->id_color}}" 
                            data-color-name="{{$w->name_color}}" 
                            class="btn btn-info text-white export-warehouse">
                                <i class="fa-solid fa-file-export"></i>
                            </button>
                            @endif
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
<form action="{{route('warehouse.exportProduct')}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="row justify-content-center align-items-center warehouse d-none overflow-auto">
        <div class="bg-warehouse rounded">
            <h3 class="header-warehouse text-center py-3">
                Xuất kho
                <div class="close-warehouse close-warehouse" style="cursor:pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </h3>
            <div class="form-group">
                <p class="text-danger">
                    <?php
                        $message = Session::get('messageWareHouse');
                        if(isset($message)){
                            echo $message;
                            Session::put('messageWareHouse','');
                        }
                    ?>
                </p>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Ảnh gốc</label>
                <input type="file" class="form-control-file" name="image_product" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Ảnh theo màu sản phẩm</label>
                <input type="file" class="form-control-file" name="image_product_color" id="exampleFormControlFile1">
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
            <div class="form-group name-product">
    
            </div>
            <div class="form-group color-product">
    
            </div>
            <div class="form-group quantity-product">
               
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Giá sản phẩm (1 chiếc)</label>
                <input type="number" min=1 class="form-control" name="price_product" id="exampleFormControlSelect2" placeholder="Nhập giá">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
                <textarea class="form-control" id="ckeditor1" name="description_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập mô tả"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Thông tin sản phẩm</label>
                <textarea class="form-control" id="ckeditor2" name="content_product" id="exampleFormControlTextarea1" rows="3" placeholder="Nhập thông tin"></textarea>
            </div>
            <input type="submit" class="btn btn-success mb-5" value="Xuất về kho" style="display: block; margin:auto; padding:auto;">
        </div>
    </div>
</form>
@endsection