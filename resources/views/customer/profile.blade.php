@extends('home')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
?>
<body>
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
                            <a class="btn btn-info " target="__blank" href="{{route('customer.formEditProfile',['idCustomer' => $customer->id_customer])}}">Sửa thông tin</a>
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