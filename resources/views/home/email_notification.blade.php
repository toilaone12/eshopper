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
					<h6 class="mb-0 pb-3"><span>Xác thực thông tin </span></h6>
					<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
					<div class="card-3d-wrap mx-auto">
						<div class="card-3d-wrapper">
							<div class="card-front">
								<div class="center-wrap">
									<div class="section text-center">
										<form action="" method="post">
											<div class="form-group">
												Email đã được chấp thuận, hãy vào email để đổi mật khẩu!
											</div>	
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