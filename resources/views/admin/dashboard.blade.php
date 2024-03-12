@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
	<style type="text/css">
		p.title_thongke {
			text-align: center;
			font-size: 20px;
			font-weight: bold;
			margin: 10px;
		}
	</style>
	<div class="row">
		<p class="title_thongke">THỐNG KÊ ĐƠN HÀNG DOANH SỐ</p>
		<form autocomplete="off">
			@csrf
			<div class="col-md-3">
				<p>Từ Ngày: <input type="text" id="datepicker" class="form-control" name=""> </p>
				<input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc Kết Quả">

			</div>
			<div class="col-md-3">
				<p>Đến Ngày: <input type="text" id="datepicker2" class="form-control" name=""> </p>
			</div>
			<div class="col-md-3">
				<p>
					Lọc Theo: 
					<select class="dashboard-filter form-control">
						<option>------Chọn-----</option>
						<option value="7ngay">Tuần Trước</option>
						<option value="thangtruoc">Tháng Trước</option>
						<option value="thangnay">Tháng Này</option>
						<option value="365ngayqua">Năm</option>

					</select>
				</p>
			</div>
		</form>
		<div class="col-md-12">
			<div id="myfirstchart" style="height: 250px;"></div>
		</div>
	</div>
	<div class="row">
		<style type="text/css">
			table.table.table-bordered.table-dark{
				background: #32383e;
			}
			table.table.table-bordered.table-dark tr th{
				color: #fff;
			}
		</style>
		<p class="title_thongke">THỐNG KÊ TRUY CẬP</p>
		<table class="table table-bordered table-dark">
			<thead>
				<tr>
					<th scope="col">Đang Online</th>
					<th scope="col">Tổng Tháng Trước</th>

					<th scope="col">Tổng Tháng Này</th>
					<th scope="col">Tổng 1 Năm</th>
					<th scope="col">Tổng Truy Cập</th>

				</tr>
			</thead>
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-md-4 col-xs-12">
			<p class="title_thongke">THỐNG KÊ</p>
			<div id="donut"  ></div>
		</div>

		<div class="col-md-4 col-xs-12">
			<h3 class="title_thongke">BÀI VIẾT XEM NHIỀU NHẤT</h3>
			<ul class="list_view">
				@foreach($post_views as $key => $posts)
				<li>
					<a target="_blank" href="{{url('/bai-viet/'.$posts->post_slug)}}">{{$posts->post_name}} | <span style="color:black;">{{$posts->post_view}}</span></a>
				</li>
				@endforeach
			</ul>
		</div>

		<div class="col-md-4 col-xs-12">
			<style type="text/css">
				ul.list_view{
					margin: 10px 0;
					color: #fff;
				}
				ul.list_view a {
					color: orange;
					font-weight: 400;
				}
			</style>
			<h3 class="title_thongke">SẢN PHẨM XEM NHIỀU NHẤT</h3>
			<ul class="list_view">
				@foreach($product_view as $key => $products)
				<li>
					<a target="_blank" href="{{url('/chi-tiet/'.$products->product_slug)}}">{{$products->product_name}} | <span style="color:black;">{{$products->product_view}}</span></a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection