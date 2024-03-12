@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng Nhập Tài Khoản</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
							{{ csrf_field() }}
							<input name="email_account" type="email" placeholder="Email...."  data-validation="email" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự"/>
							<input name="password_account" type="password" placeholder="Password...." />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi Nhớ Tài Khoản
							</span>
							<button type="submit" class="btn btn-default">Đăng Nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng Ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
							{{ csrf_field() }}
							<input name="customer_name" type="text" placeholder="Tên Người Dùng....." data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự"/>
							<input name="customer_phone" type="text" placeholder="Số Điện Thoại...." data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự"/>
							<input name="customer_email" type="email" placeholder="Địa Chỉ Email....." data-validation="email" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự"/>
							<input name="customer_password" type="password" placeholder="Password....."data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Password"/>
							<button type="submit" class="btn btn-default">Đăng Ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection