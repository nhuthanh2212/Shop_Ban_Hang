@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Thương Hiệu Sản Phẩm
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
                        <form role="form" action="{{URL::to('/save-brand')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương Hiện</label>
                                    <input type="text" name="brand_name" class="form-control" id="slug" onkeyup="ChangeToSlug();"  placeholder="Tên Thương Hiệu Sản Phẩm" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="brand_slug" class="form-control" id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Từ Khóa</label>
                                    <input type="text" name="brand_keyword" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa....."  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="brand_desc" id="exampleInputPassword1" placeholder="Mô Tả Thương Hiệu">
                                </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="brand_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_brand" class="btn btn-info">Thêm Thương Hiệu</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection