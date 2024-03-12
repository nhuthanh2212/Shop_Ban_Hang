@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Danh Mục Sản Phẩm
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
                        <form role="form" action="{{URL::to('/save-category')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="category_name" class="form-control" id="slug" onkeyup="ChangeToSlug();" value="" placeholder="Tên Danh Mục Sản Phẩm" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="category_slug" class="form-control" id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Từ Khóa</label>
                                    <input type="text" name="category_keyword" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa....." placeholder="Từ Khóa" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="category_desc" id="exampleInputPassword1" placeholder="Mô Tả Danh Mục"  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc Danh Mục</label>
                                <select name="category_parent" class="form-control input-sm m-bot15">
                                    <option value="0">--------Danh Mục Cha------</option>
                                    @foreach($category as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="category_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-info">Thêm Danh Mục</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection