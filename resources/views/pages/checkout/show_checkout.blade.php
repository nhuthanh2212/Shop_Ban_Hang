@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Trang Chủ</a></li>
				  <li class="active">Thanh Toán Giỏ Hàng</li>
				</ol>
			</div>

			

			<!-- <div class="register-req">
				<p></p>
			</div> --><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Thông Tin Gửi Hàng</p>
							<div class="form-one">
								<form method="post">
									@csrf
									<input name="shipping_email" class="shipping_email" type="text" placeholder="Email.....">
									<input name="shipping_name" class="shipping_name" type="text" placeholder="Tên.....">
									<input name="shipping_address" class="shipping_address" type="text" placeholder="Địa Chỉ.....">
									<input name="shipping_phone" class="shipping_phone" type="text" placeholder="Phone.....">
									<textarea name="shipping_notes" class="shipping_notes"  placeholder="Ghi Chú Đơn hàng" rows="5"></textarea>
									
									@if(Session::get('fee'))
										<input name="order_feeship" class="order_feeship" type="hidden" value="{{SeSsion::get('fee')}}" >
									@else
										<input name="order_feeship" class="order_feeship" type="hidden" value="100000" >
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
										<input name="order_coupon" class="order_coupon" type="hidden" value="{{$cou['coupon_code']}}" >
										@endforeach
									@else
										<input name="order_coupon" class="order_coupon" type="hidden" value="no" >
									@endif
									
									

									<div class="">
										<div class="form-group">
		                                	<label for="exampleInputPassword1">Chọn Hình Thức Thanh Toán</label>
		                                	<select name="payment_select"  class="form-control input-sm m-bot15 payment_select ">
		                                    
		                                    	<option value="0">-----Chọn Hình Thức Thanh Toán-----</option>
		                                    	<option value="1">Thanh Toán Thẻ ATM</option>
		                                    	<option value="2">Thanh Toán Tiền Mặt</option>
		                                    	<option value="3">Thanh Toán Ví Điện Tử</option>
		                                    	
		                                    
		                                	</select>
		                            	</div>
									</div>
									<input type="button" value="XÁC NHẬN ĐƠN" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
								 <form>
		                            @csrf
		                                            
		                            <div class="form-group">
		                                <label for="exampleInputPassword1">Chọn Thành Phố</label>
		                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
		                                    
		                                    <option value="0">-----Chọn Tỉnh Thành Phố-----</option>
		                                    @foreach($city as $key => $ci)
		                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
		                                    @endforeach
		                                    
		                                </select>
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputPassword1">Chọn Quận-Huyện</label>
		                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
		                                    
		                                    <option value="0">-----Chọn Quận Huyện------</option>
		                                    
		                                </select>
		                            </div>
		                            <div class="form-group">
		                                <label for="exampleInputPassword1">Chọn Xã-Phường-Thị Trấn</label>
		                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
		                                    
		                                    <option value="0">-----Chọn Xã Phường-----</option>
		                                    
		                                </select>
		                            </div>
		                           
		                           
		                            <input type="button" value="TÍNH PHÍ VẬN CHUYỂN" name="calculate_order" class=" btn btn-primary btn-sm calculate_delivery">
		                        </form>

							</div>
							
						</div>
					</div>
							
				</div>
			</div>
			<div class="review-payment">
				<h2>GIỎ HÀNG CỦA BẠN</h2>
			</div>
			@if(session()->has('message'))
								<div class="alert alert-success">
									{{ session()->get('message') }}
								</div>
							@elseif(session()->has('error'))
								<div class="alert alert-danger">
									{{ session()->get('error') }}
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
												<tr>
													<td>
														<div class="total_area">
															<ul>
																<li>
																	Tiền: <span>{{number_format($total,0,',','.')}}<sup>đ</sup></span>
																</li>
																@if(Session::get('fee'))
																<li>
																	<a class="cart_quantity_delete" href="{{url('/delete-fee')}}"><i class="fa fa-times"></i></a>
																	Phí Vận Chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}<sup>đ</sup></span>
																	<?php
																		$total_after_fee = $total + Session::get('fee');
																	?>
																</li>
																@endif
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
																                    
																                @endphp
																            </p>
																            <p>
																            	@php
																            		$total_after_coupon = $total - $total_coupon;
																            	@endphp
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
																            	@php
																            		$total_after_coupon = $total_coupon;
																            	@endphp
																            </p>
																        @endif
																    @endforeach
																
																@endif
																<li>Thanh Toán: <span>
																@php
																	if(Session::get('fee') && !Session::get('coupon') ){

																		$total_after = $total_after_fee;
																		echo number_format($total_after,0,',','.').'<sup>đ</sup>';
																	}elseif(!Session::get('fee') && Session::get('coupon') ){

																		$total_after = $total_after_coupon;
																		echo number_format($total_after,0,',','.').'<sup>đ</sup>';

																	}elseif(Session::get('fee') && Session::get('coupon') ){

																		$total_after1 = $total_after_coupon;
																		$total_after = $total_after1 + Session::get('fee');
																		echo number_format($total_after,0,',','.').'<sup>đ</sup>';

																	}elseif(!Session::get('fee') && !Session::get('coupon') ){

																		$total_after = $total;
																		echo number_format($total_after,0,',','.').'<sup>đ</sup>';
																	}
																@endphp
																	</span>
																</li>
																
															</ul>
														</div>
													</td>
												</tr>
											<tr>
												<td><input type="submit" value="CẬP NHẬT GIỎ HÀNG" name="update_qty" class="btn btn-default btn-sm check_out"></td>
												<td>
													<a class="btn btn-default check_out" href="{{URL::to('/delete-all-product')}}">XÓA TẤT CẢ</a>
												</td>
												<td>
													<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">THANH TOÁN</a>
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
								<tr>
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
								</tr>
								</table>
								
								
							</div>
			<!-- <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div> -->
		</div>
	</section> <!--/#cart_items-->



@endsection