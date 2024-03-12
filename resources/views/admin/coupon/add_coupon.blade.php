@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Mã Giảm Giá
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
                        <form role="form" action="{{URL::to('/save-coupon')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Mã Giảm Giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên Mã Giảm Giá...."  data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui Lòng Điền Ít Nhất 1 Kí Tự">
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Mã Giảm Giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" placeholder="Mã Giảm Giá......">
                            </div> -->
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Số Lượng</label>
                                <input type="text" name="coupon_qty" class="form-control" id="exampleInputEmail1" placeholder="Số Lượng....." data-validation="number" data-validation-error-msg="Vui Lòng Điền Số Lượng">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tính Năng</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">--------Chọn--------</option>
                                        <option value="1">Giảm Theo %</option>
                                        <option value="2">Giảm Theo Số Tiền</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số % or Số Tiền Giảm</label>
                                <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="Số % or Số Tiền Giảm......" data-validation="number" data-validation-error-msg="Vui Lòng Điền Mức Giảm">
                            </div>
                            
                            <button type="submit" name="add_coupon" class="btn btn-info">THÊM MÃ</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection