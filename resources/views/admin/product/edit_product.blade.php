@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Sản Phẩm
            </header>

                <div class="panel-body">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>' ;
                            Session::put('message',null);
                        }
                    ?>
                    <div class="position-center">
                        @foreach($edit as $key => $edit_pro)
                        <form role="form" action="{{URL::to('/update-product/'.$edit_pro->product_id)}}" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" value="{{$edit_pro->product_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" value="{{$edit_pro->product_slug}}" class="form-control" id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="product_desc" id="ckeditor1" >{!! $edit_pro->product_desc !!}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="product_content" id="ckeditor2" >{!! $edit_pro->product_content !!}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tags</label>
                                    <input type="text" name="product_tags" class="form-control" data-role="tagsinput" value="{{$edit_pro->product_tags}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                <input type="text" name="price_cost" class="form-control" id="exampleInputEmail1" value="{{$edit_pro->price_cost}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Bán Sản Phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$edit_pro->product_price}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số Lượng</label>
                                <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" data-validation="number" data-validation-error-msg="Vui Lòng Điền số lượng Sản Phẩm" value="{{$edit_pro->product_quantity}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                <img src="{{URL::to('public/uploads/product/'.$edit_pro->product_image)}}" height="100" width="100">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($cate as $key => $cate)
                                        @if($cate->category_id == $edit_pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif                                            
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu Sản Phẩm</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    <<option>------Chọn------</option>
                                    @foreach($brand as $key => $bra)
                                        @if($bra->brand_id == $edit_pro->brand_id)
                                        <option selected value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                                        @else
                                        <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-info">Cập Nhật Sản Phẩm</button>
                        </form>
                        @endforeach
                    </div>

                </div>
        </section>

    </div>
@endsection