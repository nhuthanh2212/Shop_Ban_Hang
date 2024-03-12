<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Roles;
use Auth;
use Session;
session_start();


class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderby('admin_id','DESC')->paginate(5);
        return view('admin.user.list_user')->with(compact('admin'));
    }

    public function  assign_roles(Request $request){
        if(Auth::id() == $request->admin_id){
            return redirect()->back()->with('message','Không Thể Gán Quyền Đang Sử Dụng User này');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['author_role']){
            $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('name','admin')->first());
        }
        if($request['user_role']){
            $user->roles()->attach(Roles::where('name','user')->first());
        }
        return redirect()->back()->with('message','Cấp Quyền Thành Công');
    }
    public function add_user(){
        return view('admin.user.add_user');
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone= $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        Session::put('message','Thêm User Thành Công');
        return redirect::to('/users');
    }
    public function delete_user($id){
        if(Auth::id() == $id){
            return redirect()->back()->with('message','Không Thể Xóa User Đang Sử Dụng');
        }else{
            $admin = Admin::find($id);
            if($admin){
                $admin->roles()->detach();
                $admin->delete();
            }
            
            return redirect()->back()->with('message','Xóa User Thành Công');
        }
        
    }
    //chuyen user 
    public function impersonate($id){
        $user = Admin::where('admin_id',$id)->first();
        if($user){
            Session()->put('impersonate',$user->admin_id);
        }
        return redirect('/users');
    }
    public function impersonate_destroy(){
        Session()->forget('impersonate');
        return redirect('users');
    }
}
