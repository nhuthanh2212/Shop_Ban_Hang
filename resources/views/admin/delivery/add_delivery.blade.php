@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Vận Chuyển
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
                        <form>
                            @csrf
                                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Thành Phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    
                                    <option value="0">-----Chọn Tỉnh Thành Phố-----</option>
                                    @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Quận-Huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                    
                                    <option value="0">-----Chọn Quận Huyện------</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Chọn Xã-Phường-Thị Trấn</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    
                                    <option value="0">-----Chọn Xã Phường-----</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí Vận Chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Phí Vận Chuyển....." data-validation="number" data-validation-error-msg="Vui Lòng Điền Phí Ship">
                            </div>
                            <button type="button" name="add_delivery" class=" btn btn-info add_delivery">THÊM PHÍ VẬN CHUYỂN</button>
                        </form>
                    </div>
                    <br>
                    <div id="load_delivery">
                        
                    </div>
                </div>
        </section>

    </div>
    <!-- --ajax quan huyện  -->
    <script type="text/javascript">
    $(document).ready(function(){
        fetch_delivery();
        
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/list-delivery")}}',
                method: 'POST',
                data: {_token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){
            var feeship_id = $(this).data('fee_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/update-feeship")}}',
                method: 'POST',
                data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                success:function(data) {
                    fetch_delivery();
                }
            });
        });
        $('.add_delivery').click(function(){

            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url("/insert-delivery")}}',
                method: 'post',
                data: { city: city, province: province, wards: wards, fee_ship: fee_ship, _token: _token },
                success: function(data){
                    alert('Thêm Phí Vận Chuyển Thành Công');
                    fetch_delivery();
                }
            });

        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var matp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var $result = '';
            if (action == 'city'){
                $result = 'province';
            } else {
                $result = 'wards';
            }
            $.ajax({
                url: '{{url("/select-delivery")}}',
                method: 'post',
                data: { action: action, matp: matp, _token: _token },
                success: function(data){
                    $('#'+$result).html(data);
                }
            });
        });
    });
</script>
@endsection
