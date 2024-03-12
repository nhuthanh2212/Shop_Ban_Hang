@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang Chủ</a></li>
				  <li class="active">Thanh Toán Giỏ Hàng</li>
				</ol>
			</div>

			

			<!-- <div class="register-req">
				<p></p>
			</div> --><!--/register-req-->

			
			<div class="review-payment">
				<h2>Xem Lại Giỏ Hàng</h2>
			</div>
			<div class="table-responsive cart_info">
				<?php
					$content = Cart::content();
					
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình Ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $key => $conte)
						<tr>
							<td class="cart_product">
								<a href=""><img width="100" src="{{URL::to('public/uploads/product/'.$conte->options->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$conte->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($conte->price).' '.'VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-qty')}}" method="post">
										{{ csrf_field() }}
										<input class="cart_quantity_input" type="text" name="quantity_cart" value="{{$conte->qty}}" size="2">
										<input type="hidden" value="{{$conte->rowId}}" name="rowId_cart" class="form-control">
										<input type="submit" value="Cập Nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php 
										$subtotal = $conte->price * $conte->qty;
										echo number_format($subtotal).' '.'VND';
									?>

								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$conte->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
			<h4 style="margin: 40px 0; font-size: 20px;">Chọn Hình Thức Thanh Toán</h4>
			<form method="post" action="{{URL::to('/order-place')}}">
				{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả Bằng Thẻ ATM</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox">Trả Tiền Mặt</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Paypal</label>
					</span>
					<input type="submit" value="Đặt Hàng" name="send_order_place" class="btn btn-primary btn-sm">
				</div>

			</form>
		</div>
	</section> <!--/#cart_items-->



@endsection