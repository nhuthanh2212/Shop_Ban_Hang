@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Thương Hiệu Sản Phẩm
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
                        <form role="form" action="{{URL::to('/update-brand/'.$edit->brand_id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Thương Hiện</label>
                                    <input type="text" value="{{$edit->brand_name}}" name="brand_name" class="form-control"id="slug" onkeyup="ChangeToSlug();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit->brand_slug}}" name="brand_slug" class="form-control" id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Từ Khóa</label>
                                    <input type="text" value="{{$edit->brand_keyword}}" name="brand_keyword" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa.....">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="brand_desc" id="exampleInputPassword1" >{{$edit->brand_desc}}
                                </textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                <select name="brand_status" class="form-control input-sm m-bot15">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Ẩn</option>
                                    
                                </select>
                            </div>
                            <button type="submit" name="add_brand" class="btn btn-info">Cập Nhật Thương Hiệu</button>
                        </form>
                    </div>
                   
                </div>
        </section>

    </div>
@endsection