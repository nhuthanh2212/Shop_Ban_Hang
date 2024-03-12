@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Tags {{$tag}}</h2>
                        @foreach($pro_tags as $key => $tags)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                            @csrf
                            <input type="hidden"  value="{{$tags->product_id}}" class="cart_product_id_{{$tags->product_id}}">
                            <input type="hidden" id="wishlist_productname{{$tags->product_id}}" value="{{$tags->product_name}}" class="cart_product_name_{{$tags->product_id}}">
                            <input type="hidden"  value="{{$tags->product_image}}" class="cart_product_image_{{$tags->product_id}}">
                            <input type="hidden" id="wishlist_productprice{{$tags->product_id}}" value="{{$tags->product_price}}" class="cart_product_price_{{$tags->product_id}}">
                            <input type="hidden"  value="1" class="cart_product_qty_{{$tags->product_id}}">
                            <input type="hidden" value="{{$tags->product_quantity}}" class="cart_product_quantity_{{$tags->product_id}}">
                            <a id="wishlist_producturl{{$tags->product_id}}" href="{{URL::to('/chi-tiet/'.$tags->product_slug)}}">
                                <img id="wishlist_productimage{{$tags->product_id}}" src="{{URL::to('public/uploads/product/'.$tags->product_image)}}" alt="" />
                                <h2>{{number_format($tags->product_price).' '.'VND'}}</h2>
                                <p>{{$tags->product_name}}</p>
                                        
                            </a>
                            <button type="button" class="btn btn-default add-to-cart" data-id="{{$tags->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</button>
                            </form>
                                        </div>
                                        
                                </div>
                                <div class="choose">
                                    <style type="text/css">
                                        ul.nav.nav-pills.nav-justified li {
                                            text-align: center;
                                            font-size: 13px;
                                        }
                                        .button_wishlist{
                                            border: none;
                                            background: #ffff;
                                            color: #B3AFA8;

                                        }
                                        ul.nav.nav-pills.nav-justified i {
                                            color: #B3AFA8;
                                        }
                                        .button_wishlist span:hover{
                                            color: #FE980F;

                                        }
                                        .button_wishlist:focus {
                                            border: none;
                                            outline: none;
                                        }
                                    </style>
                                    <ul class="nav nav-pills nav-justified">
                                        <li><i class="fa fa-plus-square"></i>
                                            <button class="button_wishlist" id="{{$tags->product_id}}" onclick="add_wishlist(this.id);"><span>YÊU THÍCH</span></button>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div><!--features_items-->
               
@endsection