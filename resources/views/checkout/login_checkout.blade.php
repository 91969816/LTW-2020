@extends('home')
@section('content')
<!-- <section id="form">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>Đăng nhập tài khoản</h2>
						<form action="#">
							<input type="text" name = "email_account" placeholder="Tài Khoản" />
							<input type="password" name = "password_account" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ Đăng Nhập
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div>
				</div>
				<div class="col-sm-1">
					<h2 class="or">hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Đăng Ký Mới</h2>
						<form action="{{URL::to('/add_customer')}}" method = "POST">
							{{csrf_field() }}
							<input type="text" name ="customer_name" placeholder="Họ tên"/>
							<input type="email" name ="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name ="customer_password" placeholder="Mật khẩu"/>
							<input type="text" name ="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section> -->
@endsection