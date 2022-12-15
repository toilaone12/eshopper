@extends('home')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session_start();
?>
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5 pt-4 pb-4 bg-white-smoke">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0 text-white">Danh mục sản phẩm</h6>
                <i class="fa fa-angle-down text-white"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                <div class="navbar-nav w-100 bg-white" style="height: 410px">
                    @foreach($selectCategory as $key => $c)
                    <div class="nav-item dropleft">
                        <a href="{{route('category.productByCategory',$c->name_category)}}" class="nav-link">{{$c->name_category}} <i class="fa fa-angle-right float-right mt-1"></i></a>
                        <div class="brand-hover dropdown-menu position-absolute bg-light border-0 rounded-5 w-100 m-0">
                            <h6 class="text-center">Hãng sản xuất</h4> 
                            <ul class="d-flex flex-wrap list-style-none pl-0" >
                                @foreach($selectBrand as $key => $b)
                                <li class="col-4">
                                    <a href="{{route('brand.productByBrand',$b->name_brand)}}" class="dropdown-item text-muted text-12 text-center">{{$b->name_brand}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 mb-3">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between rounded shadow" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home.page')}}" class="f-16 nav-item nav-link text-info active"><i class="fa-solid fa-house f-16"></i> Trang chủ</a>
                        <a href="{{route('order.checkDelivery')}}" class="nav-item nav-link text-info f-16"><i class="fa-solid fa-truck-fast f-16"></i> Tình trạng đơn hàng</a>
                        <a href="contact.html" class="nav-item nav-link text-info f-16"><i class="fa-solid fa-address-book f-16"></i> Liên hệ</a>
                    </div>
                    <?php
                        $idCustomer = Session::get('id',null);
                        $username = Session::get('usernameCustomer',null);
                        $imageCustomer = Session::get('imageCustomer',null);
                        $nameCustomer = Session::get('nameCustomer',null);
                        if(isset($username)){
                    ?>
                    <div class="ml-auto py-0 profile profile-hover dropdown">
                        <img class="w-37 h-25 img-profile profile-hover dropdown " src="{{url('images/customer/'.$imageCustomer)}}" alt="">
                        <div class="nav-item">
                            <div class="dropdown-menu d-none left-profile__63 top-profile__127 profile-info rounded-0 m-0">
                                <a href="{{route('customer.profile',['idCustomer' => $idCustomer])}}" class="dropdown-item text-muted f-14"><i class="fas fa-signature pr-1"></i>{{$nameCustomer}}</a>
                                <a href="{{route('customer.profile',['idCustomer' => $idCustomer])}}" class="dropdown-item text-muted f-14"><i class="fas fa-envelope" style="padding-right: 7px !important;"></i>{{$username}}</a>
                                <a href="{{route('home.changePass',['email' => $username])}}" class="dropdown-item text-muted f-14"><i class="fas fa-lock-open" style="padding-right: 5px !important;"></i>Đổi mật khẩu</a>
                                <a href="{{route('home.logout')}}" class="dropdown-item text-muted f-14"><i class="fas fa-right-from-bracket " style="padding-right: 7px !important;"></i>Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                    ?>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{route('home.loginForm')}}" class="d-flex align-items-center nav-item text-white btn btn-primary rounded mr-3"><i class="fa-regular fa-circle-user mr-1" style="font-size: 18px;"></i><span class="f-14">Đăng nhập</span></a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </div>
    </div>
</div>
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
                            <input class="btn btn-info rounded" type="submit" name="save" value="Lưu thay đổi"/>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </form>
</div>
@endsection