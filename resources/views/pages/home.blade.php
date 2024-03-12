@extends('layout')
@section('content')
<div class="category-tab"><!--category-tab--->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <?php 

                                    $i = 0;
                                ?>
                                @foreach($cate_tabs as $key => $cate_tab)
                                <?php 
                                    $i++;
                                ?>
                                <li data-id="{{$cate_tab->category_id}}" id="{{$i==1 ? 'tab_id' : ''}}" class="{{$i==1? 'active' : ''}} tab_pro">
                                    <a href="#{{$cate_tab->category_slug}}" data-toggle="tab">{{$cate_tab->category_name}}
                                    </a>
                                </li>
                               @endforeach
                               
                            </ul>
                        </div>
                        
                        <div id="tabs_product"></div>

                       
                    </div><!--/category-tab-->
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">SẢN PHẨM MỚI NHẤT</h2>
                        @foreach($list_product as $key => $list_pro)
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
                                                <h2>{{number_format($list_pro->product_price,0,',','.').' '.'VND'}}</h2>
                                                <p>{{$list_pro->product_name}}</p>
                                                
                                                    </a>
                                                    <style type="text/css">
                                                        .xemnhanh {
                                                            background: #F5F5ED;
                                                            border: 0 none;
                                                            border-radius: 0;
                                                            color: #696763;
                                                            font-family: 'Roboto', sans-serif;
                                                            font-size: 15px;
                                                            margin-bottom: 25px;

                                                        }
                                                    </style>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input type="button" value="Thêm Giỏ Hàng" class="btn btn-default btn-sm add-to-cart" data-id="{{$list_pro->product_id}}" name="add-to-cart">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="button" value="Xem Nhanh" class="btn btn-default btn-sm xemnhanh" data-id_product="{{$list_pro->product_id}}" name="xem-nhanh" data-toggle="modal" data-target="#xemnhanh" >
                                                        </div>
                                                    </div>
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
                        @endforeach
                </div><!--features_items-->
                <!-- Modal -->
                <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title product_quickview_title" id="">
                            <span id="product_quickview_title"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-5">
                                <!-- <span id="product_quickview_image"></span> -->
                                <span id="product_quickview_gallery"></span>

                            </div>
                            <form>
                                @csrf
                                <div id="product_quickview_value"></div>
                            <div class="col-md-7">
                                <style type="text/css">
                                    h5.modal-title.product_quickview_title {
                                        text-align: center;
                                        font-size: 25px;
                                        color: brown;
                                    }
                                    p.quickview {
                                        font-size: 14px;
                                        color: brown;
                                    }
                                    span#product_quickview_content img {
                                        width: 100%;
                                    }
                                    @media screen and (min-width: 768px){
                                        .modal-dialog {
                                            width: 700px;
                                        }
                                        .modal-sm {
                                            width: 350px;
                                        }

                                    }
                                    @media screen and (min-width: 992px){
                                        .modal-lg {
                                            width: 1200px;
                                        }
                                    }
                                </style>
                                <h2 class="quickview"><span id="product_quickview_title"></span></h2>
                                <p>Mã ID: <span id="product_quickview_id"></span></p>
                                <span>
                                    <h2 style="color: brown; font-size: 20px; font-weight: bold;">Giá Sản Phẩm: <span id="product_quickview_price"></span></h2><br>
                                    <label>Số Lượng</label>
                                    <input type="number" name="qty" min="1" class="cart_product_qty_" value="1">
                                    <input type="hidden" name="productid_hidden" value="">
                                </span><br>
                                <h4 style="color: brown; font-size: 20px; font-weight: bold;">Mô Tả Sản Phẩm: </h4>
                                <fieldset>
                                    <span style="width: 100%;" id="product_quickview_desc"></span>
                                    <span style="width: 100%;" id="product_quickview_content"></span>

                                </fieldset>
                                <div id="product_quickview_button" style="margin-bottom: 20px;"></div>
                                <div id="beforeSend_quickview"></div>
                            </div>
                            </form>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ĐÓNG</button>
                        <button type="button" class="btn btn-primary redirect-cart">GIỎ HÀNG</button>
                      </div>
                    </div>
                  </div>
                </div>
               <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!!$list_product->links()!!}
                      </ul>
@endsection