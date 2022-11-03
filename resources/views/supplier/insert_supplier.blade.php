@extends('dashboard')
@section('content')
<form action="{{route('supplier.insertSupplier')}}" enctype="multipart/form-data" method="POST"> {{--sử dụng route() --}}
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
        <label for="exampleFormControlInput1">Tên nhà cung cấp</label>
        <input type="text" class="form-control" name="name_supplier" placeholder="Tên nhà cung cấp" id="exampleFormControlInput1">
        @error('name_supplier')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Địa chỉ nhà cung cấp</label>
        <input type="text" class="form-control" name="address_supplier" id="exampleFormControlInput1" placeholder="Địa chỉ nhà cung cấp">
        @error('address_supplier')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <input type="submit" class="btn btn-success" value="Thêm nhà cung cấp" style="display: block; margin:auto; padding:auto;">
</form>
@endsection
