@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Bài Viết
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
            <th>Tên Bài Viết</th>
            <th>Slug</th>
            <th>Hình Ảnh Bài Viết</th>
            <th>Mô Tả Bài Viết</th>
            
            <th>Danh Mục Bài Viết</th>
            <th>Từ Khóa</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $post )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$post->post_name}}</td>
            <td>{{$post->post_slug}}</td>
            <td><img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">{!!$post->post_desc!!}</span></td>
            
            <td>
              @foreach($cate_post as $key => $postt)
                @if($postt->cate_post_id == $post->cate_post_id)
                  {{$postt->cate_post_name}}
                @endif
              @endforeach
            </td>
            
            <td>{{$post->post_meta_keyword}}</td>
            
            
           
            <td>@if($post->post_status == 1)
                Hiển Thị
              @else
                Không Hiển Thị
              @endif
            
            </td>
            <td>
                <a href="{{URL::to('edit-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Bài Viết Này Không?')" href="{{URL::to('delete-post/'.$post->post_id)}}" class=" active styling-edit">
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