@extends('dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <form class="" action="{{route('note.importNote')}}" enctype="multipart/form-data" method="POST"> {{--sử dụng route() --}}
            @csrf
            <!-- Tránh cuộc tấn công giả mạo từ nhiều web độc hại -->
            <div class="form-group">
                <label for="exampleFormControlInput1">Nhà cung cấp</label>
                <select name="id_supplier" id="" class="form-select">
                    @foreach($supplier as $key => $s)
                    <option value="{{$s->id_supplier}}">{{$s->name_supplier}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Tên phiếu hàng</label>
                <input type="text" class="form-control" name="name_note" id="exampleFormControlInput1">
                @error('name_note')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Số lượng sản phẩm tất cả</label>
                <input type="number" class="form-control" min=1 name="quantity_all_product" id="exampleFormControlInput1" placeholder="Số lượng">
                @error('quantity_all_product')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <input type="submit" class="btn btn-success mb-5" value="Nhập phiếu hàng" style="display: block; margin:auto; padding:auto;">
        </form>
    </div>

</div>
@endsection
