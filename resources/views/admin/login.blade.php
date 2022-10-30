<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('backend/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link href="{{asset('backend/fonts/fontawesome-free-6.1.1-web/css/all.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/main.css')}}">
	
<!--===============================================================================================-->
</head>
<body>
	<?php
		use Illuminate\Support\Facades\Cookie;
	?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('backend/img/hanoi.jpg')}});">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{route('admin.saveLogin')}}" method="POST" autocomplete="TRUE">
                    @csrf
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Đăng nhập
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" value="@if(Cookie::get('username')) {{Cookie::get('username')}} @endif"  placeholder="Nhập tài khoản">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" id="password" value="@if(Cookie::get('password')) {{Cookie::get('password')}} @endif"  name="pass" placeholder="Nhập mật khẩu">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
						<i class="fa-solid fa-eye input-eye" id="open-eyes"></i>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" @if(Cookie::has('remember')) {{'checked'}} @else {{'a'}} @endif id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Lưu mật khẩu
						</label>
					</div>
					<div class="contact100-form-checkbox">
						<label class="text-danger" for="ckb1">
							@foreach($errors->get('pass') as $message)
								{{$message}}
							@endforeach
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('backend/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('backend/js/main.js')}}"></script>
	<script>
		document.getElementById('open-eyes').addEventListener('click',function(){
			let pass = document.getElementById('password');
			let eyes = document.getElementById('open-eyes');
			if(pass.type == 'password'){
				pass.type = 'text';
				eyes.classList.add('fa-eye-slash');
			}else{
				pass.type = 'password';
				eyes.classList.remove('fa-eye-slash');
			}
		});
	</script>

</body>
</html>