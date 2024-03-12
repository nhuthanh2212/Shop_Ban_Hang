@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Danh Mục Bài Viết
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
            <th>Tên Danh Mục Bài Viết</th>
            <th>Đường Dẫn Bài Viết</th>
            <th>Mô Tả Bài Viết</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
           
          </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $cate_post )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cate_post->cate_post_name}}</td>
            <td>{{$cate_post->cate_post_slug}}</td>
            <td><span class="text-ellipsis">{{$cate_post->cate_post_desc}}</span></td>
           
            <td>
              @if($cate_post->cate_post_status == 1)
                Hiển Thị
              @else
                Khổng Hiển Thị
              @endif
            </td>
            <td>
                <a href="{{URL::to('edit-cate-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Danh Mục Bài Viết Này Không?')" href="{{URL::to('delete-cate-post/'.$cate_post->cate_post_id)}}" class=" active styling-edit">
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