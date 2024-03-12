@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                THÊM THƯ VIÊN ẢNH
            </header>

                <div class="panel-body">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>' ;
                            Session::put('message',null);
                        }
                    ?>
                    <form action="{{url('/insert-gallery/'.$product_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3" align="right">
                               
                            </div>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file[]" id="file" accept="image/*" multiple>
                                <span id="error_gallery"></span>
                            </div>
                            <div class="col-md-3" >
                                <input type="submit" name="taianh" value="TẢI ẢNH" class="btn btn-success ">
                            </div>
                        </div>
                    </form>
                    <div class="position-center">
                        <input type="hidden" name="product_id" class="product_id" value="{{$product_id}}">
                        <form>
                            @csrf
                            
                            <div class="table-responsive" id="gallery_load">
                                
                            </div>
                        </form>
                    </div>

                </div>
        </section>

    </div>
    <!-- gallery thu vien anh -->
    <script type="text/javascript">
        $(document).ready(function(){
        load_gallery();
        function load_gallery(){
            var pro_id = $('.product_id').val();

            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/select-gallery')}}",
                method: "POST",
                data: {pro_id:pro_id, _token: _token},
                success:function(data) {
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function() {
            var error = '';
            var files = $('#file')[0].files;
            if(files.length > 5){
                error+='<p>Bạn Chỉ Được Chọn Tối Đa 5 Ảnh</p>';
            }else if(files.length == '') {
                error+='<p>Vui Lòng Chọn Ảnh</p>';
            }else if(files.size > 2000000){
                error+='<p>Ảnh Không Được Lón Hơn 2MB</p>';
            }
            if(error == ''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span');
                return false;
            }
        });

        $(document).on('blur','.edit_gal_name',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/update-gallery-name')}}",
                method: "POST",
                data: {gal_id:gal_id, gal_text: gal_text, _token: _token},
                success:function(data) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập Nhật Tên Hình Ảnh Thành Công</span');
                }
            });
        });

        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');
        
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn Có Muốn Xóa Hình Ảnh Này Không')){
                $.ajax({
                url: "{{url('/delete-gallery')}}",
                method: "POST",
                data: {gal_id:gal_id, _token: _token},
                success:function(data) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Xóa Hình Ảnh Thành Công</span');
                }
                });
            }
            
        });

        $(document).on('change','.file_image',function(){
            var gal_id = $(this).data('gal_id');
        
            var image = document.getElementById('file_'+gal_id).files[0];
            var form_data = new FormData();

            form_data.append("file",document.getElementById('file_'+gal_id).files[0]);
            form_data.append("gal_id",gal_id);


            $.ajax({
                url: "{{url('/update-gallery')}}",
                method: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data) {
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập Nhật Hình Ảnh Thành Công</span');
                }
            });
            
            
        });

    });

    </script>
@endsection