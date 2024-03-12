@extends('layout')
@section('content')
@foreach($details_product as $key => $details)
<div class="product-details"><!--product-details-->
	<style type="text/css">
		.ISSlideOuter .ISPager.ISGallery img {
			display: block;
			height: 140px;
			max-width: 100%;
		}
		li.active {
			border: 2px solid #FE980F;
		}
		a.tags_style {
			
			
			height: auto;
			background: #438bca;
			color: #ffff;
			padding: 10px;
			border-radius: 30px;
		}
		a.tags_style:hover {
			background: black;
		}
		.fieldset {
			margin-top: 20px;
		}
	</style>
	<nav aria-label="breadcrumb">
	  	<ol class="breadcrumb" style="background: none;">
	    	<li class="breadcrumb-item"><a href="{{url('/trang-chu')}}">Trang Chủ</a></li>
	    	<li class="breadcrumb-item"><a href="{{URL::to('/danh-muc/'.$cate_slug)}}">{{$product_cate}}</a></li>
	    	<li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
	  	</ol>
	</nav>
	<div class="col-sm-6">
		<ul id="imageGallery">
			@foreach($gallery as $key => $gal)
  			<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
    			<img  width="100%" alt="{{$gal->gallery_name}}" src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
  			</li>
  			@endforeach
		</ul>
		<fieldset class="fieldset">
			<legend>Tags</legend>
			<p>
				<i class="fa fa-tag"></i>
				@php
					$tags = $details->product_tags;
					$tags = explode(",",$tags);
				@endphp
				@foreach($tags as $tag)
					<a href="{{url('/tag/'.Str::slug($tag))}}" class="tags_style">{{$tag}}</a>
				@endforeach
			</p>
		</fieldset>
	</div>
	<div class="col-sm-6">
		<div class="product-information"><!--/product-information-->
			<img src="{{asset('public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
				<h2>{{$details->product_name}}</h2>
				<p>Mã SP: {{$details->product_id}}</p>
				<img src="{{asset('public/frontend/images/rating.png')}}" alt="" />
				<form action="{{URL::to('/save-cart')}}" method="post">
									{{ csrf_field() }}
					<input type="hidden"  value="{{$details->product_id}}" class="cart_product_id_{{$details->product_id}}">

                    <input type="hidden"  value="{{$details->product_name}}" class="cart_product_name_{{$details->product_id}}">

                    <input type="hidden"  value="{{$details->product_image}}" class="cart_product_image_{{$details->product_id}}">

                    <input type="hidden"  value="{{$details->product_price}}" class="cart_product_price_{{$details->product_id}}">

                    <input type="hidden" value="{{$details->product_quantity}}" class="cart_product_quantity_{{$details->product_id}}">
                    <span>
						<span>{{number_format($details->product_price).'VND'}}</span>
						<label>Số Lượng: </label>
						<input name="qty" type="number" max="10" min="1"  value="1" class="cart_product_qty_{{$details->product_id}}" />
						<input name="productid_hidden" type="hidden" value="{{$details->product_id}}" />
					</span>
						<input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id="{{$details->product_id}}" name="add-to-cart">
				</form>
				<p><b>Tình Trạng:</b> Còn Hàng</p>
				<p><b>Điều Kiện:</b> Mới 100%</p>
				<p><b>Thương Hiệu:</b> {{$details->brand_name}}</p>
				<p><b>Danh Mục:</b> {{$details->category_name}}</p>
				<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							
				<!------chia se fb-->
				<div id="fb-root"></div>
    				<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=225161839945062&autoLogAppEvents=1" nonce="XXPgJqy1"></script>

					<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
								   
								    <!-- <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div> -->
							    
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">MÔ TẢ</a></li>
								<li><a href="#companyprofile" data-toggle="tab">CHI TIẾT SẢN PHẨM</a></li>
								
								<li><a href="#reviews" data-toggle="tab">ĐÁNH GIÁ</a></li>
								<li><a href="#binhluan" data-toggle="tab">BÌNH LUẬN</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$details->product_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$details->product_content!!}</p>
								
							</div>
							
							
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<style type="text/css">
										.style_comment {
											border: 1px solid #ddd;
											border-radius: 10px;
											background: #F0F0E9;

										}
									</style>
									<form>
										@csrf
										<input  type="hidden" class="comment_product_id" name="comment_product_id" value="{{$details->product_id}}">
										<div id="comment_show"></div>
										
									</form>

									<p><b>Viết Đánh Giá Của Bạn</b></p>

									<!-- đánh giá sao -->
									<ul class="list-inline rating" title="Average Rating">
										@for($count=1; $count<=5; $count++)
											
											@php
												if($count <= $rating){
													$color = 'color:#ffcc00;';
												}
												else
												{
													$color = 'color:#ccc;';
												}
											@endphp

										<li title="star_rating"
										id="{{$details->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$details->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size: 40px;" 
										>&#9733;
											
										</li>
										@endfor
									</ul>


									<form action="#">
										@csrf
										<span style="margin: 0px;">
											<input style="width: 100%;margin: 0px;" type="text" placeholder="Your Name" class="comment_name" />
											<!-- <input type="email" placeholder="Email Address"/> -->
										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội Dung Bình Luận........" >
											
										</textarea>
										<div id="notify_comment"></div>
										<b>Đánh Giá Sao: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right send-content-comment">
											GỬI BÌNH LUẬN
										</button>

									</form>
								</div>
							</div>

							<div class="tab-pane fade" id="binhluan" >
								<div id="fb-root"></div>
								<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0&appId=326735639835269&autoLogAppEvents=1" nonce="njj79CcA"></script>
								<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="50"></div>
							</div>
						</div>
					</div><!--/category-tab-->
@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">SẢN PHẨM LIÊN QUAN</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($related_product as $key => $rela)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
					                        <div class="productinfo text-center">
					                            <img src="{{URL::to('public/uploads/product/'.$rela->product_image)}}" alt="" />
					                                <h2>{{number_format($rela->product_price).' '.'VND'}}</h2>
					                                    <p>{{$rela->product_name}}</p>
					                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
					                        </div>
					                                        
					                    </div>
										</div>
									</div>
									@endforeach

								</div>
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection