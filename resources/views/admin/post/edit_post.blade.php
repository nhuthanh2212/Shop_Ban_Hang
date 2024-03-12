@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Bài Viết
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
                        <form role="form" action="{{URL::to('/update-post/'.$edit->post_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Bài Viết</label>
                                    <input type="text" name="post_name" value="{{$edit->post_name}}" class="form-control"  id="slug" onkeyup="ChangeToSlug();" placeholder="Tên Thương Hiện">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Đường Dẫn</label>
                                    <input type="text" name="post_slug" value="{{$edit->post_slug}}" class="form-control" id="convert_slug" placeholder="Từ Khóa.....">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="post_desc" id="ckeditor3" placeholder="Mô Tả Thương Hiệu">{{$edit->post_desc}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Nội Dung</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="post_content" id="ckeditor4" placeholder="Mô Tả Thương Hiệu">
                                    {{$edit->post_content}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"> MeTa Từ Khóa</label>
                                <input type="text" name="post_meta_keyword" value="{{$edit->post_meta_keyword}}" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa.....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meta Nội Dung</label>
                                <input type="text" name="post_meta_desc" value="{{$edit->post_meta_desc}}" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa.....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh Bài Viết</label>
                                <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                                <img src="{{asset('public/uploads/post/'.$edit->post_image)}}" height="100" width="100">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh Mục Bài Viết</label>
                                <select name="cate_post_id" class="form-control input-sm m-bot15">
                                    <option >------Chọn------</option>
                                    @foreach($cate_post as $key => $cate)
                                        @if($cate->cate_post_id == $edit->cate_post_id)
                                            <option selected value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                        @else
                                            <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endif                                            
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Trạng Thái</label>
                                <select name="post_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="update_post" class="btn btn-info">Cập Nhật Bài Viết</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection