<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Models\Banner;
use App\Models\CategoryPost;
use App\Models\Contact;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();


class ContactController extends Controller
{
    public function lien_he(Request $request){
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo

        $meta_desc = "Liên Hệ Với Chúng Tôi";
        $image_og = '';
        $meta_keywords ="Liên Hệ";
        $meta_title = "Liên Hệ Vói Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();

        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $contact = Contact::orderBy('info_id','DESC')->get();

        return view('pages.contact.lien_he')->with(compact('cate','brand','cate_post','slider','meta_title','meta_keywords','meta_desc','url_canonical','image_og','contact'));
    }

    //admin
    public function information(){
        $contact = Contact::orderBy('info_id','DESC')->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    //cạp nhật thông tin trang web
    public function update_info(Request $request,$id){
        $data = $request->all();
        $contact = Contact::find($id);
        $contact->info_map = $data['info_map'];
        $contact->info_contact = $data['info_contact']; 
        $contact->info_fanpage = $data['info_fanpage']; 

        $get_image = $request->file('info_image');
        $path = 'public/uploads/contact/';
        if($get_image){
            unlink($path.$contact->info_image);
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_image = $new_image;
            
        }
        $contact->save();
        Session::put('message','Cập Nhật Thông Tin Thành Công');
        return Redirect::to('information');




    }

    public function save_info(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->info_map = $data['info_map'];
        $contact->info_contact = $data['info_contact']; 
        $contact->info_fanpage = $data['info_fanpage']; 

        $get_image = $request->file('info_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/contact',$new_image);
            $contact->info_image = $new_image;
            $contact->save();
            Session::put('message','Thêm Thông Tin Thành Công');
            return Redirect::to('information');
        }
        else{
            Session::put('message','Vui Lòng Thêm Hình Ảnh');
            return redirect()->back();
        }



    }
}
