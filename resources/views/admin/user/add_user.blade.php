@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Danh User
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
                        <form role="form" action="{{URL::to('/insert-user')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên User</label>
                                    <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên User.....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Phone.....">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Email</label>
                                <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email.....">
                            </div>
                            <div class="form-group">
                                <label   for="exampleInputPassword1">Password</label>
                                <input type="text" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Password....">
                            </div>
                            
                            <button type="submit" name="add_category" class="btn btn-info">Thêm User</button>
                        </form>
                    </div>

                </div>
        </section>

    </div>
@endsection