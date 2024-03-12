@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt Kê User
    </div>
   
    <div class="table-responsive">
        <?php
            $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message',null);
                }
                    ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Users</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Author</th>
            <th>Admin</th>
            <th>User</th>
           
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($admin as $key => $user )
            <form action="{{url('/assign-roles')}}" method="post">
              @csrf
              <tr>
                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                <td>{{$user->admin_name}}</td>
                <td>{{$user->admin_email}} <input type="hidden" name="admin_email" value="{{$user->admin_email}}">
                    <input type="hidden" name="admin_id" value="{{$user->admin_id}}">
                </td>
                <td>{{$user->admin_phone}}</td>
                <td>{{$user->password}}</td>
                
                <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}} ></td>
                <td><input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'checked' : ''}} ></td>
                <td><input type="checkbox" name="user_role" {{$user->hasRole('user') ? 'checked' : ''}} ></td>
                <td>
                    <input type="submit" value="PHÂN QUYỀN" class="btn btn-sm btn-default" name="">
                    <a class="btn btn-sm btn-danger" href="{{url('delete-user/'.$user->admin_id)}}">XÓA USER</a>
                    <a class="btn btn-sm btn-success" href="{{url('impersonate/'.$user->admin_id)}}"> CHUYỂN USER</a>
                </td>
              </tr>
          </form>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>
    
@endsection