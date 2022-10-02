@extends('home')
@section('content')
    <!-- Navbar Start -->
    <?php
        use Illuminate\Support\Facades\Route;
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
                                    <a href="" class="dropdown-item text-muted text-12 text-center">{{$b->name_brand}}</a>
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{$selectByCategory->name_category}}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">{{$selectByCategory->name_category}}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Lọc theo giá tiền</h5>
                    <form>
                        <?php
                            $nameCategory = $selectByCategory->name_category;
                            $routeAll = route('category.productByCategory',[$nameCategory]);
                            $routeUnder5 = route('category.productByCategory',[$nameCategory, 'max' => 5000000]);
                            $route5To10 = route('category.productByCategory',[$nameCategory, 'min' => 5000000, 'max' => 10000000]);
                            $route10To20 = route('category.productByCategory',[$nameCategory, 'min' => 10000000, 'max' => 20000000]);
                            $route20To30 = route('category.productByCategory',[$nameCategory, 'min' => 20000000, 'max' => 30000000]);
                            $routeUp30 = route('category.productByCategory',[$nameCategory, 'min' => 30000000]);
                        ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if(!$max && !$min) checked @endif onclick="location.href='{{$routeAll}}'" id="price-all">
                            <label class="custom-control-label f-14" for="price-all">Tất cả các giá</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div> 
                         
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if($max == 5000000) checked @endif @if($max == 5000000) onclick="location.href='{{$routeAll}}'" @else onclick="location.href='{{$routeUnder5}}'" @endif id="price-1">
                            <label class="custom-control-label f-14" for="price-1">Dưới 5 triệu</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div>
                        
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if($max == 10000000) checked @endif @if($max == 10000000) onclick="location.href='{{$routeAll}}'" @else onclick="location.href='{{$route5To10}}'" @endif id="price-2">
                            <label class="custom-control-label f-14" for="price-2">5 triệu - 10 triệu</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if($max == 20000000) checked @endif @if($max == 20000000) onclick="location.href='{{$routeAll}}'" @else onclick="location.href='{{$route10To20}}'" @endif id="price-3">
                            <label class="custom-control-label f-14" for="price-3">10 triệu - 20 triệu</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if($max == 30000000) checked @endif @if($max == 30000000) onclick="location.href='{{$routeAll}}'" @else onclick="location.href='{{$route20To30}}'" @endif id="price-4">
                            <label class="custom-control-label f-14" for="price-4">20 triệu - 30 triệu</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" @if($min == 30000000) checked @endif @if($min == 30000000) onclick="location.href='{{$routeAll}}'" @else onclick="location.href='{{$routeUp30}}'" @endif id="price-5">
                            <label class="custom-control-label f-14" for="price-5">Trên 30 triệu</label>
                            <span class="badge border font-weight-normal">{{$numberFindProduct}}</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Color Start -->
                <!-- <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> -->
                <!-- Color End -->

                <!-- Size Start -->
                <!-- <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> -->
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="{{route('category.productByCategory', $selectByCategory->name_category)}}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên sản phẩm">
                                    <div class="input-group-append">
                                        <button type="submit" style="outline:none;" class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle f-14" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sắp xếp theo
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item f-14" href="{{route('category.productByCategory',['nameCategory' => $selectByCategory->name_category, 'filterPrice' => 'asc'])}}">Giá tăng dần</a>
                                    <a class="dropdown-item f-14" href="{{route('category.productByCategory',['nameCategory' => $selectByCategory->name_category, 'filterPrice' => 'desc'])}}">Giá thấp dần</a>
                                    <a class="dropdown-item f-14" href="{{route('category.productByCategory',['nameCategory' => $selectByCategory->name_category, 'filterPrice' => 'popular'])}}">Phổ biến nhất</a>
                                    <a class="dropdown-item f-14" href="{{route('category.productByCategory',['nameCategory' => $selectByCategory->name_category, 'filterPrice' => 'evaluate'])}}">Đánh giá cao</a>
                                    <a class="dropdown-item f-14" href="{{route('category.productByCategory',['nameCategory' => $selectByCategory->name_category, 'filterPrice' => 'name'])}}">Tên từ A->Z</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($searchProduct)
                    <div class="col-12 pb-3">
                        <span class="text-dark">{{$numberFindProduct}}</span> kết quả trả về cho từ khóa <span class="text-dark">"{{$searchProduct}}"</span>
                    </div>
                    @endif
                    @if(isset($selectProductByCategory))
                    @foreach($selectProductByCategory as $key => $spbc)
                    <div class="col-lg-3 col-md-3 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{url('images/product/'.$spbc->image_product)}}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center spbc-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$spbc->name_product}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{number_format($spbc->price_product,0,',','.')}} ₫</h6><h6 class="text-muted ml-2"><del class="f-14">{{number_format($spbc->price_product,0,',','.')}} ₫</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{route('product.detailProduct',['idProduct'=>$spbc->id])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                                <form action="{{route('cart.saveCart')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <!-- <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">{!!$selectProductByCategory->links()!!}</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li> -->
                            {!!$selectProductByCategory->links()!!}
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection