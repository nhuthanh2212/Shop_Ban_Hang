@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê Sản Phẩm
    </div>
   <!--  <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
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
            <th>Tên Sản Phẩm</th>
            <th>Đường Dẫn</th>
            <th>Mô Tả Sản Phẩm</th>
            <th>Nội Dung Sản Phẩm</th>
            <th>Giá Sản Phẩm</th>
            <th>Giá Bán Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Hình Ảnh Sản Phẩm</th>
            <th>Thư Viện Ảnh</th>
            <th>Danh Mục Sản Phẩm</th>
            <th>Thương Hiệu Sản Phẩm</th>
            <th>Trạng Thái</th>
           
            <th>Quản Lý</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($list as $key => $product )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$product->product_name}}</td>
            <td>{{$product->product_slug}}</td>
            <td><span class="text-ellipsis">
                @if($product->product_desc!=NULL)
                  @if(strlen($product->product_desc)>150)
                    @php
                      $product_desc = substr($product->product_desc,0,100);
                      echo $product_desc.'......'
                    @endphp
                   
                  @endif
                @else
                  Chưa có Mô Tả
                @endif
            </span></td>
            <td><span class="text-ellipsis">
              @if($product->product_content!=NULL)
                  @if(strlen($product->product_content)>150)
                    @php
                      $product_content = substr($product->product_content,0,100);
                      echo $product_content.'......'
                    @endphp
                    
                  @endif
                @else
                  Chưa có Nội Dung
                @endif


            </span></td>
            <td>{{number_format($product->price_cost,0,',','.')}}đ</td>
            <td>{{number_format($product->product_price,0,',','.')}}đ</td>
             <td>{{$product->product_quantity}}</td>
            <td><img src="public/uploads/product/{{$product->product_image}}" height="100" width="100"></td>
            <td>
              <a href="{{url('/add-gallery/'.$product->product_id)}}" class="btn btn-sm btn-danger">THÊM ẢNH</a>
            </td>
            <td>{{$product->category_name}}</td>
            <td>{{$product->brand_name}}</td>
            
           
            <td><span class="text-ellipsis">
                <?php 
                if($product->product_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php 
                }
                else{
                ?>
                    <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                    <?php
                }
                
                ?>
                

            </span></td>
            <td>
                <a href="{{URL::to('edit-product/'.$product->product_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square text-success text-active"></i>
                </a>
                 <a onclick="return confirm('Bạn Có Muốn Xóa Sản Phẩm Này Không?')" href="{{URL::to('delete-product/'.$product->product_id)}}" class=" active styling-edit">
                    <i class="fa fa-times text-danger text"></i>
                </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer> -->
  </div>
</div>
    
@endsection