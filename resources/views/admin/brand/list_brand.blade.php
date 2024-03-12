@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Thương Hiệu
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
            <th>Tên Thương Hiệu</th>
            <th>Slug</th>
            <th>Mô Tả Thương Hiệu</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $brand )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$brand->brand_name}}</td>
            <td>{{$brand->brand_slug}}</td>
            <td><span class="text-ellipsis">{{$brand->brand_desc}}</span></td>
           
            <td><span class="text-ellipsis">
                <?php 
                if($brand->brand_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-brand/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php 
                }
                else{
                ?>
                    <a href="{{URL::to('/active-brand/'.$brand->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                }
                
                ?>
                

            </span></td>
            <td>
                <a href="{{URL::to('edit-brand/'.$brand->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Thương Hiệu Này Không?')" href="{{URL::to('delete-brand/'.$brand->brand_id)}}" class=" active styling-edit">
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