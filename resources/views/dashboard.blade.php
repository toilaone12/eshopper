<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EShopper</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://kit.fontawesome.com/8c040fba7a.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Morris -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body id="page-top">

<?php
    use Illuminate\Support\Facades\Session;
?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EShopper</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.dashboard')}}">{{--s??? d???ng route() --}}
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                EShopper
            </div>
<!-- Nav Item - Pages Collapse Menu -->
            @if(Auth::check())
            @if(Auth::user()->id_role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo8"
                    aria-expanded="true" aria-controls="collapseTwo8">
                    <i class="fas fa-users"></i>
                    <span>Qu???n l??</span>
                </a>
                <div id="collapseTwo8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('admin.listUser')}}">Danh s??ch t??i kho???n</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" href="{{route('admin.insertFormUser')}}">Th??m t??i kho???n</a>
                    </div>
                </div>
            </li>
            @endif
            @endif
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-list"></i>
                    <span>Danh m???c</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('category.listCategory')}}">Danh s??ch danh m???c</a>
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <a class="collapse-item" href="{{route('category.insertFormCategory')}}">Th??m danh m???c</a>
                        @endif
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
                    aria-expanded="true" aria-controls="collapseTwo2">
                    <i class="fa-solid fa-copyright"></i>
                    <span>Th????ng hi???u</span>
                </a>
                <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('brand.listBrand')}}">Danh s??ch th????ng hi???u</a>{{--s??? d???ng route() --}}
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <a class="collapse-item" href="{{route('brand.insertFormBrand')}}">Th??m th????ng hi???u</a>{{--s??? d???ng route() --}}
                        @endif
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo14"
                    aria-expanded="true" aria-controls="collapseTwo14">
                    <i class="fa-solid fa-fill"></i>
                    <span>M??u s???c</span>
                </a>
                <div id="collapseTwo14" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('color.listColor')}}">Danh s??ch m??u s???c</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
                    aria-expanded="true" aria-controls="collapseTwo1">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>S???n ph???m</span>
                </a>
                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('product.listFormProduct')}}">Danh s??ch s???n ph???m</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3"
                    aria-expanded="true" aria-controls="collapseTwo3">
                    <i class="fa-brands fa-adversal"></i>
                    <span>Qu???ng c??o</span>
                </a>
                <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('slide.listSlide')}}">Danh s??ch qu???ng c??o</a>{{--s??? d???ng route() --}}
                        @if(Auth::check())
                        @if(Auth::user()->id_role == 1)
                        <a class="collapse-item" href="{{route('slide.insertFormSlide')}}">Th??m qu???ng c??o</a>{{--s??? d???ng route() --}}
                        @endif
                        @endif
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo13"
                    aria-expanded="true" aria-controls="collapseTwo13">
                    <i class="fa-solid fa-person"></i>
                    <span>Kh??ch h??ng</span>
                </a>
                <div id="collapseTwo13" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('customer.listCustomer')}}">Danh s??ch kh??ch h??ng</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            @if(Auth::check())
            @if(Auth::user()->id_role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo4"
                    aria-expanded="true" aria-controls="collapseTwo4">
                    <i class="fa-solid fa-question"></i>
                    <span>C??u h???i c???a kh??ch h??ng</span>
                </a>
                <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('comment.listComment')}}">Danh s??ch c??u h???i</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            @endif
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo5"
                    aria-expanded="true" aria-controls="collapseTwo5">
                    <i class="fa-solid fa-percent"></i>
                    <span>M?? gi???m gi??</span>
                </a>
                <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('coupon.listCoupon')}}">Danh s??ch m?? gi???m gi??</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" href="{{route('coupon.insertFromCoupon')}}">Th??m m?? gi???m gi??</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo6"
                    aria-expanded="true" aria-controls="collapseTwo6">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span>V???n chuy???n</span>
                </a>
                <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('delivery.listDelivery')}}">Danh s??ch ph?? v???n chuy???n</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" href="{{route('delivery.insertFromCoupon')}}">Th??m ph?? v???n chuy???n</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo7"
                    aria-expanded="true" aria-controls="collapseTwo7">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>????n h??ng</span>
                </a>
                <div id="collapseTwo7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('order.listOrder')}}">Danh s??ch ????n h??ng</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo9"
                    aria-expanded="true" aria-controls="collapseTwo9">
                    <i class="fa-sharp fa-solid fa-industry"></i>
                    <span>Nh?? cung c???p</span>
                </a>
                <div id="collapseTwo9" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" href="{{route('supplier.listSupplier')}}">Danh s??ch nh?? cung c???p</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" href="{{route('supplier.insertFormSupplier')}}">Th??m nh?? cung c???p</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo10"
                    aria-expanded="true" aria-controls="collapseTwo10">
                    <i class="fa-solid fa-warehouse"></i>
                    <span>Kho h??ng</span>
                </a>
                <div id="collapseTwo10" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('warehouse.listWareHouse')}}">Danh s??ch s???n ph???m trong kho</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo11"
                    aria-expanded="true" aria-controls="collapseTwo11">
                    <i class="fa-solid fa-note-sticky"></i>
                    <span>Phi???u</span>
                </a>
                <div id="collapseTwo11" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('note.listNote')}}">Danh s??ch phi???u h??ng</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('note.importFormNote')}}">Nh???p h??ng</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo12"
                    aria-expanded="true" aria-controls="collapseTwo12">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Th???ng k??</span>
                </a>
                <div id="collapseTwo12" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('statistic.listStatistic')}}">Th???ng k?? doanh thu</a>{{--s??? d???ng route() --}}
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('statistic.listStatisticNote')}}">Th???ng k?? phi???u xu???t h??ng</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <li class="nav-item">   
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo20"
                    aria-expanded="true" aria-controls="collapseTwo20">
                    <i class="fa-solid fa-address-book"></i>
                    <span>Li??n h???</span>
                </a>
                <div id="collapseTwo20" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ch???n:</h6>
                        <a class="collapse-item" style="white-space:normal !important;" href="{{route('contact.listContact')}}">Th??ng tin li??n h???</a>{{--s??? d???ng route() --}}
                    </div>
                </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <!-- <span class="badge badge-danger badge-counter">3+</span> -->
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler ?? 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                        $username = Session::get('usernameAdmin');
                                        if(isset($username)){
                                            echo $username;
                                        }else{
                                            echo "";
                                        }
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('backend/img/nguoidung.jfif')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('admin.logout')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ????ng xu???t
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                @yield('content')
                </div>

            </div>

    <!-- End of Main Content -->

    <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">B???n mu???n ????ng xu???t?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">H??y ???n n??t "????ng xu???t" ????? tr??? l???i ????ng nh???p</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">H???y b???</button>
                    <a class="btn btn-primary" href="{{route('admin.logout')}}">????ng xu???t</a>
                </div>
            </div>
        </div>
    </div>
    
    <script
    src="https://code.jquery.com/jquery-3.6.1.js"
    integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.min.js"></script>
    <!-- Morris -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- @Html.TextAreaFor(model=>model.CourseDescription, new { @id = "editor"}) -->
    <script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    CKEDITOR.config.pasteFormWordPromptCleanup = true;
    CKEDITOR.config.pasteFormWordRemoveFontStyles = false;
    CKEDITOR.config.pasteFormWordRemoveStyles = false;
    CKEDITOR.config.language = 'vi';
    CKEDITOR.config.htmlEncodeOutput = false;
    CKEDITOR.config.ProcessHTMLEntities = false;
    CKEDITOR.config.entities = false;
    CKEDITOR.config.entities_latin = false;
    CKEDITOR.config.ForceSimpleAmpersand = true;
    $(document).ready( function () {
        $('#table_id').DataTable();
        $('#table_id2').DataTable();
    } );
    </script>
    <script>
        $(document).on('click','.button-answer',function(){
            var commentId = $(this).data('comment-id');
            var productId = $(this).data('product-id');
            var answer = $('.answer-question-'+commentId).val();
            var token = $('input[name="_token"]').val();
            // alert(answer+"-"+commentId+"-"+productId+"-"+token);
            $.ajax({
                url: "{{route('comment.replyComment')}}",
                method: "POST",
                data:{reply_comment:answer,id_comment:commentId,id_product:productId,_token:token},
                success: function(data){
                    if(data == "done"){
                        location.reload();
                        alert('B???n ???? tr??? l???i th??nh c??ng!');
                    }
                },
            });
        });
        $('.datetime').datetimepicker({
            step: 1,
        });
        $('#datepicker1').datetimepicker({
            step: 1,
        });
        $('#datepicker2').datetimepicker({
            step: 1,
        });
        $('#datepicker3').datetimepicker({
            step: 1,
        });
        $('#datepicker4').datetimepicker({
            step: 1,
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
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
            $('.edit-delivery').on('blur',function(){
                var idDelivery = $(this).data('id');
                var feeDelivery = $(this).text();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('delivery.editDelivery')}}",
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        idDelivery:idDelivery,
                        feeDelivery:feeDelivery,
                        token:token,
                    },
                    success:function(data){
                        location.reload();
                        // $('#'+result).html(data);
                        // console.log(data);
                    }
                });
            });
        });
        $(document).ready(function(){
            $('.change-status').change(function(){
                var status = $(this).val();
                var orderId = $(this).children(":selected").data('id');
                var token = $('input[name="_token"]').val();
                var productId = [];
                var productColorId = [];
                var quantityOrder = [];
                var totalOrder = $('.total-order').data('total');
                $('input[name="product_id"]').each(function(){
                    productId.push($(this).val());
                });
                $('input[name="product_color_id"]').each(function(){
                    productColorId.push($(this).val());
                });
                $('.quantity-order').each(function(){
                    quantityOrder.push($(this).text());
                })
                // alert(productColorId);
                $.ajax({
                    url: "{{route('order.changeStatus')}}",
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        status:status,
                        orderId:orderId,
                        productId:productId,
                        productColorId:productColorId,
                        quantityOrder:quantityOrder,
                        totalOrder: totalOrder,
                        token:token,
                    },
                    success:function(data){
                        location.reload();
                        // $('#'+result).html(data);
                        // console.log(data);
                    }
                });
            });
            $('.delete-supplier').on('click',function(){
                var choose = [];
                $('.check-supplier:checked').each(function(){
                    choose.push($(this).val());
                });
                // console.log(choose);
                if(choose == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'B???n ch??a ch???n nh?? cung c???p mu???n x??a!'
                    });
                }
                $.ajax({
                    url: "{{route('supplier.deleteSupplier')}}",
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        choose:choose,
                    },
                    success:function(data){
                        location.reload();
                    } 
                });
            });
            $('.add-detail-note').on('click',function(){
                var nameProduct = [];
                var nameProductA = [];
                var quantityProduct = [];
                var priceProduct = [];
                var colorProduct = [];
                var token = $('input[name="_token"]').val();
                // if($('.name-product').val() === '' || $('.quantity-product').val() === '' || $('.price-product').val() === ''){
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'L???i',
                //         text: 'B???n ch??a nh???p phi???u h??ng!'
                //     });
                // }else{
                    // $('.price-product').each(function(){
                    //     priceProduct.push($(this).val());
                    // });
                    // $('.name-product').each(function(i1){
                    //     nameProduct.push($(this).val());
                    // });
                    // $('.color-product:checked').each(function(i2){
                    //     b = $(this).data('stt');
                    //     // console.log(i1+"--"+i2);
                    //     nameProduct.push($('#name-'+b).val());
                        
                    // });
                    $('.quantity-product').each(function(index1,val){
                        $('.color-product:checked').each(function(index){
                            if(index1 == index){
                                a = $(this).val();
                                b = $(this).data('stt');
                                if($(this).val() !== ''){
                                    quantityProduct.push($('#number-'+a+'-'+b).val());
                                }
                                colorProduct.push($(this).val());
                                nameProduct.push($('#name-'+b).val());   
                                priceProduct.push($('#price-'+b).val());
                            }
                        });
                    });
                    // console.log(nameProduct+"-"+colorProduct+"-"+quantityProduct+"-"+priceProduct);
                    $.ajax({
                        url: "{{route('note.importDetailNote')}}",
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            nameProduct:nameProduct,
                            colorProduct:colorProduct,
                            quantityProduct:quantityProduct,
                            priceProduct:priceProduct,
                            token:token
                        },
                        success:function(data){
                            // console.log(data);
                            window.location.href="{{route('note.listNote')}}";
                        } 
                    });
                // }
            });
        });
        $('.export-warehouse').on('click',function(e){
            e.stopPropagation();
            $('.warehouse').addClass('d-flex');
            $('.warehouse').removeClass('d-none');
            var nameWareHouse = $(this).data('name');
            var quantityWareHouse = $(this).data('quantity');
            var colorIdWareHouse = $(this).data('color-id');
            var colorNameWareHouse = $(this).data('color-name');
            $('.name-product').html('<label for="exampleFormControlInput1">T??n s???n ph???m</label><input type="text" class="form-control pe-none bg-light" value="'+nameWareHouse+'" name="name_product" id="exampleFormControlInput1" placeholder="Nh???p t??n">');
            $('.color-product').html('<label for="exampleFormControlInput1">M??u s???c</label><select name="color_product" class="form-select pe-none bg-light" id="exampleFormControlFile1"><option value="'+colorIdWareHouse+'">'+colorNameWareHouse+'</option></select>');
            $('.quantity-product').html('<label for="exampleFormControlSelect3">S??? l?????ng</label><input type="number" min=1 class="form-control pe-none bg-light" value="'+quantityWareHouse+'" name="quantity_product" id="exampleFormControlSelect3" placeholder="Nh???p s??? l?????ng">');
        });
        $('.close-warehouse').on('click',function(){
            $('.warehouse').addClass('d-none');
            $('.warehouse').removeClass('d-flex');
        });
        //Thong ke hoa don
        $(document).ready(function(){
            showStatisticMonth();
            var chartOrder = new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'areaChart',
                parseTime:false,
                // The name of the data record attribute that contains x-values.
                xkey: 'date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['price','quantity'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Gi??','S??? l?????ng']
            });
            function showStatisticMonth(){
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.showStatistic')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        token:token,
                    },
                    success:function(data){
                        chartOrder.setData(data);
                        // location.reload();
                    } 
                })
            }
            //tuy chon thoi gian
            $('.filter-date').on('click',function(e){
                var fromDate = $('#datepicker1').val();
                var toDate = $('#datepicker2').val();
                var token = $('input[name="_token"]').val();
                // alert(toDate+'-'+fromDate);
                if(fromDate == "" || toDate == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'Kh??ng ???????c ????? tr???ng th??ng tin!'
                    });
                }else{
                    if(fromDate >= toDate){
                        Swal.fire({
                            icon: 'error',
                            title: 'L???i',
                            text: 'Ng??y k???t th??c kh??ng ???????c b?? h??n ng??y b???t ?????u!'
                        });
                    }else{
                        $.ajax({
                            url: "{{route('statistic.filterDate')}}",
                            method: "POST",
                            dataType: "JSON",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                fromDate:fromDate,
                                toDate:toDate,
                                token:token,
                            },
                            success:function(data){
                                chartOrder.setData(data);
                            } 
                        })
                    }
                }
            });
            //chon theo ngay
            $('.choose-statistic').on('change',function(e){
                e.preventDefault();
                var choose = $(this).val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.filterSelect')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        choose:choose,
                        token:token,
                    },
                    success:function(data){
                        chartOrder.setData(data);
                        // location.reload();
                    } 
                })
            });
        });
        $(document).ready(function(){
            showStatisticImportMonth();
            showStatisticExportMonth();
            var chartImportNote = new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'importNoteChart',
                parseTime:false,
                // The name of the data record attribute that contains x-values.
                xkey: 'date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['price','quantity'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Gi??','S??? l?????ng']
            });
            var chartExportNote = new Morris.Area({
                // ID of the element in which to draw the chart.
                element: 'exportNoteChart',
                parseTime:false,
                // The name of the data record attribute that contains x-values.
                xkey: 'date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['price','quantity'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Gi??','S??? l?????ng']
            });
            function showStatisticExportMonth(){
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.showStatisticExport')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        token:token,
                    },
                    success:function(data){
                        chartExportNote.setData(data);
                        // location.reload();
                    } 
                })
            }
            function showStatisticImportMonth(){
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.showStatisticImport')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        token:token,
                    },
                    success:function(data){
                        chartImportNote.setData(data);
                        // location.reload();
                    } 
                })
            }
            //tuy chon thoi gian
            $('.filter-date-import').on('click',function(e){
                var fromDate = $('#datepicker3').val();
                var toDate = $('#datepicker4').val();
                var token = $('input[name="_token"]').val();
                // alert(toDate+'-'+fromDate);
                if(fromDate == "" || toDate == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'Kh??ng ???????c ????? tr???ng th??ng tin!'
                    });
                }else{
                    if(fromDate >= toDate){
                        Swal.fire({
                            icon: 'error',
                            title: 'L???i',
                            text: 'Ng??y k???t th??c kh??ng ???????c b?? h??n ng??y b???t ?????u!'
                        });
                    }else{
                        $.ajax({
                            url: "{{route('statistic.filterDateImport')}}",
                            method: "POST",
                            dataType: "JSON",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                fromDate:fromDate,
                                toDate:toDate,
                                token:token,
                            },
                            success:function(data){
                                chartImportNote.setData(data);
                            } 
                        })
                    }
                }
            });
            $('.filter-date-export').on('click',function(e){
                var fromDate = $('#datepicker1').val();
                var toDate = $('#datepicker2').val();
                var token = $('input[name="_token"]').val();
                // alert(toDate+'-'+fromDate);
                if(fromDate == "" || toDate == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'Kh??ng ???????c ????? tr???ng th??ng tin!'
                    });
                }else{
                    if(fromDate >= toDate){
                        Swal.fire({
                            icon: 'error',
                            title: 'L???i',
                            text: 'Ng??y k???t th??c kh??ng ???????c b?? h??n ng??y b???t ?????u!'
                        });
                    }else{
                        $.ajax({
                            url: "{{route('statistic.filterDateExport')}}",
                            method: "POST",
                            dataType: "JSON",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                fromDate:fromDate,
                                toDate:toDate,
                                token:token,
                            },
                            success:function(data){
                                chartExportNote.setData(data);
                            } 
                        })
                    }
                }
            });
            //chon theo ngay
            $('.choose-statistic-import').on('change',function(e){
                e.preventDefault();
                var choose = $(this).val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.filterSelectImport')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        choose:choose,
                        token:token,
                    },
                    success:function(data){
                        // chartExportNote.setData(data);
                        chartImportNote.setData(data);
                        // location.reload();
                    } 
                })
            });
            $('.choose-statistic-export').on('change',function(e){
                e.preventDefault();
                var choose = $(this).val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.filterSelectExport')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        choose:choose,
                        token:token,
                    },
                    success:function(data){
                        // chartExportNote.setData(data);
                        chartExportNote.setData(data);
                        // location.reload();
                    } 
                })
            });
            $('.choose-statistic-export').on('change',function(e){
                e.preventDefault();
                var choose = $(this).val();
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('statistic.filterSelectExport')}}",
                    method: "POST",
                    dataType: "JSON",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        choose:choose,
                        token:token,
                    },
                    success:function(data){
                        // chartExportNote.setData(data);
                        chartExportNote.setData(data);
                        // location.reload();
                    } 
                })
            });
        });
        $(document).ready(function(){
            $('.upload-coupon-vip').on('click',function(){
                var idCoupon = $('input[type="checkbox"]:checked');
                var arrayId = [];
                var token = $('input[name="_token"]').val();
                idCoupon.each(function(){
                    arrayId.push($(this).val());
                });
                if(arrayId == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'B???n ch??a ch???n m?? gi???m gi?? ????? c???p cho kh??ch h??ng!'
                    });
                }else{
                    $.ajax({
                        url: "{{route('coupon.uploadCustomerVip')}}",
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            arrayId:arrayId,
                            token:token,
                        },
                        success:function(data){
                            // console.log(data);
                            location.reload();
                        } 
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'C???p nh???t th??nh c??ng',
                        text: 'Y??u c???u c???a b???n ???? ???????c ch???p nh???n!'
                    })
                }
            });
            $('.upload-coupon-normal').on('click',function(){
                var idCoupon = $('input[type="checkbox"]:checked');
                var arrayId = [];
                var token = $('input[name="_token"]').val();
                idCoupon.each(function(){
                    arrayId.push($(this).val());
                });
                if(arrayId == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'L???i',
                        text: 'B???n ch??a ch???n m?? gi???m gi?? ????? c???p cho kh??ch h??ng!'
                    });
                }else{
                    $.ajax({
                        url: "{{route('coupon.uploadCustomerNormal')}}",
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            arrayId:arrayId,
                            token:token,
                        },
                        success:function(data){
                            // console.log(data);
                            location.reload();
                        } 
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'C???p nh???t th??nh c??ng',
                        text: 'Y??u c???u c???a b???n ???? ???????c ch???p nh???n!'
                    })
                }
            });
        });
        $(document).ready(function(){
            $('.insert-gallery').on('click',function(e){
                e.stopPropagation();
                $('.gallery').addClass('d-flex');
                $('.gallery').removeClass('d-none');
            });
            $('.gallery-close').on('click',function(e){
                $('.gallery').addClass('d-none');
                $('.gallery').removeClass('d-flex');
            })
            $('.update-gallery').change(function(){
                var token = $('input[name="_token"]').val();
                var idGallery = $(this).data('gallery');
                var image = $('#file-'+idGallery)[0].files[0];
                var formData = new FormData();

                formData.append('image_gallery',$('#file-'+idGallery)[0].files[0]);
                formData.append('id_gallery',idGallery);
                // for(var value of formData.keys()){
                //     console.log(value);
                // }
                $.ajax({
                    url: "{{route('product.updateThumbnails')}}",
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        // console.log(data);
                        location.reload();
                    } 
                });
                Swal.fire({
                    icon: 'success',
                    title: 'C???p nh???t th??nh c??ng',
                    text: 'Y??u c???u c???a b???n ???? ???????c ch???p nh???n!'
                });
            })
        });
        $(document).ready(function(){
            $('.create-color').click(function(){
                $('.color').addClass('d-flex');
                $('.color').removeClass('d-none');
            });
            $('.color-close').on('click',function(e){
                $('.color').addClass('d-none');
                $('.color').removeClass('d-flex');
            })
            $('.update-color').blur(function(){
                var idColor = $(this).data('color');
                var nameColor = $(this).text();
                if(nameColor == ''){
                    Swal.fire({
                        icon: 'error',
                        title: 'C?? v???n ?????',
                        text: 'B???n ch??a ch???n m??u s???c ????? thay ?????i!'
                    }) 
                }else{
                    $.ajax({
                        url: "{{route('color.updateColor')}}",
                        method: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            idColor:idColor,
                            nameColor:nameColor
                        },
                        success:function(data){
                            // console.log(data);
                            location.reload();
                        } 
                    })
                }
            });
            $('.open-contact').click(function(){
                $('.warehouse').addClass('d-flex');
                $('.warehouse').removeClass('d-none');
            });
        });
    </script>
</body>

</html>
