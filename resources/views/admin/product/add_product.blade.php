@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" placeholder="Tên Sản Phẩm" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô Tả Sản Phẩm">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="product_content" id="ckeditor2" placeholder="Nội Dung Sản Phẩm">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tags</label>
                                    <input type="text" name="product_tags" class="form-control" data-role="tagsinput">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                <input type="text" name="price_cost" class="form-control" id="exampleInputEmail1" placeholder="Giá Sản Phẩm" data-validation="number" data-validation-error-msg="Vui Lòng Điền Giá Tiền">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Bán Sản Phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá Bán Sản Phẩm" data-validation="number" data-validation-error-msg="Vui Lòng Điền Giá Tiền">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số Lượng</label>
                                <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Số Lượng Sản Phẩm" data-validation="number" data-validation-error-msg="Vui Lòng Điền Số Lượng Sản Phẩm">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Sản Phẩm</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($cate as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thương Hiệu Sản Phẩm</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    <<option>------Chọn------</option>
                                    @foreach($brand as $key => $bra)
                                    <option value="{{$bra->brand_id}}">{{$bra->brand_name}}</option>
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
                            <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection