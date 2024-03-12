@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                THÊM DANH MỤC BÀI VIẾT
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
                        <form role="form" action="{{URL::to('/save-cate-post')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="cate_post_name" class="form-control" id="slug" onkeyup="ChangeToSlug(); "  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="cate_post_slug" class="form-control"id="convert_slug">
                            </div>
                            
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="cate_post_desc" id="exampleInputPassword1" placeholder="Mô Tả Danh Mục">
                                </textarea>
                            </div>
                          
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="cate_post_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_cate_post" class="btn btn-info">Thêm Danh Mục Bài Viết</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection