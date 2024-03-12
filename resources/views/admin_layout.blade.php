
<!DOCTYPE html>
<head>
<title>Quản Lý Website Bán Hàng</title>
<link rel="shortcut icon" href="{{asset('public/frontend/images/logo.jpg')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="csrf-token" content="{{csrf_token()}}">

<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->

<!-- css date -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- biểu đồ-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<!-- <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script> -->
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        Quản Lý
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backend/images/2.png')}}">
                <span class="username">
                	<?php
						$name = Auth::user()->admin_name;
						if($name){
							echo $name;
						}
					?>

                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                @impersonate

                <li class="sub-menu">
                   
                        
                        <span><a href="{{URL::to('/impersonate-destroy')}}"><i class="fa fa-book"></i>Stop Chuyển User</a></span>
                                        
                </li>
                @endimpersonate

                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thông Tin Website</span>
                    </a>
                    <ul class="sub">
						
						<li><a href="{{URL::to('/information')}}">Thông Tin Website</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản Lý User</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-user')}}">Thêm User</a></li>
						<li><a href="{{URL::to('/users')}}">Liệt Kê User</a></li>
                        
                    </ul>
                </li>
                @endhasrole


                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản Lý Banner</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manade-banner')}}">Thêm Slider</a></li>
						<li><a href="{{URL::to('/list-banner')}}">Liệt Kê Slider</a></li>
                        
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục bài Viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-cate-post')}}">Thêm Danh Mục Bài viết</a></li>
						<li><a href="{{URL::to('/list-cate-post')}}">Liệt Kê Danh Mục Bài biết</a></li>
                        
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh Mục Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category')}}">Thêm Danh Mục</a></li>
						<li><a href="{{URL::to('/list-category')}}">Liệt Kê Danh Mục</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương Hiệu Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand')}}">Thêm Thương Hiệu</a></li>
						<li><a href="{{URL::to('/list-brand')}}">Liệt Kê Thương Hiệu</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a></li>
						<li><a href="{{URL::to('/list-product')}}">Liệt Kê Sản Phẩm</a></li>
                        
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn Hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
						
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã Giảm Giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-coupon')}}">Quản Lý Mã</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Liệt Kê Mã</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận Chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản Lý Vận Chuyển</a></li>
						<!-- <li><a href="{{URL::to('/list-coupon')}}">Liệt Kê Mã</a></li> -->
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài Viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-post')}}">Thêm Bài Viết</a></li>
						<li><a href="{{URL::to('/list-post')}}">Liệt Kê Bài Viết</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản Lý Bình Luận</span>
                    </a>
                    <ul class="sub">
						
						<li><a href="{{URL::to('/list-comment')}}">Liệt Kê Bình Luận</a></li>
                        
                    </ul>
                </li>

            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2023 Coppyright. All rights reserved | <a href="https://www.facebook.com/profile.php?id=100010917880317">Nhu Thanh</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>

<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- date -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!---biểu đồ-->
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
		
	let table = new DataTable('#myTable');
</script>

<script type="text/javascript">
	CKEDITOR.replace('ckeditor');
	CKEDITOR.replace('ckeditor1');
	CKEDITOR.replace('ckeditor2');
	CKEDITOR.replace('ckeditor4');
	CKEDITOR.replace('ckeditor3');
</script>

<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> -->

<script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	prevText:"Tháng Trước",
    	nextText:"Tháng Sau",
    	dateFormat:"yy-mm-dd",
    	dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
    	duration:"slow"
    });
    $( "#datepicker2" ).datepicker({
    	prevText:"Tháng Trước",
    	nextText:"Tháng Sau",
    	dateFormat:"yy-mm-dd",
    	dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
    	duration:"slow"
    });
  } );
  </script>

<!-- sắp xếp -->
<script type="text/javascript">
        $('.category_order').sortable({
            
            update: function(event, ui) {
                var page_id_array = [];
                $('.category_order tr').each(function() {
                    page_id_array.push($(this).attr('id'));
                });
                // alert(array_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{url('/array-category')}}",
                    
                    method: "POST",
                    data: {
                        page_id_array: page_id_array
                    },
                    success: function(data) {
                        alert('Sắp Xếp Thứ Tự Thành Công');
                    }
                });
            }

        });
    </script>

    <!-- loc -->
    <script type="text/javascript">
    	$(document).ready(function(){
    		chart30daysorder();
    		var chart = new Morris.Bar({
    			element: 'myfirstchart',
    			lineColors:['#819c79','#fc8710','#FF6541','#A4ADD3','#766B56'],
    			pointFillColors: ['#ffffff'],
    			pointStrokeColors: ['black'],
    			fillOpacity: 0.6,
    			hideHover: 'auto',
    			parseTime: false,
    			xkey: 'period',
    			ykeys: ['order', 'sales', 'profit','quantity'],
    			behaveLikeLine: true,
    			labels: ['Đơn hàng','Doanh Số','Lợi Nhuận','Số Lương']
    		});

    		function chart30daysorder(){
    			var _token = $('input[name="_token"]').val();
    			$.ajax({
    				url: "{{url('/days-order')}}",
    				method: "POST",
    				dataType: "JSON",
    				data: {_token:_token},
    				success:function(data){
    					chart.setData(data);
    				}
    			});
    		}

    		$('.dashboard-filter').change(function(){
    			var dashboard_value = $(this).val();
    			var _token = $('input[name="_token"]').val();
    			$.ajax({
    				url: "{{url('/dashboard-filter')}}",
    				method:"POST",
    				dataType:"JSON",
    				data:{dashboard_value:dashboard_value, _token:_token },
    				success:function(data){
    					chart.setData(data);
    				}
    			});

    		});

    		$('#btn-dashboard-filter').click(function(){
    			var _token = $('input[name="_token"]').val();
    			var from_date = $('#datepicker').val();
    			var to_date = $('#datepicker2').val();
    			$.ajax({
    				url: "{{url('/filter-by-date')}}",
    				method:"POST",
    				dataType:"JSON",
    				data:{from_date:from_date, to_date:to_date, to_date:to_date, _token:_token },
    				success:function(data){
    					chart.setData(data);
    				}
    			});
    		});
    	});
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        var donut = Morris.Donut({
          element: 'donut',
          resize: true,
          colors: [
            '#ce616a',
            '#61a1ce',
            '#ce8f61',
            '#f5b942',
            '#4842f5'
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"San Pham", value: <?php echo $products ?>},
            {label:"Bai Viet", value:<?php echo $posts ?>},
            {label:"Don Hang", value:<?php echo $orders ?>},
            {label:"Khach Hang", value:<?php echo $customers ?>}
            ]
        });
});
</script>

<script type="text/javascript">
	$('.comment_duyet_btn').click(function(){
		var comment_status = $(this).data('comment_status');
		var comment_id = $(this).data('comment_id');

		var comment_product_id = $(this).attr('id');
		if(comment_status==1){
			var alert = 'Duyệt Thành Công';
		}else{
			var alert = 'Duyệt Không Thành Công';
		}
		$.ajax({
				url: "{{url('/duyet-comment')}}",
				method: "POST",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {comment_status:comment_status, comment_id: comment_id, comment_product_id: comment_product_id},
				success:function(data) {
					location.reload();
					$('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');

				}
		});


	});
	$('.btn-reply-comment').click(function(){
		var comment_id = $(this).data('comment_id');
		var comment = $('.reply_comment_'+comment_id).val();
		

		var comment_product_id = $(this).data('product_id');

		$.ajax({
				url: "{{url('/reply-comment')}}",
				method: "POST",
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {comment:comment, comment_id: comment_id, comment_product_id: comment_product_id},
				success:function(data) {
					$('.reply_comment_'+comment_id).val('');
					$('#notify_comment').html('<span class="text text-alert">Trả Lời Bình Luận Thành Công</span>');

				}
		});
	});
</script>

<script type="text/javascript">
	$.validate({


	});
</script>
	

<script type="text/javascript">
    
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
 </script>


<script type="text/javascript">
	$('.update_quantity').click(function() {
		var order_product_id = $(this).data('product_id');
		var order_qty = $('.order_qty_'+order_product_id).val();
		var order_code = $('.order_code').val();
		var _token = $('input[name="_token"]').val();
		$.ajax({
				url: '{{url("/update-qty")}}',
				method: 'POST',
				data: {_token:_token, order_product_id: order_product_id, order_qty: order_qty, order_code: order_code},
				success:function(data){
					alert('Cập Nhật Số Lượng Thành Công');
					location.reload();
				}
			});

	});

</script>
<script type="text/javascript">
	$('.update_order').change(function(){
		var order_status = $(this).val();
		var order_id = $(this).children(":selected").attr("id");
		var _token = $('input[name="_token"]').val();
		quantity = [];
		$("input[name='product_sales_quantity']").each(function(){
			quantity.push($(this).val());
		});
		order_product_id = [];
		$("input[name='order_product_id']").each(function(){
			order_product_id.push($(this).val());
		});
		s = 0;
		for(i = 0; i < order_product_id.length; i++){
			//so luong khach
			var order_qty = $('.order_qty_'+order_product_id[i]).val();
			//spluong ton kho
			var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
			if(parseInt(order_qty) > parseInt(order_qty_storage)){
				s = s  + 1;
				if(i == 1){
					alert('Số Lượng Sản Phẩm Shop Không Đủ')
				}
				$('.color_qty_'+order_product_id[i]).css('background','red');
			}
		}

		if(s==0){
			$.ajax({
				url: '{{url("/update-order-qty")}}',
				method: 'POST',
				data: {_token:_token, order_status: order_status, order_id: order_id, quantity: quantity, order_product_id:order_product_id},
				success:function(data){
					alert('Thay Đổi Tình Trạng Đơn Hàng Thành Công');
					location.reload();
				}
			});

		}
		
		
	});
</script>




<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
	
</body>
</html>
