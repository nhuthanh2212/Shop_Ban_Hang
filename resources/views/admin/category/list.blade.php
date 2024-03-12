@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Danh Mục
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
            <th>Tên Danh Mục</th>
            <th>Thuộc Danh Mục</th>
            <th>Mô Tả Danh Mục</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <style type="text/css">
          #category_order .ul-state-highlight {
            padding: 24px;
            background-color: #ffffcc;
            border: 1px solid #ccc;
            cursor: move;
            margin-top: 12px;
          }
        </style>
        <tbody class="category_order">
            @foreach($list as $key => $cate )
          <tr id="{{$cate->category_id}}">
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cate->category_name}}</td>
            <td>
              @if($cate->category_parent==0)
                <span style="color: red;">Danh Mục Cha</span>
              @else
                @foreach($category_product as $key1 => $cate_sub)
                  @if($cate_sub->category_id == $cate->category_parent)
                    <span style="color: green;">{{$cate_sub->category_name}}</span>
                  @endif
                @endforeach
              @endif

            </td>
            <td><span class="text-ellipsis">{{$cate->category_desc}}</span></td>
           
            <td><span class="text-ellipsis">
                <?php 
                if($cate->category_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-category/'.$cate->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php 
                }
                else{
                ?>
                    <a href="{{URL::to('/active-category/'.$cate->category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                }
                
                ?>
                

            </span></td>
            <td>
                <a href="{{URL::to('edit-category/'.$cate->category_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Danh Mục Này Không?')" href="{{URL::to('delete-category/'.$cate->category_id)}}" class=" active styling-edit">
                    <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- import data -->
      <!-- <form action="{{url('/import-csv')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx"><br>
        <input type="submit" name="import_csv" value="Import Excel" class="btn btn-warning">
        
      </form> -->

      <!-----export------>
      <!-- <form action="{{url('/export-csv')}}" method="post">
        @csrf
        
        <input type="submit" name="export_csv" value="Export Excel" class="btn btn-success">
        
      </form> -->
    </div>
    
  </div>
</div>
    
@endsection