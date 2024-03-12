<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
session_start();

class GalleryController extends Controller
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

    public function add_gallery( $id){
         $this->AuthLogin();
        $product_id = $id;
        return view('admin.gallery.add_gallery')->with(compact('product_id'));
    }

    public function insert_gallery(Request $request,$id){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $key => $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/gallery',$new_image);
                

                $gallery = new Gallery();
                $gallery->gallery_name =  $new_image;
                $gallery->product_id = $id;
            
                $gallery->gallery_image = $new_image;
                $gallery->save();
                
            }
        }
        // Session::put('message','Thêm Thư Viện Thành Công');
        return redirect()->back();

    }
    //cập nhật tên trong thư viện ảnh
    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name =  $gal_text;
        $gallery->save();
            

    }
    //cập nhật hình ảnh trong thư viện ảnh
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image){
           
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/gallery',$new_image);
                

                $gallery = Gallery::find($gal_id);
                $path_unlink = 'public/uploads/gallery/'.$gallery->gallery_image;
                if(file_exists($path_unlink)){
                    unlink($path_unlink);
                }
                $gallery->gallery_image = $new_image;
                $gallery->save();
                
            
        }

    }


    //xóa hình ảnh
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        $path_unlink = 'public/uploads/gallery/'.$gallery->gallery_image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        $gallery->delete();
    }

    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output='';
        $output.='
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Hình Ảnh</th>
                        <th>Hình Ảnh</th>
                        <th>Quản lí</th>
                    </tr>
                </thead>
                <tbody>



        ';
        if($gallery_count > 0 ){
            $i = 0;
            foreach($gallery as $key => $gal){
                $i++;
                $output.='
                    <tr>
                        <td>'.$i.'</td>
                        <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                        <td><img src="'.url('public/uploads/gallery/'.$gal->gallery_image).'" class= "img-thumbnail" width = "120" height="120">
                            <input type="file" class="file_image" style="width:40%" data-gal_id="'.$gal->gallery_id.'" id="file_'.$gal->gallery_id.'" name="file" accept="image/*">
                        </td>
                        <td>
                            <button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-sm btn-danger delete-gallery">XÓA
                            </button>
                        </td>
                    </tr>
                ';
            }
        }
        else{
            $output.='
                    <tr>
                        <td colspan="4">Sản Phẩm Này Chưa Có Thư Viện Ảnh</td>
                        
                    </tr>
                ';
        }
        $output.='
            </tbody>
        </table>

        ';
        echo $output;
    }
}
