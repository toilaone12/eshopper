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
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between bg-white-smoke" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('home.page')}}" class="f-16 nav-item nav-link text-info active">Trang chủ</a>
                        <a href="shop.html" class="nav-item nav-link text-info f-16">Tình trạng đơn hàng</a>
                        <a href="contact.html" class="nav-item nav-link text-info f-16">Liên hệ</a>
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
                        <a href="{{route('home.loginForm')}}" class="nav-item text-white btn btn-primary rounded mr-3">Đăng nhập</a>
                        <a href="{{route('home.loginForm')}}" class="nav-item text-white btn btn-primary rounded">Đăng ký</a>
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
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông tin mua hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thông tin mua hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="grid">
        <div class="row px-xl-5">
            <div class="col-lg-7">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin khách hàng</h4>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="name">Họ và tên</label>
                            <input class="form-control" id="name" name="name_order" type="text" placeholder="Họ và tên (bắt buộc)">
                            <span class="text-danger f-14 error-text error-name_order"></span>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" id="phone" name="phone_order" type="tel" placeholder="Số điện thoại (bắt buộc)">
                            <span class="text-danger f-14 error-text error-phone_order"></span>

                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email_order" type="email" placeholder="Email">
                            <span class="text-danger f-14 error-text error-email_order"></span>
                        </div>
                        <div class="col-md-12">
                            <h4 class="font-weight-semi-bold mb-4">Phương thức giao hàng</h4>
                            <span class="text-danger f-14 error-text error-type_shipping"></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="type_ship" class="custom-control-input go-store name-shipping" value="0" id="inshop">
                                    <label class="custom-control-label" for="inshop" data-toggle="collapse" data-target="#go-store">Nhận tại cửa hàng</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="type_ship" class="custom-control-input shipping-address name-shipping" value="1" id="shipto">
                                    <label class="custom-control-label" for="shipto" data-toggle="collapse" data-target="#shipping-address">Giao hàng tận nơi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse-store mb-4 d-none" id="go-store">
                    <h4 class="font-weight-semi-bold mb-4">Địa chỉ cửa hàng</h4>
                    <div class="row">
                        <div class="col-md-12 form-group f-16">
                            Địa chỉ: <span class="f-14 name-address"> Triều Khúc, Tân Triều, Hà Nội</span>
                        </div>
                    </div>
                </div>
                <div class="collapse-address mb-4 d-none" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Địa chỉ giao hàng</h4>
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-12 form-group">
                            <label for="exampleFormControlInput1">Tên tỉnh, thành phố</label>
                            <select name="province_feeship" id="province" class="form-control choose province">
                                <option value="" class="f-14">Tỉnh / Thành phố</option>
                                @foreach($selectProvince as $key => $p)
                                <option value="{{$p->id_province}}" class="f-14 fee-province">
                                    {{$p->name_province}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleFormControlInput2">Tên quận, huyện</label>
                            <select name="district_feeship" id="district" class="form-control choose">
                                <option value="" class="f-14">Quận / Huyện</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="exampleFormControlInput3">Tên phường, xã</label>
                            <select name="commune_feeship" id="commune" class="form-control choose">
                                <option value="" class="f-14">Phường / Xã</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="address">Địa chỉ cụ thể</label>
                            <input class="form-control" name="address_order" id="address" type="text" placeholder="Địa chỉ cụ thể">
                        </div>
                        <button class="btn btn-primary rounded add-delivery">Tính phí vận chuyển</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Đơn đặt hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-medium f-14 mb-3">Tên sản phẩm</span>
                            <span class="font-weight-medium f-14 mb-3">Màu sắc</span>
                            <span class="font-weight-medium f-14 mb-3">Số lượng</span>
                            <span class="font-weight-medium f-14 mb-3">Giá sản phẩm</span>
                        </div>
                        @php
                            $cart = Session::get('cart');
                            $coupon = Session::get('coupon');
                            $fee = Session::get('fee');
                            $allTotal = 0;
                        @endphp
                        @foreach($cart as $key => $c)
                        @php
                            $totalProduct = $c['quantityProduct'] * $c['priceProduct'];
                            $allTotal += $totalProduct;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <p class="font-weight-medium f-14 mb-3 text-product-order">{{$c['nameProduct']}}</p>
                            <p class="font-weight-medium f-14 ml-3 text-product-order">{{$c['colorProduct']}}</p>
                            <p class="font-weight-medium f-14 mb-3 mr-4">{{$c['quantityProduct']}}</p>
                            <p class="font-weight-medium f-14 mb-3 mr-1 price-product-order">{{number_format($totalProduct,0,',','.')}} ₫</p>
                        </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium f-14">Tổng tiền</h6>
                            <h6 class="font-weight-medium f-14">{{number_format($allTotal,0,',','.')}} ₫</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium f-14">Mã giảm giá</h6>
                            <h6 class="font-weight-medium f-14">
                                @if(isset($coupon))
                                @foreach($coupon as $key => $cou)
                                    @if($cou['feature_coupon'] == 0)
                                    {{$cou['discount_coupon']}} %
                                    @else
                                    {{number_format($cou['discount_coupon'],0,',','.')}} ₫
                                    @endif
                                @endforeach
                                @else
                                    {{0}} ₫
                                @endif
                            </h6> 
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium f-14">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium f-14">
                                @if(isset($fee))
                                    {{number_format($fee,0,',','.')}} ₫
                                @else
                                    {{0}} ₫
                                @endif
                            </h6> 
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold f-16">Tổng cộng</h5>
                            <h5 class="font-weight-bold f-16 total-order">
                                @if(($coupon) && ($fee))
                                    @foreach($coupon as $key => $cou)
                                        @if($cou['feature_coupon'] == 0)
                                        {{number_format($allTotal - (($cou['discount_coupon'] / 100) * $allTotal) + $fee,0,',','.')}} ₫
                                        @else
                                        {{number_format($allTotal - $cou['discount_coupon'] + $fee,0,',','.')}} ₫
                                        @endif
                                    @endforeach
                                @elseif(isset($coupon))
                                    @foreach($coupon as $key => $cou)
                                        @if($cou['feature_coupon'] == 0)
                                        {{number_format($allTotal - (($cou['discount_coupon'] / 100) * $allTotal),0,',','.')}} ₫
                                        @else
                                        {{number_format($allTotal - $cou['discount_coupon'],0,',','.')}} ₫
                                        @endif
                                    @endforeach
                                @elseif(isset($fee))
                                    {{number_format($allTotal + $fee,0,',','.')}} ₫
                                @else
                                    {{number_format($allTotal,0,',','.')}} ₫
                                @endif
                            </h5> 
                        </div>
                    </div>
                </div>
                
                <div class="card-footer show-cash border-secondary bg-transparent">
                    <button class="btn btn-lg btn-block rounded btn-primary font-weight-bold my-3 py-3 pay-cart">Tiếp tục</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
@endsection