<!doctype html>
<html lang="en">
<head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="{{asset('frontend/css/style_login.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="{{asset('backend/fonts/fontawesome-free-6.1.1-web/css/all.css')}}" rel="stylesheet">

</head>
<body class="body">
<?php
	use Illuminate\Support\Facades\Session;
?>
<a href="https://front.codes/" class="logo" target="_blank">
	<img src="{{asset('frontend/img/eshopper.png')}}" alt="">
</a>
<div class="section">
	<div class="container">
		<div class="row full-height justify-content-center">
			<div class="col-12 text-center align-self-center py-5">
				<div class="section pb-5 pt-5 pt-sm-2 text-center">
					<h6 class="mb-0 pb-3"><span>Tìm tài khoản của bạn </span></h6>
					<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
					<div class="card-3d-wrap mx-auto">
						<div class="card-3d-wrapper">
							<div class="card-front">
								<div class="center-wrap">
									<div class="section text-center">
										<h4 class="mb-4 pb-3" style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI';">Vui lòng nhập email để tìm kiếm tài khoản của bạn</h4>
										<form action="{{route('home.sendEmail')}}" method="post">
											@csrf	
                                            <div class="form-group">
												<?php
													$message_email = Session::get('message');
												?>
                                                @if(isset($message))
                                                    <span class="text-danger">{{$message_email}}</span>
                                                @endif
                                                @error('email_customer')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
											</div>
											<div class="form-group">
												<input type="email" name="email_customer" class="form-style" placeholder="Email của bạn" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group">
												Lưu ý: 
												<span>Hãy vào gmail để kích hoạt xác minh 2 bước!</span>
											</div>
											<input class="btn-submit mt-4" type="submit" name="quenmatkhau" value="Tìm kiếm">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>