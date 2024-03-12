@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm THÔNG TIN WEBSITE
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
                        @foreach($contact as $key => $cont)
                        <form role="form" action="{{URL::to('/update-info/'.$cont->info_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Thông Tin Liên Hệ</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="info_contact" id="ckeditor1" placeholder="" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                                    {{$cont->info_contact}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Bản Đồ</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="info_map" id="" placeholder="Bản Đồ....." data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                                    {{$cont->info_map}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Fanpage</label>
                                <textarea style="resize: none;" rows="8" class="form-control" name="info_fanpage" id="" placeholder="" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                                    {{$cont->info_fanpage}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình Ảnh</label>
                                <input type="file" name="info_image" class="form-control" id="exampleInputEmail1" >
                                <img src="{{URL::to('public/uploads/contact/'.$cont->info_image)}}" width="100" height="100">
                            </div>
                            
                            
                            <button type="submit" name="add_info" class="btn btn-info">Cập Nhật THÔNG TIN</button>
                        </form>
                        @endforeach
                    </div>

                </div>
        </section>

    </div>
@endsection