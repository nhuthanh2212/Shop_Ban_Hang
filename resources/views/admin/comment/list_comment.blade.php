@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Bình Luận
    </div>
    <div id="notify_comment"></div>
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
           
            <th>Tên Người Bình Luận</th>
            <th>Nội Dung</th>
            <th>Sản Phẩm</th>
            <th>Thời Gian</th>
            <th>Trạng Thái</th>
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($comment as $key => $comm )
            
          <tr>
           
            <td>{{$comm->comment_name}}</td>
            <td>{{$comm->comment}}
                <style type="text/css">
                    ul.list_rep li {
                        list-style-type: decimal;
                        color: blue;
                        margin: 5px 40px;
                    }
                </style>
                <ul class="list_rep">
                    @foreach($comment_rep as $key => $comm_reply)
                        @if($comm_reply->comment_parent_comment == $comm->comment_id)
                            Trả Lời:<li> {{$comm_reply->comment}}</li>
                        @endif
                    @endforeach
                </ul>
                @if($comm->comment_status==1)

                    <br/><textarea rows="5" style="resize:none;" class="form-control reply_comment_{{$comm->comment_id}}"></textarea>
                    <br/><button type="button" class="btn btn-success btn-xs btn-reply-comment" data-product_id="{{$comm->product_id}}" data-comment_id="{{$comm->comment_id}}">Trả Lời</button>

                @endif
                

            </td>
            <td>

                <a href="{{url('/chi-tiet/'.$comm->product->product_slug)}}" target="_blank">{{$comm->product->product_name}}
                </a>
            </td>
            <td>{{$comm->comment_date}}</td>
            <td>
                @if($comm->comment_status==0)
                    <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" id="{{$comm->product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt Bình Luận" name="">
                @else
                    <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" id="{{$comm->product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Hủy Bình Luận" name="">
                @endif

            </td>
            
            <td>
                <a href="{{URL::to('edit-comm/'.$comm->comm_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Bình Luận Này Không?')" href="{{URL::to('delete-comm/'.$comm->comm_id)}}" class=" active styling-edit">
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