@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Mã Giảm Giá
    </div>
    
    <div class="table-responsive">
        <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message',null);
                }
                    ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            
            <th>Tên Mã Giảm Giá</th>
            <th>Mã Giảm</th>
            <th>Số Lượng Mã Giảm Giá</th>
            <th>Điều Kiện Giảm Giá</th>
            
            <th>Giảm</th>
           
            <th>Quản Lý</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach($coupon as $key => $cou )
          <tr>
            
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_qty}}</td>
            
            
            
            <td><span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                 Giảm Theo %   
                <?php 
                }
                else{
                ?>
                  Giảm Theo Tiền
                <?php
                  }
                
                ?>
                

            </span></td>
            <td><span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                 Giảm {{$cou->coupon_number}} % 
                <?php 
                }
                else{
                ?>
                  Giảm {{number_format($cou->coupon_number,0,',','.')}}đ
                <?php
                  }
                
                ?>
                

            </span></td>
            <td>
               
                 <a onclick="return confirm('Bạn Có Muốn Xóa Mã Này Không?')" href="{{URL::to('delete-coupon/'.$cou->coupon_id)}}" class=" active styling-edit">
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