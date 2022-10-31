<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link href="{{asset('frontend/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.css">
    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
</head>
<body class="body">
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Trợ giúp</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Hỗ trợ</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="{{route('home.page')}}" class="text-decoration-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-6 text-right">
                    <a href="" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                    <div href="{{route('cart.checkCart')}}" class="btn border cart-hover">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        @php
                            use Illuminate\Support\Facades\Session;
                            $cart = Session::get('cart');
                        @endphp
                        <span class="badge">
                            @if(isset($cart))
                                {{count($cart)}}
                            @else
                                0
                            @endif
                        </span>
                        <div class="cart-menu">
                            <div class="f-12 pl-2 pb-3">Sản phẩm trong giỏ hàng</div>
                            @if(isset($cart))
                            @foreach($cart as $key => $c)
                            <div class="d-flex justify-content-between align-items-start" style="max-width: 100%;">
                                <img src="{{asset('images/product/'.$c['imageProduct'])}}" alt="" class="image-cart mt-2 ml-2 py-1 border border-secondary">
                                <span class="text-cart text-dark f-14 pl-3 pt-1">{{$c['nameProduct']}}</span>
                                <span class="price-cart text-info f-14 pr-2 pl-5 pt-1">{{number_format($c['priceProduct'],0,',','.')}} ₫</span>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-between" style="max-width: 100%;">
                                <div class="f-12 py-2 pl-2">Có {{count($cart)}} sản phẩm trong giỏ hàng</div>
                                <a href="{{route('cart.checkCart')}}" class="f-12 btn-cart rounded mr-2">Xem giỏ hàng</a>
                            </div>
                            @else
                            <div class="f-16 text-center">Không có sản phẩm nào trong giỏ hàng</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    @yield('content')

    
    
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <script>
    $(document).on('mouseenter','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        for(var count = 1; count <= 5; count++){
            $('#'+product_id+'-'+count).css('color','#ccc');
        }
        for(var count = 1; count <= index; count++){
            if(index == 1){
                $('#'+product_id+'-'+count).css('color','#ccc');
            }else{
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        }
    });    
    $(document).on('click','.rating',function(){
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        var token = $('input[name="_token"]').val();
        $(document).on('click','.send-review',function(){
            var nameReview = $('.review-name').val();
            var contentReview = $('.review-content').val();
            $.ajax({
                url: "{{route('review.insertReview')}}",
                method: "POST",
                data:{name_review:nameReview,content_review:contentReview,index:index, id_product:product_id, _token:token},
                success:function(data){
                    if(data == 'done'){
                        // alert("Bạn đã đánh giá "+index+" trên 5 sao");
                    }else{
                        alert("Lỗi đánh giá sao");
                    }
                }
            })
        });
    });
    $(document).on('click','.send-comment',function(){
        var idProduct = $('.product-id').val();
        var nameComment = $('.comment-name').val();
        var answerComment = $('.comment-content').val();
        var token = $('input[name="_token"]').val();
        // alert(idProduct+"-"+nameComment+"-"+answerComment);
        $.ajax({
            url: "{{route('comment.insertComment')}}",
            method: "POST",
            data:{id_product:idProduct,name_comment:nameComment,answer_comment:answerComment,_token:token},
            success:function(data){
                if(data == 'done'){
                    // alert("Cảm ơn bạn đã hỏi!");
                }
            },
        });
    });
    $(document).on('click','.add-cart',function(){
        var _token = $('input[name="_token"]').val();
        var idProduct = $(this).data('id-product');
        $.ajax({
            url: "{{route('cart.addCart')}}",
            method: "POST",
            data:
            {
                _token:_token,
                id_product: idProduct,
            },
            success:function(data){
                if(data == "done"){
                    location.reload();
                }
            },
        });
    });
    $(document).on('click','.remove-product',function(){
        var id = $(this).data('id');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: "GET",
            data: 
            {
                id_product: id,
            },
            success:function(data){
                if(data == "done"){
                    location.reload();
                }
            }
        });
    });
    $('.quantity button').on('click', function () {
        var button = $(this);
        var id = button.parent().parent().find('input').data('id');
        var oldValue = button.parent().parent().find('input').val();
        var price = button.parent().parent().find('input').data('price');
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
            var newPrice = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newVal * price);
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                var newPrice = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(newVal * price);
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
        button.parent().parent().parent().parent().find('.total').text(newPrice);
        $.ajax({
            url: "{{route('cart.updateCart')}}",
            method: "GET",
            data: {
                id_product: id,
                quantity_product: newVal,
            },
            success:function(data){
                if(data == "done"){
                    location.href = "{{route('cart.checkCart')}}";
                }
                // console.log(data);
            }
        });
    });
    $('.check-out').on('click',function(){
        location.href = "{{route('order.checkOut')}}";
    });
    $('.go-store').on('click',function(){
        $('.collapse-store').addClass('d-block');
        $('.collapse-address').removeClass('d-block');
    });
    $('.shipping-address').on('click',function(){
        $('.collapse-address').addClass('d-block');
        $('.collapse-store').removeClass('d-block');
    });
    $(document).ready(function(){
        $('.momo-card').on('click',function(e){
            $(this).addClass('border-danger');
            $(this).addClass('type-card');
            $('.vnpay-card').removeClass('border-danger');
            $('.vnpay-card').removeClass('type-card');
        });
        $('.vnpay-card').on('click',function(e){
            $(this).addClass('border-danger');
            $(this).addClass('type-card');
            $('.momo-card').removeClass('border-danger');
            $('.momo-card').removeClass('type-card');
        });
    });
    $(document).ready(function(){
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var idDistrict = $(this).val();
            var token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'province'){
                result = 'district';
            }else if(action == 'district'){
                result = 'commune';
            }
            // console.log(action+"-"+idDistrict+"-"+result);
            $.ajax({
                url: "{{route('delivery.selectDelivery')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name:action,
                    district:idDistrict,
                    token:token,
                },
                success:function(data){
                    $('#'+result).html(data);
                    // console.log(data);
                }
            });
        });
    });
    $(document).ready(function(){
        $('.add-delivery').on('click',function(){
            var province = $('.province').val();
            var token = $('input[name="_token"]').val();
            if(province === ''){
                alert("Bạn chưa chọn thông tin!");
            }else{
                $.ajax({
                    url: "{{route('delivery.addDelivery')}}",
                    method: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        province:province,
                        token:token,
                    },
                    success:function(data){
                        // console.log(data);
                        if(data == "return"){
                            location.reload();
                        }
                    }
                })
            }
        });
    });
    $(document).ready(function(){
        $('.pay-cart').on('click',function(e){
            e.preventDefault();
            var typeShipping = $("input[type='radio'][name='type_ship']:checked").val();
            var nameOrder = $("input[type='text'][name='name_order']").val();
            var phoneOrder = $("input[type='tel'][name='phone_order']").val();
            var emailOrder = $("input[type='email'][name='email_order']").val();
            var totalOrder = $(".total-order").text();
            var addressOrder = '';
            if(typeShipping == 0){
                var addressOrder = $(".name-address").text();
            }else if(typeShipping == undefined){
                var addressOrder = '';
                var typeShipping = '';
            }else{
                var addressOrder = $("input[type='text'][name='address_order']").val();
            }
            $.ajax({
                url: "{{route('order.saveInfo')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    type_shipping:typeShipping,
                    name_order:nameOrder,
                    address_order:addressOrder,
                    phone_order:phoneOrder,
                    email_order:emailOrder,
                    total_order:totalOrder,
                },
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error,function(key, value){
                            $('.error-'+key).text(value[0]);
                        });
                    }else if(data.status == 1){
                        location.href = "{{route('order.checkInfo')}}";
                    }
                },
            });
            // alert(typeShipping+"-"+nameOrder+"-"+emailOrder+"-"+phoneOrder+"-"+addressOrder+"-"+totalOrder);
        })
        $('.add-order').on('click',function(e){
            Swal.fire({
                title: 'Bạn có muốn đặt hàng không?',
                text: "Bạn nên kiểm tra chắc chắn thông tin trước khi đặt hàng nhé!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi đồng ý!',
                cancelButtonText: "Không",
                }).then((result) => {
                if (result.isConfirmed) {
                    e.preventDefault();
                    var nameOrder = $('.name-order').text();
                    var phoneOrder = $('.phone-order').text();
                    var emailOrder = $('.email-order').text();
                    var totalOrder = $('.total-order').text();
                    var addressOrder = $('.address-order').text();
                    var token = $('input[name="_token"]').val();
                    var typeShipping = "{{(isset($typeShipping)) ? $typeShipping : ''}}";
                    var discountOrder = "{{(isset($coupon)) ? $coupon[0]['name_coupon'] : ''}}";
                    var feeDelivery = "{{(isset($fee)) ? $fee : 0}}"
                    var typePayment = $("input[type='radio'][name='payment']:checked").val();
                    var namePayment = '';
                    var statusOrder = '';
                    if(typeShipping == 0){
                        statusOrder = "Nhận sản phẩm tại cửa hàng";
                    }else{
                        statusOrder = "Cửa hàng vận chuyển cho khách hàng";
                    }
                    if(typePayment){
                        if(typePayment == 0){
                            namePayment = "Thanh toán khi nhận hàng";
                        }else if(typePayment == 1){
                            var typeCard = $('.type-card').data('card');
                            if(typeCard == 0){
                                namePayment = $('.type-card').text();
                            }else if(typeCard == 1){
                                namePayment = $('.type-card').text();
                            }
                        }
                    }else{
                        namePayment = '';
                    }
                    // alert(feeDelivery);
                    $.ajax({
                        url: "{{route('order.addOrder')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            nameOrder:nameOrder,
                            phoneOrder:phoneOrder,
                            emailOrder:emailOrder,
                            addressOrder:addressOrder,
                            totalOrder:totalOrder,
                            statusOrder:statusOrder,
                            namePayment:namePayment,
                            discountOrder:discountOrder,
                            feeDelivery:feeDelivery,
                            token:token,
                        },
                        success:function(data){
                            window.location.href = "{{route('cart.checkCart')}}";
                            // console.log(data);
                        }
                    });
                    Swal.fire(
                    'Đặt hàng thành công!',
                    'Vui lòng kiểm tra mã đơn hàng tại email của bạn',
                    'success'
                    )
                }
            })
        });
    });
</script>
    <!-- Template Javascript -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>