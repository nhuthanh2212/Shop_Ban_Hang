@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Đơn Hàng
    </div>
   
    <div class="table-responsive">
        <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message',null);
                }
                    ?>
      <form action="{{URL::to('/loc-order')}}" method="GET">
        <div class="col-sm-3">           
          <select class="form-select" aria-label="Default select example" name="orders" style="width: 100%; margin: 10px 0px; height: 35px;">
            <option selected>---------Đơn Hàng----------</option>
            <option value="1">Đơn Hàng Chưa Xử Lý</option>
            <option value="2">Đơn Hàng Đã Xử Lý</option>
            <option value="3">Đơn Hàng Bị Hủy</option>
          </select>
        </div>
        <div class="col-sm-1"> 
          <input type="submit" class="btn  btn-success btn-filter"  value="LỌC ĐƠN HÀNG" style="margin: 10px 0px;">
        </div>
      </form>


      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            
            <th>STT</th>
            <th>Mã Đơn Hàng</th>
            <th>Thời Gian Dặt Hàng</th>
            <th>Tình Trạng Đơn Hàng</th>
            <th>Quản Lý</th>
           
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 0;
          ?>
            @foreach($order as $key => $ord )
            <?php $i++; ?>
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
              @if($ord->order_status==1)
                Đơn Hàng Mới
              @elseif($ord->order_status==2)
                Đơn Hàng Đã Xử Lý
              @else
                Đơn Hàng Bị Hủy
              @endif
            </td>
           
            
            <td>
                <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-eye text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Thương Hiệu Này Không?')" href="{{URL::to('delete-order/'.$ord->order_code)}}" class=" active styling-edit">
                    <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
    
@endsection