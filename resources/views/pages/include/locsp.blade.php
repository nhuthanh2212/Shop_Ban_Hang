@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    
    @foreach($category_name as $key => $cate_name)
        <h2 class="title text-center">DANH MỤC {{$cate_name->category_name}}</h2>
    @endforeach
    <div class="row">
        @include('pages.include.loc')
        
    </div>
    @foreach($category_by_id as $key => $list_pro)
        <a href="{{URL::to('/chi-tiet/'.$list_pro->product_slug)}}">
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <form>
                                 @csrf
                                <input type="hidden"  value="{{$list_pro->product_id}}" class="cart_product_id_{{$list_pro->product_id}}">
                                <input type="hidden" id="wishlist_productname{{$list_pro->product_id}}" value="{{$list_pro->product_name}}" class="cart_product_name_{{$list_pro->product_id}}">
                                <input type="hidden"  value="{{$list_pro->product_image}}" class="cart_product_image_{{$list_pro->product_id}}">
                                <input type="hidden" id="wishlist_productprice{{$list_pro->product_id}}" value="{{$list_pro->product_price}}" class="cart_product_price_{{$list_pro->product_id}}">
                                <input type="hidden"  value="1" class="cart_product_qty_{{$list_pro->product_id}}">
                                <input type="hidden" value="{{$list_pro->product_quantity}}" class="cart_product_quantity_{{$list_pro->product_id}}">
                                <a id="wishlist_producturl{{$list_pro->product_id}}" href="{{URL::to('/chi-tiet/'.$list_pro->product_slug)}}">
                                    <img id="wishlist_productimage{{$list_pro->product_id}}" src="{{URL::to('public/uploads/product/'.$list_pro->product_image)}}" alt="" />
                                    <h2>{{number_format($list_pro->product_price).' '.'VND'}}</h2>
                                    <p>{{$list_pro->product_name}}</p>
                                </a>
                                <button type="button" class="btn btn-default add-to-cart" data-id="{{$list_pro->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</button>
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
                                <button class="button_wishlist" id="{{$list_pro->product_id}}" onclick="add_wishlist(this.id);"><span>YÊU THÍCH</span></button>
                            </li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div><!--features_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$category_by_id->links()!!}
</ul>
<!-- <div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="50"></div> -->
               
@endsection