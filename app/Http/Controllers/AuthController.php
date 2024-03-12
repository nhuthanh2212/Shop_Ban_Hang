<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Roles;
use App\Models\ForgotPassword;
use Auth;
use Mail;
use Session;
session_start();

class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.auth.register');
    }

    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return Redirect::to('admin')->with('message', 'Đăng Ký Thành Công');

    }

    public function validation($request){
        return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_phone' => 'required|max:255',
            'admin_email' =>  'required|email|max:255',
            'admin_password' => 'required|max:255',


        ]);
    }

    public function login_auth(){
        return view('admin.auth.login_auth');
    }


    public function login(Request $request){
        $this->validate($request,[
            'admin_email' =>  'required|email|max:255',
            'admin_password' => 'required|max:255',


        ]);
        // $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])){
            return redirect('/dashboard');
        }else{
            return redirect('login-auth')->with('message','Quý Khách Vui Lòng Kiểm Tra Lại Email Hoặc Password.');
        }
    }


    public function logout_auth(){
        Auth::logout();
        return redirect('login-auth')->with('message','Đăng Xuất Thành Công');
    }


    // quen mat khau
    public function forgot_password(){
        return view ('admin.auth.forgot_password');
    }

    public function forgot(Request $request){
        $data = $request->all();
        
        $admin = Admin::orderBy('admin_id','DESC')->first();
        
        if($data['comfirm_email'] == $admin->admin_email){
            $auth_code = substr(md5(microtime()),rand(0,26),5);

            Mail::send('pages.email.auth_code',compact('auth_code'), function($email){
                $email->to('trannhuthanh221202@gmail.com','Tran Nhu Thanh');
            });
            $forgot = new ForgotPassword();
            $forgot->email = $data['comfirm_email'];
            $forgot->auth_code = $auth_code;
            $forgot->save();
            Session::put('message','Vui Lòng Nhập Mã Xác Nhận');
            return  view('admin.auth.comfirm_password');
        }
        else{
            Session::put('message','Email Không Tồn Tại Vui Lòng Nhập Lại email.');
            return view('admin.auth.forgot_password');
        }
        
    }
   
    public function comfirm(Request $request){
        $data = $request->all();
        $code = ForgotPassword::orderBy('forgot_id','ASC')->first();
        
        if($data['auth_code'] == $code->auth_code){
            return view('admin.auth.create_new_password');

        }
        else{
            Session::put('message','Mã Xác Nhận Không Hợp Lệ. Vui Lòng Kiểm tra lại.');
            return Redirect()->back();
        }
    }
    public function create_new_password(Request $request){
        // $data = $request->all();
    }
    
}
