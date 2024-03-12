@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Banner
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Slider</th>
            <th>Hình Ảnh</th>
            <th>Mô Tả</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($list_slider as $key => $slider )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$slider->slider_name}}</td>
            <td><img src="public/uploads/slider/{{$slider->slider_image}}" height="100" width="200"></td>
            <td><span class="text-ellipsis">{{$slider->slider_desc}}</span></td>
           
            <td><span class="text-ellipsis">
                <?php 
                if($slider->slider_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-slider/'.$slider->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php 
                }
                else{
                ?>
                    <a href="{{URL::to('/active-slider/'.$slider->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                }
                
                ?>
                

            </span></td>
            <td>
                
                 <a onclick="return confirm('Bạn Có Muốn Xóa Slider Này Không?')" href="{{URL::to('delete-slider/'.$slider->slider_id)}}" class=" active styling-edit">
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