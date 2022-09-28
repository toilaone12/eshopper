@extends('home')
@section('content')
<div class="container-xl px-4">
    <!-- Account page navigation-->
    <hr class="mt-0 mb-4">
    <nav aria-label="breadcrumb" class="main-breadcrumb mr-20">
        <ol class="breadcrumb ">
            <a href="{{route('customer.formEditProfile',['idCustomer' => $customer->id_customer])}}" style="text-decoration:none;" class="breadcrumb-item active " aria-current="page">Thông tin khách hàng</a>
        </ol>
    </nav>
    <form action="{{route('customer.editProfile',['idCustomer' => $customer->id_customer])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Thông tin ảnh</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <!-- Profile picture upload button-->                 
                        <div class="image-upload">
                            <label for="file-input">
                                <img class="img-account-profile rounded-circle mb-2" src="{{url('images/customer/'.$customer->image_customer)}}" alt="">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">Dung lượng của ảnh PNG, JPEG, JPG không quá 50MB</div>
                            </label>
                            <input id="file-input" style="display: none; cursor:pointer;" type="file" name="image_customer" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Thông tin chi tiết</div>
                    <div class="card-body">
                        <form>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Họ & tên</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Nhập họ và tên" name="name_customer" value="{{$customer->name_customer}}">
                            </div>
                            <div class="mb-3">
                                @error('name_customer')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- Form Row-->
                            <!-- Form Row        -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Giới tính</label>
                                    <select class="form-control" id="inputOrgName" name="sex_customer" id="">
                                        <option 
                                            @if($customer->sex_customer == "Nam")
                                                {{'selected'}}
                                            @endif
                                            value="Nam">Nam
                                        </option>
                                        <option 
                                            @if($customer->sex_customer == "Nữ")
                                                {{'selected'}}
                                            @endif
                                            value="Nữ">Nữ
                                        </option>
                                    </select>
                                    @error('sex_customer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Địa chỉ</label>
                                    <input class="form-control" id="inputLocation" type="text" placeholder="Nhập địa chỉ" name="address_customer" value="{{$customer->address_customer}}">
                                    @error('address_customer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Địa chỉ email</label>
                                <input class="form-control" id="inputEmailAddress" type="email" name="email_customer" placeholder="Nhập email" value="{{$customer->email_customer}}">
                            </div>
                            <div class="mb-3">
                                @error('email_customer')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- Form Row-->
                            <div class="mb-3">
                                <!-- Form Group (phone number)-->
                                <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone_customer" placeholder="Nhập số điện thoại" value="{{$customer->phone_customer}}">
                                <!-- Form Group (birthday)-->
                            </div>
                            <div class="mb-3">
                                @error('phone_customer')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- Save changes button-->
                            <input class="btn btn-primary" type="submit" name="save" value="Lưu thay đổi"/>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </form>
</div>
@endsection