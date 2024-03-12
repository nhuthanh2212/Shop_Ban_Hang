<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Banner;
use Session;
use Auth;
session_start();

class BannerController extends Controller
{
     public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
           return Redirect::to('dashboard');
        }
        else
        {
            return Redirect::to('admin')->send();
        }
    }
    public function list_banner(){
        $this->AuthLogin();
        $list_slider = Banner::orderBy('slider_id','DESC')->get();
        return view('admin.banner.list_banner')->with(compact('list_slider'));
    }

    public function manade_banner(){
        $this->AuthLogin();
        return view('admin.banner.add_banner');
    }

    public function save_slider(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        

        $get_image = $request->file('slider_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
            

            $banner = new Banner();
            $banner->slider_name = $data['slider_name'];
            $banner->slider_desc = $data['slider_desc'];
            $banner->slider_status = $data['slider_status'];
            $banner->slider_image = $new_image;
            $banner->save();
            Session::put('message','Thêm Slider Thành Công');
            return Redirect::to('list-banner');
        }
        else{
            Session::put('message','Vui Lòng Thêm Hình Ảnh');
            return Redirect::to('manade-banner');
        }
       
        
    }

    public function unactive($id){
        $this->AuthLogin();
        $data = Banner::find($id);
        $data->slider_status = 1;
        $data->save();
        Session::put('message','Hiển Thị Slider Thành Công');
         return Redirect::to('list-banner');
    }
     public function active($id){
        $this->AuthLogin();
        $data = Banner::find($id);
        $data->slider_status = 0;
        $data->save();
        Session::put('message','Ẩn Slider Thành Công');
        return Redirect::to('list-banner');
    }

    public function delete_slider($id){
        $slider = Banner::find($id);
        $path_unlink = 'public/uploads/slider/'.$slider->slider_image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        $slider->delete();
        Session::put('message','Xóa Slider Thành Công');
        return Redirect::to('list-banner');
    }
}
