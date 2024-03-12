<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\CategoryPost;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPostController extends Controller
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
    public function list_cate_post()
    {
        $this->AuthLogin();
        
        $list = CategoryPost::orderby('cate_post_id','desc')->paginate(5);
        
        return view('admin.cate_post.list_post')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_cate_post()
    {
        $this->AuthLogin();
         
        return view('admin.cate_post.add_cate_post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save_cate_post(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $cate_post = new CategoryPost;
        $cate_post->cate_post_name = $data['cate_post_name'];
        $cate_post->cate_post_slug = $data['cate_post_slug'];
        $cate_post->cate_post_desc = $data['cate_post_desc'];
        $cate_post->cate_post_status = $data['cate_post_status'];
        $cate_post->save();
        Session::put('message','Thêm Danh Mục Tin Tức Thành Công');
        return Redirect::to('/list-cate-post');

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
    public function edit_cate_post(string $id)
    {
        $this->AuthLogin();
        
        $edit = CategoryPost::find($id);
       
        return view('admin.cate_post.edit_cate_post')->with(compact('edit'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_cate_post(Request $request, string $id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $cate_post = CategoryPost::find($id);
        $cate_post->cate_post_name = $data['cate_post_name'];
        $cate_post->cate_post_slug = $data['cate_post_slug'];
        $cate_post->cate_post_desc = $data['cate_post_desc'];
        $cate_post->cate_post_status = $data['cate_post_status'];
        $cate_post->save();
        Session::put('message','Cập Nhật Danh Mục Bài Viết Thành Công');
        return Redirect::to('/list-cate-post');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_cate_post(string $id)
    {
        $this->AuthLogin();
        $cate_post = CategoryPost::find($id);
        $cate_post->delete();
        Session::put('message','Xóa Danh Mục Bài Viết Thành Công');
        return redirect()->back();
    }

}
