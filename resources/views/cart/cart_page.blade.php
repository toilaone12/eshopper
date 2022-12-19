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
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h3>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
@php
    $allTotal = 0;
    $cart = Session::get('cart');
@endphp
@if(isset($cart))
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive bg-gray pb-5 pt-3 rounded">
            <div class="card-body">
                <!-- Single item -->
                <div class="row">
                    @foreach($cart as $key => $c)
                    @php
                        $total = $c['priceProduct']*$c['quantityProduct'];
                        $allTotal += $total;
                    @endphp
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-3">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                        <img src="{{asset('images/product/'.$c['imageProduct'])}}"
                            class="w-75 m-auto rounded shadow" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                        </a>
                        </div>
                        <!-- Image -->
                    </div>

                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-3">
                        <!-- Data -->
                        <p><strong class="f-16">{{$c['nameProduct']}}</strong></p>
                        <p>Màu sắc: {{$c['colorProduct']}}</p>
                        <button type="button" class="btn btn-blue btn-sm-remove rounded me-1 mb-2 remove-product" data-mdb-toggle="tooltip"
                        title="Remove item" 
                        data-url="{{route('cart.removeCart')}}" 
                        data-id="{{$key}}">
                        <i class="fas fa-trash"></i>
                        </button>
                        <!-- Data -->
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-3">
                        <!-- Quantity -->
                        <div class="d-flex mb-4" style="max-width: 300px">
                            <div class="input-group quantity mx-auto" style="width: 110px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm rounded btn-blue btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" data-id="{{$c['idProduct']}}" min=1 data-product-color="{{$key}}" data-price="{{$c['priceProduct']}}" 
                                class="form-control form-control-sm bg-secondary text-center border-gray rounded mx-1"  value="{{$c['quantityProduct']}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm rounded btn-blue btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Quantity -->

                        <!-- Price -->
                        <p class="text-start text-md-center">
                        <span class="f-16">Giá tiền: <span class="f-16">{{number_format($total,0,',','.')}} ₫</span></span>
                        </p>
                        <!-- Price -->
                    </div>
                    @endforeach
                </div>
                <!-- Single item -->
            </div>
        </div>
        <div class="col-lg-4 w-75 float-right">
            <div class="bg-info rounded shadow p-3">
                @php
                    $message = Session::get('message');
                    $coupon = Session::get('coupon');
                @endphp
                @if(isset($message))
                <div class="text-danger f-14">{{$message}}</div>
                @else
                @endif
                @error('name_coupon')
                <div class="text-danger f-14">{{$message}}</div>
                @enderror
                <form class="mb-3" method="POST" action="{{route('cart.checkCoupon')}}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control rounded p-4 mr-2" name="name_coupon" placeholder="Nhập mã giảm giá">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary rounded">Nhập mã</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-2 rounded">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng tiền giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng tiền</h6>
                            <h6 class="font-weight-medium">{{number_format($allTotal,0,'.',',')}} ₫</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Áp dụng mã giảm giá</h6>
                            <h6 class="font-weight-medium">
                                @if(isset($coupon))
                                @foreach($coupon as $key => $cou)
                                    @if($cou['feature_coupon'] == 0)
                                    {{$cou['discount_coupon']}} %
                                    @else
                                    {{number_format($cou['discount_coupon'],0,'.',',')}} ₫
                                    @endif
                                @endforeach
                                @else
                                    {{'0 ₫'}}
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng cộng</h5>
                            <h5 class="font-weight-bold">
                                @if(isset($coupon))
                                @foreach($coupon as $key => $cou)
                                    @if($cou['feature_coupon'] == 0)
                                    {{number_format($allTotal - (($cou['discount_coupon'] / 100) * $allTotal),0,'.',',')}} ₫
                                    @else
                                    {{number_format($allTotal - $cou['discount_coupon'],0,'.',',')}} ₫
                                    @endif
                                @endforeach
                                @else
                                    {{number_format($allTotal,0,'.',',')}} ₫
                                @endif
                            </h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3 check-out">Mua hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid pt-5 pb-5">
    <div class="px-xl-5">
    <img src="{{asset('frontend/img/smile.png')}}" class="m-auto d-block pb-3 text-danger" alt="">
        <div class="text-center text-danger pb-3">Hiện tại đang không có sản phẩm trong giỏ hàng, vui lòng quay lại</div>
        <a href="{{route('home.page')}}" class="btn btn-danger rounded" style="display: block; width:15%; margin: 0 auto">Quay lại trang chủ</a>
    </div>
</div>
@endif
@endsection