@extends('home')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
?>
<body>
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
<div class="container">
    <div class="main-body">
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home.page')}}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="">Cá nhân</a></li>
              <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{url('images/customer/'.$customer->image_customer)}}" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h6>{{$customer->name_customer}}</h6>
                            <p class="text-muted font-size-sm">{{$customer->address_cutomer}}</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="mb-0">
                                <?php
                                    $message = Session::get('message_profile');
                                    if(isset($message)){
                                        echo $message;
                                        Session::put('message_profile',null);
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Họ & tên</h6>
                        </div>
                        <div class="col-sm-9 text-dark">
                        {{$customer->name_customer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-dark">
                        {{$customer->email_customer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                        <h6 class="mb-0">Số điện thoại</h6>
                        </div>
                        <div class="col-sm-9 text-dark">
                        {{$customer->phone_customer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Giới tính</h6>
                        </div>
                        <div class="col-sm-9 text-dark">
                        {{$customer->sex_customer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Địa chỉ</h6>
                        </div>
                        <div class="col-sm-9 text-dark">
                        {{$customer->address_customer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="btn btn-info rounded" target="__blank" href="{{route('customer.formEditProfile',['idCustomer' => $customer->id_customer])}}">Sửa thông tin</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
</body>
@endsection