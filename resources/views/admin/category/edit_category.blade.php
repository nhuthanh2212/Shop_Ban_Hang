@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Danh Mục Sản Phẩm
            </header>

                <div class="panel-body">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>' ;
                            Session::put('message',null);
                        }
                    ?>
                    @foreach($edit as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-category/'.$edit_value->category_id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" name="category_name" value="{{$edit_value->category_name}}" class="form-control" id="slug" onkeyup="ChangeToSlug();">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="category_slug" class="form-control" value="{{$edit_value->category_slug}}"  id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Từ Khóa</label>
                                    <input type="text" name="category_keyword" value="{{$edit_value->category_keyword}}" class="form-control" id="exampleInputEmail1" placeholder="Từ Khóa.....">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Mô Tả Danh Mục</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="category_desc" id="exampleInputPassword1">{{$edit_value->category_desc}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thuộc Danh Mục</label>
                                <select name="category_parent" class="form-control input-sm m-bot15">
                                    <option value="0">--------Danh Mục Cha------</option>
                                    @foreach($category as $key => $cate)
                                        @if($cate->category_parent == 0)
                                            <option value="{{$cate->category_id}}" {{$cate->category_id == $edit_value->category_id ? 'selected' : ''}}>{{$cate->category_name}}</option>
                                        @endif
                                        @foreach($category as $key => $val)
                                            @if($val->category_parent == $cate->category_id)
                                                <option  value="{{$val->category_id}}" {{$val->category_id == $edit_value->category_id ? 'selected' : ''}}>---{{$val->category_name}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" name="add_category" class="btn btn-info">Cập Nhật Danh Mục</button>
                        </form>
                    </div>
                    @endforeach
                 </div>
        </section>

    </div>
@endsection