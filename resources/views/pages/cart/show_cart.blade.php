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
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{number_format(Cart::subtotal()).' '.'VND'}}</span></li>
							<li>Thuế <span>{{number_format(Cart::tax()).' '.'VND'}}</span></li>
							<li>Phí Vận Chuyển <span>Free</span></li>
							<li>Thành Tiền <span>{{number_format(Cart::total()).' '.'VND'}}</span></li>
						</ul>
							<!-- <a class="btn btn-default update" href="">Update</a> -->
							<?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                    
                                    <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh Toán</a>
                                <?php
                                }else{
                                ?>
                                    
                                    <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
                                <?php
                                }
                                ?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection