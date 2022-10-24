@extends('home')
@section('content')
<!-- Navbar Start -->
<?php
    use Illuminate\Support\Facades\Session;
?>
<div class="container-fluid">
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
                        <a href="#" class="nav-link">{{$c->name_category}} <i class="fa fa-angle-right float-right mt-1"></i></a>
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
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="{{route('home.page')}}" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between bg-white-smoke" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="#" class="nav-item nav-link text-gray active">Trang chủ</a>
                        <a href="shop.html" class="nav-item nav-link text-gray">Shop</a>
                        <a href="detail.html" class="nav-item nav-link text-gray">Shop Detail</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link text-gray dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link text-gray">Liên hệ</a>
                    </div>
                    <?php
                        $idCustomer = Session::get('id',null);
                        $username = Session::get('username',null);
                        $imageCustomer = Session::get('imageCustomer',null);
                        $nameCustomer = Session::get('nameCustomer',null);
                        if(isset($username)){
                    ?>
                    <div class="ml-auto py-0 profile profile-hover dropdown">
                        <img class="w-37 h-25 img-profile profile-hover dropdown " src="{{url('images/customer/'.$imageCustomer)}}" alt="">
                        <div class="nav-item">
                            <div class="dropdown-menu d-none left-profile__63 top-profile__127 profile-info rounded-0 m-0">
                                <a href="#" class="dropdown-item text-muted f-14"><i class="fas fa-signature pr-1"></i>{{$nameCustomer}}</a>
                                <a href="cart.html" class="dropdown-item text-muted f-14"><i class="fas fa-envelope" style="padding-right: 7px !important;"></i>{{$username}}</a>
                                <a href="{{route('home.logout')}}" class="dropdown-item text-muted f-14"><i class="fas fa-right-from-bracket " style="padding-right: 7px !important;"></i>Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                    ?>
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{route('home.loginForm')}}" class="nav-item nav-link text-gray">Đăng nhập</a>
                        <a href="{{route('home.loginForm')}}" class="nav-item nav-link text-gray">Đăng ký</a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông tin đặt hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thông tin đặt hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="grid">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div class="mb-4 background-check rounded m-center f-16">
                    <h5 class="font-weight-semi-bold m-0 bg-secondary p-3">Thông tin khách hàng</h4>
                    @csrf
                    @php
                        $checkInfo = Session::get('info');
                        $typeShipping = $checkInfo['typeShipping'];
                    @endphp
                    <div class="row px-3">
                        <div class="col-md-12 form-group f-16 pt-3">
                            Người đặt:<span class="f-16 text-dark name-order"> {{$checkInfo['nameOrder']}}</span>
                        </div>
                        <div class="col-md-12 form-group f-16 ">
                            Số điện thoại:<span class="f-16 text-dark phone-order"> {{$checkInfo['phoneOrder']}}</span>
                        </div>
                        <div class="col-md-12 form-group f-16 ">
                            Email:<span class="f-16 text-dark email-order"> {{$checkInfo['emailOrder']}}</span>
                        </div>
                        @if($typeShipping == 0)
                        <div class="col-md-12 form-group f-16 ">
                            Nhận sản phẩm tại:<span class="f-16 text-dark address-order"> {{$checkInfo['addressOrder']}}</span>
                        </div>
                        @else
                        <div class="col-md-12 form-group f-16 ">
                            Giao hàng tại:<span class="f-16 text-dark address-order"> {{$checkInfo['addressOrder']}}</span>
                        </div>
                        @endif
                        <div class="col-md-12 form-group f-16 ">
                            Tổng tiền:<span class="f-16 text-dark total-order"> {{$checkInfo['totalOrder']}}</span>
                        </div>
                    </div>
                    @if($typeShipping == 1)
                    <div class="form-group f-16">
                        <div class="card-header bg-secondary border-0">
                            <h5 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" value="0" id="paypal">
                                    <label class="custom-control-label click-cash" for="paypal">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input collapsed" name="payment" data-toggle="collapse" data-target="#show-card" name="payment" value="1" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Chuyển khoản</label>
                                </div>
                            </div>
                            <div class="form-group collapse" id="show-card">
                                <div class="row justify-content-center">
                                    <div data-card="0" class="col-lg-5 border rounded shadow-sm px-3 mr-5 momo-card">Thanh toán qua Momo <br>
                                        <img class="w-75 m-center" src="https://cellphones.com.vn/cart/_nuxt/img/moca.f4be0b9.png" alt="">
                                    </div>
                                    <div data-card="1" class="col-lg-5 border rounded shadow-sm px-3 ml-2 vnpay-card">Thanh toán qua VNPay <br>
                                        <img class="w-75 m-center" src="https://cellphones.com.vn/cart/_nuxt/img/vnpay.c0bd59b.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3">
                        <button class="btn btn-primary rounded m-center d-flex add-order">Tiến hàng đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
@endsection