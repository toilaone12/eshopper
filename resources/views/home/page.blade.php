@extends('home')
@section('content')
<!-- Navbar Start -->
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
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 bg-white" style="height: 410px">
                    @foreach($selectCategory as $key => $c)
                    <div class="nav-item dropleft">
                        <a href="{{route('category.productByCategory',['nameCategory' => $c->name_category])}}" class="nav-link hover-brand text-gray">{{$c->name_category}} <i class="fa fa-angle-right float-right mt-1" style="color: #343a40;"></i></a>
                        <div class="brand-hover dropdown-menu position-absolute bg-light border-0 rounded-5 w-100 py-3 pr-3 m-0">
                            <h6 class="text-center">Hãng sản xuất</h4> 
                            <ul class="row justify-content-center list-style-none pl-0" >
                                @foreach($selectBrand as $key => $b)
                                <li class="col-4">
                                    <a href="{{route('brand.productByBrand', ['nameBrand' => $b->name_brand])}}" class="dropdown-item text-muted text-12 text-center">{{$b->name_brand}}</a>
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
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($selectFirstSlide as $key => $sf)
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="{{url('images/slide/'.$sf->image_slide)}}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Giảm giá ngay trong tháng này</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Giá cả phải chăng</h3>
                                <a href="" class="btn btn-light py-2 px-3">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach($selectSlide as $key => $s)
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="{{url('images/slide/'.$s->image_slide)}}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">Giảm giá ngay trong tháng này</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Giá cả phải chăng</h3>
                                <a href="" class="btn btn-light py-2 px-3">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Featured Start -->
<div class="grid">
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Đảm bảo chất lượng</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hoàn trả trong vòng 14 ngày</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="grid">
    <div class="container-fluid pt-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach($selectBrand as $key => $b)
                <div class="col">
                    <div class="cat-item d-flex flex-column border mb-4" style="width: 160px; height: 150px; padding: 30px;">
                        <a href="" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid image-center" src="{{url('images/brand/'.$b->logo_brand)}}" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0 text-center">{{$b->name_brand}}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<!-- <div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Offer End -->


<!-- Products Start -->
<div class="grid">
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Tất cả sản phẩm</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach($selectOutstanding as $key => $outStanding)
            <div class="col-lg-2 col-md-3 col-sm-12 pb-2">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 rounded-top border-info">
                        <img class="img-fluid w-75 m-auto d-block" src="{{url('images/product/'.$outStanding->image_product)}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center outStanding-0 pt-4 pb-3 border-info">
                        <h6 class="text-truncate mb-3 f-16">{{$outStanding->name_product}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6 class="f-16">{{number_format($outStanding->price_product,0,',','.')}} ₫</h6><h6 class="text-muted ml-2 f-16"><del class="f-16">{{number_format($outStanding->price_product,0,',','.')}} ₫</del></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-light border rounded-bottom border-info">
                        <a href="{{route('product.detailProduct',['idProduct'=>$outStanding->id])}}" class="p-2 btn btn-info flex-fill me-1 p-0 f-16">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Products End -->


<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- Products Start -->
<div class="grid">
    @foreach($selectCategory as $key => $c)
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">{{$c->name_category}}</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach($selectProduct as $key => $p)
            @if($p->id_category == $c->id_category)
            <div class="col-lg-2 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4 rounded-lg">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border border-info p-0 rounded-top">
                        <img class="img-fluid w-75 m-auto d-block" src="{{url('images/product/'.$p->image_product)}}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3 border-info">
                        <h6 class="text-truncate mb-3 f-16">{{$p->name_product}}</h6>
                        <div class="d-flex justify-content-center">
                            <h6 class="f-16">{{number_format($p->price_product,0,',','.')}} ₫</h6><h6 class="text-muted ml-2 f-16"><del>{{number_format($p->price_product,0,',','.')}} ₫</del></h6>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-light border rounded-bottom border-info">
                        <a href="{{route('product.detailProduct',['idProduct'=>$p->id])}}" class="p-2 btn btn-info flex-fill me-1 p-0 f-16">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endforeach
    <!-- Products End -->
    
    
    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-1.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-2.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-3.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-4.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-5.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-6.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-7.jpg')}}" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="{{asset('frontend/img/vendor-8.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
@endsection