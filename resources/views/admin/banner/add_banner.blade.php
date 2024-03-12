@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Thương Slider
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
                        <form role="form" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slider</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1"  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh</label>
                                <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô Tả Thương Hiệu">
                                </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="slider_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-info">Thêm Slider</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection