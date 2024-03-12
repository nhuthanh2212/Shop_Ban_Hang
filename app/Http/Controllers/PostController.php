<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Post;
use App\Models\CategoryPost;

session_start();

class PostController extends Controller
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
     public function list_post()
    {
        $this->AuthLogin();
        $list = Post::orderby('post_id','desc')->paginate(10);
        $cate_post = CategoryPost::orderby('cate_post_id','desc')->get();
        return view('admin.post.list_post')->with(compact('list','cate_post'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_post()
    {
        $this->AuthLogin();
        $cate_post = CategoryPost::orderby('cate_post_id','desc')->get();
       
        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save_post(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post;
        $post->post_name = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keyword = $data['post_meta_keyword'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];


        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
            $post->save();
            Session::put('message','Thêm Bài Viết Thành Công');
            return Redirect::to('list-post');
        }
        else{
            Session::put('message','Vui Lòng Thêm Hình Ảnh Cho Bài Viết');
            return redirect()->back();
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_post(string $id)
    {
        $this->AuthLogin();

        $cate_post = CategoryPost::orderby('cate_post_id','desc')->get();
        $edit = Post::find($id);
        return view('admin.post.edit_post')->with(compact('cate_post','edit'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_post(Request $request, string $id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $post = Post::find($id);
        $post->post_name = $data['post_name'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_meta_keyword = $data['post_meta_keyword'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->image;
        if($get_image){
            // detele image
            $path_unlink = 'public/uploads/post'.$post->post_image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // add image new
            $path = 'public/uploads/post/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $post->post_image = $new_image;
        }
        $post->save();

        Session::put('message','Cập Nhật Bài Viết Thành Công');
        return Redirect::to('list-post');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_post(string $id)
    {
        $this->AuthLogin();
        $post = Post::find($id);
        $path_unlink = 'public/uploads/post/'.$post->post_image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        $post->delete();
        Session::put('message','Xóa Bài Viết Thành Công');
        return Redirect::to('list-post');
    }
}
