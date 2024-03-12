<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!------------seo------------>
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX, FOLLOW">
    <link rel="canonical" href="{{$url_canonical}}">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="">
    <!-------endseo--------->
    <!------search facebook----->
    <meta property="og:image" content="{{$image_og}}">
    <meta property="og:site_name" content="{{$url_canonical}}">
    <meta property="og:description" content="{{$meta_desc}}">
    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:url" content="{{$url_canonical}}">
    <meta property="og:type" content="website">
    <!-------end facebook----->


    <title>{{$meta_title}}</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">


    <link href="{{asset('css/sweetalert1.css')}}" rel="stylesheet">
    
    <link href="{{asset('css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettify.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/logo.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 889 227 802</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> shopdientu@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{url('/trang-chu')}}"><img style="width: 100px; height: 100px" src="{{asset('public/frontend/images/logo.jpg')}}" alt="" /></a>
                        </div>
                        <!-- <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                                <li><a href="#"><i class="fa fa-star"></i> Yêu Thích</a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id!=NULL && $shipping_id==NULL){
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                                    
                                <?php
                                }elseif($customer_id != NULL && $shipping_id != NULL){
                                ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                                    
                                <?php
                                }else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh Toán</a></li>
                                <?php
                                }
                                 ?>

                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>


                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng Xuất</a></li>
                                    
                                <?php
                                }else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng Nhập</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($cate as $key => $danhmuc)
                                        <li><a href="{{URL::to('/danh-muc/'.$danhmuc->category_slug)}}">{{$danhmuc->category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($cate_post as $key => $danhmucbaiviet)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ Hàng</a></li>
                                <li><a href="{{URL::to('/lien-he')}}">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('tim-kiem')}}" method="post">
                            {{ csrf_field() }}
                            <div class="search_box ">
                                <div class="col-sm-9">
                                    <input name="keywords_submit" id="keywords" type="text" />
                                    <div id="search_ajax">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                <input type="submit" style="margin-top:0;color:#666; width: 100%; border-radius: 50px;" name="search_items" class=" btn btn-primary btn-sm" value="Tìm kiếm">
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <?php
                                $i = 0;
                            ?>
                            @foreach($slider as $key => $slide)
                            <?php 
                                $i++;
                            ?>
                            <div class="item {{$i == 1? 'active' : ''}}">
                               
                                <div class="col-sm-12">
                                   <img width="100%" alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" class="img img-responsive" height="200" width="100%">
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh Mục Sản Phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                           
                            
                            @foreach($cate as $key => $catego)
                            <div class="panel panel-default">
                                @if($catego->category_parent==0)
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$catego->category_slug}}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>{{$catego->category_name}}</a>
                                    </h4>
                                </div>
                                <div id="{{$catego->category_slug}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($cate as $key => $cate_sub)
                                                @if($cate_sub->category_parent == $catego->category_id)
                                            <li><a href="{{URL::to('/danh-muc/'.$cate_sub->category_slug)}}">{{$cate_sub->category_name}} </a></li>
                                                @endif
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                                 @endif
                            </div>

                            @endforeach
                        </div>
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương Hiệu Sản Phẩm</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                     @foreach($brand as $key => $bra)
                                    <li><a href="{{URL::to('/thuong-hieu/'.$bra->brand_slug)}}"> <span class="pull-right">(50)</span>{{$bra->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        <div class="brands_products"><!--yeu thich localstorage_products-->
                            <h2>SẢN PHẨM YÊU THÍCH</h2>
                            <div class="brands-name">

                                <div id="row_wishlist">
                                    
                                </div>
                            </div>
                        </div><!--/localstorage_products-->


                        <!--price-range-->
                        <!-- <div class="price-range">
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div> -->
                        <!--/price-range-->
                        <!--shipping-->
                        <!-- <div class="shipping text-center">
                            <img src="images/home/shipping.jpg" alt="" />
                        </div> --><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <!-- <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> -->
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

     <script src="{{asset('js/sweetalert1.min.js')}}"></script>

    <script src="{{asset('js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('js/lightslider.js')}}"></script>
    <script src="{{asset('js/prettify.js')}}"></script>
     
     <!----Chat fb----->
     <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "129999410198081");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v18.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
          });
    </script>



    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change',function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    <!-- yeu thích sản phẩm dựa trên localstoragen -->
    <script type="text/javascript">
        function view(){
            if(localStorage.getItem('data')!= null){
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '400px';

                for(i = 0; i < data.length; i++){

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_wishlist').append('<div class="row" style="margin: 10px 0; border: 1px solid #F7F7F5;"><div class="col-md-5" ><img src="'+image+'" width="100%"></div><div class="col-md-7 info_wishlist " ><p>'+name+'</p><p style="color:#FE980F">'+price+'</p><a href="'+url+'">Chi Tiết</a></div></div>');
                }
            }
        }
        view();
        function add_wishlist(clicked_id){
            var id = clicked_id;
        
            var name = document.getElementById('wishlist_productname'+id).value;
            var price = document.getElementById('wishlist_productprice'+id).value;
            const VND = new Intl.NumberFormat('vi-VN', {
              style: 'currency',
              currency: 'VND',
            });

            price = VND.format(price);
            var image = document.getElementById('wishlist_productimage'+id).src;
            var url = document.getElementById('wishlist_producturl'+id).href;
          
            var newItem = {
                'url':url,
                'id':id,
                'name':name,
                'price':price,
                'image':image
            }
            var old_data = JSON.parse(localStorage.getItem('data'));
            if(localStorage.getItem('data')==null){
                localStorage.setItem('data','[]');
            }
            var matches = $.grep(old_data, function(obj){
                return obj.id == id;
            });
            if(matches.length){
                alert('Sản Phẩm Bạn Đã Yêu Thích, Nên Không Thể Thêm');
            }else{
                old_data.push(newItem);

                $('#row_wishlist').append('<div class="row" style="margin: 10px 0; border: 1px solid #F7F7F5;"><div class="col-md-5" ><img src="'+newItem.image+'" width="100%"></div><div class="col-md-7 info_wishlist " ><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+'</p><a href="'+newItem.url+'">Chi Tiết</a></div></div>');
                alert('Sản Phẩm Bạn Đã Yêu Thích Thành Công');
            }
            localStorage.setItem('data',JSON.stringify(old_data));
        }

    </script>


    <!-- tabs-cate -->
    <script type="text/javascript">

        $(document).ready(function(){

            var cate_id = $('.tab_pro').data('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: "{{url('/product-tabs')}}",
                    method: "POST",
                    data: {cate_id:cate_id, _token:_token},
                    success:function(data) {
                        
                        $('#tabs_product').html(data);
                    }
                });
            $('.tab_pro').click(function(){
                var cate_id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                        url: "{{url('/product-tabs')}}",
                        method: "POST",
                        data: {cate_id:cate_id, _token:_token},
                        success:function(data) {
                            
                            $('#tabs_product').html(data);
                        }
                    });
            });

        });
    </script>

    <script type="text/javascript">
        function remove_background(product_id){
            for(var count = 1; count <= 5; count++){
                $('#'+product_id+'-'+count).css('color','#ccc');
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter','.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');

            remove_background(product_id);
            for(var count = 1; count <= index; count++){
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        });
        //nhỏ chuột không đánh giá sao
        $(document).on('mouseleave','.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");

            remove_background(product_id);
            for(var count = 1; count <= rating; count++){
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        });
        //click đánh giá sao
        $(document).on('click','.rating',function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                    url: "{{url('/insert-rating')}}",
                    method: "POST",
                    data: {index: index, product_id: product_id, _token:_token},
                    success:function(data) {
                        
                        if(data == 'done'){
                            alert("Bạn Đã Đánh Giá "+index+" Trên 5 Sao");
                        }else{
                            alert("Lỗi Đánh Giá");
                        }
                    }
                });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            load_comment();
            function load_comment(){
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/load-comment')}}",
                    method: "POST",
                    data: {product_id:product_id, _token:_token},
                    success:function(data) {
                        
                        $('#comment_show').html(data);
                    }
                });

            }
            $('.send-content-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/send-comment')}}",
                    method: "POST",
                    data: {product_id:product_id, comment_name: comment_name, comment_content: comment_content,  _token:_token},
                    success:function(data) {
                        
                       
                       $('#notify_comment').html('<span class="text text-success">Thêm Bình Luận Đang Chờ Duyệt</span>');
                       load_comment();
                       $('#notify_comment').fadeOut(5000);
                       $('.comment_name').val('');
                       $('.comment_content').val('');
                    }
                });

            });
        });
    </script>

    <script type="text/javascript">
        $('.xemnhanh').click(function() {
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/quickview')}}",
                method: "POST",
                dataType: "JSON",
                data: {product_id:product_id, _token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_value);
                    $('#product_quickview_button').html(data.product_button);

                    
                }
            });

        });
    </script>

    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();
            if(query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/tim-kiem-ajax')}}",
                    method: "POST",
                    data: {query:query, _token:_token},
                    success:function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            }
            else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click','li',function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
        $('.send_order').click(function(){
            swal({
                    title: "Xác Nhận Đơn Hàng",
                    text: "Đơn Hàng Sẽ Được Gửi Đến Bạn Cách Sớm Nhất",
                    type: "warning",
                    showCancelButton: true,
                    
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Đặt Hàng",
                    cancelButtonText: "Thoát",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
            function(isConfirm) {
                if(isConfirm){
                        var shipping_email = $('.shipping_email' ).val();
                        var shipping_name = $('.shipping_name' ).val();
                        var shipping_address = $('.shipping_address' ).val();
                        var shipping_phone = $('.shipping_phone' ).val();
                        var shipping_notes = $('.shipping_notes' ).val();
                        var shipping_method = $('.payment_select' ).val();
                        var order_feeship = $('.order_feeship').val();
                        var order_coupon = $('.order_coupon'  ).val();


                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '{{url("/confirm-order")}}',
                            method: 'POST',
                            data:{shipping_email: shipping_email, shipping_name: shipping_name, shipping_address: shipping_address, shipping_phone: shipping_phone, shipping_notes: shipping_notes, order_feeship: order_feeship, order_coupon: order_coupon, shipping_method: shipping_method, _token: _token},
                            success:function(){
                                swal("Đơn Hàng", "Dơn Hàng Đã Được Xác Nhận Thành Công", "success");
                                }               
                        });
                        window.setTimeout(function(){
                            location.reload();
                        } , 3000);
                    }else{
                        swal("Đóng", "Hẹn Gặp Bạn Sớm Nhất Và Có Những Sản Phẩm Ưng Ý Nhất, Chúng Tôi Ở Đây Là Vì Bạn", "error");
                    }
                    
            });
            
           
        });
    });
    </script>


     <script type="text/javascript">
         $(document).ready(function(){
                $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var matp = $(this).val();
                var _token = $('input[name="_token"]').val();
                var $result = '';
                if (action == 'city'){
                    $result = 'province';
                } else {
                    $result = 'wards';
                }
                $.ajax({
                    url: '{{url("/select-delivery-home")}}',
                    method: 'post',
                    data: { action: action, matp: matp, _token: _token },
                    success: function(data){
                        $('#'+$result).html(data);
                    }
                });
            });
                $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh == '' && xaid == ''){
                    alert('Vui Lòng Chọn Địa Điểm Để Tính Phí Vận Chuyển');
                } else {
                    $.ajax({
                        url: '{{url("/calculate-fee")}}',
                        method: 'post',
                        data: { matp: matp, maqh: maqh, xaid: xaid, _token: _token },
                        success: function(){
                            location.reload();
                        }
                    });
                }
            });
        });
     </script>
     
    <script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            
            var _token = $('input[name="_token"]').val();
            // alert(cart_product_quantity);
            // alert(cart_product_qty);

            if(parseInt(cart_product_qty)>parseInt(cart_product_quantity))
            {
                    alert('Quý Khách Thông Cảm Vì Lượng Sản Phẩm Tại Shop Còn: ' + cart_product_quantity + ' Sản Phẩm Nên Mong Quý Khách Thông Cảm');
            }else{
            $.ajax({
                url: '{{url("/add-cart-ajax")}}',
                method: 'POST',
                data:{cart_product_id: cart_product_id, cart_product_name: cart_product_name, cart_product_image: cart_product_image, cart_product_price: cart_product_price, cart_product_qty: cart_product_qty, _token: _token, cart_product_quantity: cart_product_quantity},
                success:function(data){
                     // swal("Here's a message!")
                    swal({
                        title: "Đã Thểm Sản Phẩm Vào Giỏ Hàng",
                        text: "Bạn Có Thể Mua Hàng Tiếp Hoặc Tới Giỏ Hàng Để Tiến Hảnh Thanh Toán",
                        showCancelButton: true,
                        cancelButtonText: "Xem Tiếp",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Đi Đến Giỏ Hàng",
                        closeOnConfirm: false
                    },
                    function() {
                        window.location.href = "{{url('/gio-hang')}}";
                    });
                   
                    }               
                });
           }
        });
    });
</script>
<!-- //thêm giỏ hàng trong modal xem nhanh -->
 <script type="text/javascript">

        $(document).on('click','.add-to-cart-quickview',function(){
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            
            var _token = $('input[name="_token"]').val();
            // alert(cart_product_quantity);
            // alert(cart_product_qty);

            if(parseInt(cart_product_qty)>parseInt(cart_product_quantity))
            {
                    alert('Quý Khách Thông Cảm Vì Lượng Sản Phẩm Tại Shop Còn: ' + cart_product_quantity + ' Sản Phẩm Nên Mong Quý Khách Thông Cảm');
            }else{
            $.ajax({
                url: '{{url("/add-cart-ajax")}}',
                method: 'POST',
                data:{cart_product_id: cart_product_id, cart_product_name: cart_product_name, cart_product_image: cart_product_image, cart_product_price: cart_product_price, cart_product_qty: cart_product_qty, _token: _token, cart_product_quantity: cart_product_quantity},
                beforeSend: function(){
                    $("#beforeSend_quickview").html("<p class='text text-primary' >Đang Thêm Sản Phẩm Vào Giỏ Hàng</p>");
                },
                success:function(data){
                   $("#beforeSend_quickview").html("<p class='text text-success' >Đã Thêm Sản Phẩm Vào Giỏ Hàng</p>");  
                   
                    }               
                });
           }
        });
        $(document).on('click','.redirect-cart',function(){
            window.location.href = "{{url('/gio-hang')}}";
        });
  
</script>


</body>
</html>
