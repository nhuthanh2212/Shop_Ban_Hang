@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                CẬP NHẬT DANH MỤC BÀI VIẾT
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
                        <form role="form" action="{{URL::to('/update-cate-post/'.$edit->cate_post_id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                <input type="text" name="cate_post_name" value="{{$edit->cate_post_name}}" class="form-control" id="slug" onkeyup="ChangeToSlug();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" value="{{$edit->cate_post_slug}}" name="cate_post_slug" class="form-control"id="convert_slug">
                            </div>
                            
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="cate_post_desc" id="exampleInputPassword1" placeholder="Mô Tả Danh Mục">{{$edit->cate_post_name}}
                                </textarea>
                            </div>
                          
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="cate_post_status" class="form-control input-sm m-bot15">
                                    @if($edit->cate_post_status == 1)
                                        <option selected value="1">Hiển Thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển Thị</option>
                                        <option selected value="0">Ẩn</option>
                                    @endif
                                    
                                </select>
                            </div>
                            <button type="submit" name="update_cate_post" class="btn btn-info">Cập Nhật Danh Mục Bài Viết</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection