@extends('layout')
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  	<li><a href="{{URL::to('/trang-chu')}}">Trang Chủ</a></li>
			  	<li class="active">Giỏ Hàng Của Bạn</li>
			</ol>
		</div>
		@if(session()->has('message'))
			<div class="alert alert-success">
				{!! session()->get('message') !!}
			</div>
		@elseif(session()->has('error'))
			<div class="alert alert-danger">
				{!! session()->get('error') !!}
			</div>
		@endif
			<div class="table-responsive cart_info">
				
				<table class="table table-condensed">
					<form action="{{URL::to('/update-cart')}}" method="post">
						{{ csrf_field() }}
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình Ảnh</td>
							<td class="name">Tên Sản Phẩm</td>
							
							<td class="price">Giá Sản Phẩm</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Thành Tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
							@php
								$total = 0;
							@endphp
							@foreach(Session::get('cart') as $key => $cart)

								@php
									$subtotal = $cart['product_price']*$cart['product_qty'];
									$total += $subtotal;
								@endphp
								<tr>
									<td class="cart_product">
										<a href=""><img width="100" src="{{asset('public/uploads/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}"></a>
									</td>
									<td class="cart_description">
										<h4><a href=""></a></h4>
										<p>{{$cart['product_name']}}</p>
									</td>
									<td class="cart_price">
										<p>{{number_format($cart['product_price'],0,',','.')}}<sup>đ</sup></p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<input class="cart_quantity" type="number" min="1" max="10" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">
											{{number_format($subtotal,0,',','.')}}<sup>đ</sup>
										</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="{{url('/deleted-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							@endforeach
								<!-- <tr>
									<td>
										<div class="total_area">
											<ul>
												<li>
													Tiền: <span>{{number_format($total,0,',','.')}}<sup>đ</sup></span>
												</li>
												@if(Session::get('coupon'))
											
												    @foreach(Session::get('coupon') as $key => $cou)
												        @if($cou['coupon_condition']==1)
												        	<p>
												        		<li>
												        			Mã Giảm: <span>{{$cou['coupon_number']}} %</span>
												        		</li>
												        	</p>
												            
												            <p>
												                @php
												                    $total_coupon = ($total*$cou['coupon_number'])/100;
												                    echo '<p><li>Giảm: <span>'.number_format($total_coupon,0,',','.').'<sup>đ</sup></span></li></p>';
												                @endphp
												            </p>
												            <p>
												            	<li>
												                	Thanh Toán: <span>{{number_format($total-$total_coupon,0,',','.')}}<sup>đ</sup></span>
												                </li>
												            </p>
												        @elseif($cou['coupon_condition']==2)
												        	<p>
												        		<li>
												        			Mã Giảm: <span>{{number_format($cou['coupon_number'],0,',','.')}}<sup>đ</sup></span>
												        		</li>
												        	</p>
												            
												            <p>
												            	
												                @php
												                    $total_coupon = $total - $cou['coupon_number'];
												                @endphp
												            	
												            </p>
												            <p>
												            	<li>
												                	Thanh Toán: <span>{{number_format($total_coupon,0,',','.')}}<sup>đ</sup></span>
												                </li>
												            </p>
												        @endif
												    @endforeach
												
												@endif

												
												 <li>Thuế <span></span></li>
												<li>Phí Vận Chuyển <span>Free</span></li>
												<li>Tổng Tiền<span></span></li> 
											</ul>
										</div>
									</td>
								</tr> -->
							<tr>
								<td><input type="submit" value="CẬP NHẬT GIỎ HÀNG" name="update_qty" class="btn btn-default btn-sm check_out"></td>
								<td>
									<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product')}}">XÓA TẤT CẢ</a>
								</td>
								<!-- <td>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">THANH TOÁN</a>
								</td> -->
								<td>
									@if(Session::get('customer_id'))
										<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">ĐẶT HÀNG</a>
									@else
										<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">ĐẶT HÀNG</a>
									@endif
								</td>
							</tr>
						@else
							<tr >
								<td colspan="5"><center>
							@php
								echo 'Giỏ Hàng Trống';
							@endphp
									</center>
								</td>
							</tr>
						@endif
					</tbody>
				</form>
				<!-- <tr>
					@if(Session::get('cart'))
					<td >

						<form method="post" action="{{url('/check-coupon')}}">
							@csrf
							<input type="text" class="form-control" placeholder="Nhập Mã Giảm Giá" name="coupon"><br>
							<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính Mã Giảm Giá">
							@if(Session::get('coupon'))
							<a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa Mã</a>
							@endif
						</form>
					</td>
					@endif
				</tr> -->
				</table>
				
				
			</div>
		</div>
	</section> <!--/#cart_items-->
	
@endsection