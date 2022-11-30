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
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Xóa sản phẩm</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    
                    @foreach($cart as $key => $c)
                    @php
                        $total = $c['priceProduct']*$c['quantityProduct'];
                        $allTotal += $total;
                    @endphp
                    <tr>
                        <td class="align-middle"><img src="{{asset('images/product/'.$c['imageProduct'])}}" alt="" style="width: 50px;"></td>
                        <td class="align-middle">{{$c['nameProduct']}}</td>
                        <td class="align-middle">{{$c['colorProduct']}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" data-id="{{$key}}" data-product-color="{{$c['idProductColor']}}" data-price="{{$c['priceProduct']}}" class="form-control form-control-sm bg-secondary text-center" value="{{$c['quantityProduct']}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle total">{{number_format($total,0,'.',',')}} ₫</td>
                        <td class="align-middle"><button class="btn btn-sm btn-primary remove-product" data-url="{{route('cart.removeCart')}}" data-id="{{$key}}"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
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
            <form class="mb-5" method="POST" action="{{route('cart.checkCoupon')}}">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control p-4" name="name_coupon" placeholder="Nhập mã giảm giá">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Mã giảm giã</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
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
@else
<div class="container-fluid pt-5 pb-5">
    <div class="px-xl-5">
        <div class="text-center text-danger pb-3">Hiện tại đang không có sản phẩm trong giỏ hàng, vui lòng quay lại</div>
        <a href="{{route('home.page')}}" class="btn btn-danger rounded" style="display: block; width:15%; margin: 0 auto">Quay lại trang chủ</a>
    </div>
</div>
@endif
@endsection