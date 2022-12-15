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
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Lịch sử đơn hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{route('home.page')}}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Lịch sử đơn hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-10 mb-5 m-auto">
            <div class="contact-form bg-gray shadow rounded py-4 px-5">
                <div id="success"></div>
                <span class="f-18 text-gray d-flex justify-content-center font-weight-bold mb-3">
                    Thông tin lịch sử đơn hàng
                </span>
                <div class="container mt-5 p-3 rounded cart">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            @foreach($detailOrder as $key => $od)
                            @php
                                $total = $od->price_product_order * $od->quantity_product_order;
                            @endphp
                            <div class="product-details mr-2">
                                <div class="shadow d-flex border-info justify-content-between align-items-center mt-3 p-2 items rounded">
                                    <div class="d-flex flex-row"><img class="rounded" src="{{asset('images/product/'.$od->image_product_color)}}" width="50">
                                        <div class="ml-2"><span class="f-16 d-block">{{$od->name_product_order}}</span><span class="spec">Màu: {{$od->name_color}}</span></div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <span class="d-block f-14">x{{$od->quantity_product_order}}</span>
                                        <span class="d-block ml-5 f-14">{{number_format($total,0,',','.')}} ₫</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <div class="rounded text-white p-3 bg-info">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-center f-18 font-weight-bold">Chi tiết người mua</span>
                                </div>
                                @csrf
                                <span class="f-12 d-block mt-3 mb-1">Mã đơn hàng: {{$filterDelivery->code_order}}</span>
                                <span class="f-12 d-block mt-3 mb-1">Tên người mua: {{$filterDelivery->name_customer}}</span>
                                <span class="f-12 d-block mt-3 mb-1">Số điện thoại: {{$filterDelivery->phone_order}}</span>
                                <span class="f-12 d-block mt-3 mb-1">Địa chỉ nhận hàng: {{$filterDelivery->address_order}}</span>
                                <hr class="line">
                                <div class="d-flex justify-content-between information mb-3">
                                    <span class="f-14">Tổng tiền phải trả</span>
                                    <span class="f-14">{{$filterDelivery->total_order}}</span>
                                </div>
                                <div class="detail-product d-flex w-50 justify-content-center bg-light border-img mb-2">
                                    <button data-order="{{$filterDelivery->id_order}}" class="cancel-order py-1 btn btn-light flex-fill me-1 p-0 f-16">
                                        <span class="f-12">Huỷ đơn hàng</span>
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection