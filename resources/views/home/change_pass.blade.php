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
					<h6 class="mb-0 pb-3"><span>Mật khẩu </span></h6>
					<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
					<div class="card-3d-wrap mx-auto" style="height: 550px !important;">
						<div class="card-3d-wrapper">
							<div class="card-front">
								<div class="center-wrap">
									<div class="section text-center">
										<h4 class="mb-4 pb-3">Đổi mật khẩu</h4>
										<form action="{{route('home.savePass',['email' => $email])}}" method="POST">
											@csrf	
											<div class="form-group">
												<input type="email" disabled value="{{$email}}" name="email_customer" class="form-style" placeholder="Email của bạn" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
                                            <div class="form-group">
												@error('email_customer')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
											</div>	
                                            <div class="form-group mt-2">
												<input type="password" name="password_customer" class="form-style" placeholder="Mật khẩu mới của bạn" id="pw" autocomplete="off">
												<i class="fa-solid fa-eye input-eye" id="eye" onclick="showPass()"></i>
												<i class="input-icon uil uil-lock-alt" ></i>
											</div>
                                            <div class="form-group">
												@error('password_customer')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
											</div>	
                                            <div class="form-group mt-2">
												<input type="password" name="password_customer_confirmation" class="form-style" placeholder="Nhập lại mật khẩu" id="pw1" autocomplete="off">
												<i class="fa-solid fa-eye input-eye" id="eye1" onclick="showPass1()"></i>
												<i class="input-icon uil uil-lock-alt" ></i>
											</div>
                                            <div class="form-group">
												@error('password_customer_confirmation')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
											</div>	
											<input class="btn-submit mt-4" type="submit" name="doimatkhau" value="Đổi mật khẩu">
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
<script type="text/javascript">
	function showPass(){
		let pass = document.getElementById('pw');
		let eyes = document.getElementById('eye');
		if(pass.type === 'password'){
			pass.type = 'text';
			eyes.classList.add('fa-eye-slash');
		}else{
			pass.type = 'password';
			eyes.classList.remove('fa-eye-slash');
			
		}
	}
	function showPass1(){
		let pass = document.getElementById('pw1');
		let eyes = document.getElementById('eye1');
		if(pass.type === 'password'){
			pass.type = 'text';
			eyes.classList.add('fa-eye-slash');
		}else{
			pass.type = 'password';
			eyes.classList.remove('fa-eye-slash');
			
		}
	}
	function showPass2(){
		let pass = document.getElementById('pw2');
		let eyes = document.getElementById('eye2');
		if(pass.type === 'password'){
			pass.type = 'text';
			eyes.classList.add('fa-eye-slash');
		}else{
			pass.type = 'password';
			eyes.classList.remove('fa-eye-slash');
			
		}
	}
</script>
</body>