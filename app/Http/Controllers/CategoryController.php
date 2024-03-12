<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Category;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function index()
    {
        $this->AuthLogin();
        $category_product = Category::where('category_parent',0)->orderby('category_id','desc')->get();
        $list = DB::table('tbl_category')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        // $list = DB::table('tbl_category')->orderby('category_parent','desc')->get();
        $manager_category = view('admin.category.list')->with('list',$list)->with('category_product',$category_product);
        return view('admin_layout')->with('admin.category.list',$manager_category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->AuthLogin();
         $category = Category::where('category_parent',0)->orderby('category_id','desc')->get();
        return view('admin.category.add_category')->with(compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $request->category_slug;
        $data['category_keyword'] = $request->category_keyword;
        $data['category_desc'] = $request->category_desc;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_status;
        $data['category_order'] = 0;

        DB::table('tbl_category')->insert($data);
        Session::put('message','Thêm Danh Mục Thành Công');
        return Redirect::to('list-category');

    }

    public function unactive($id){
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id',$id)->update(['category_status'=>1]);
        Session::put('message','Hiển Thị Danh Mục Thành Công');
         return Redirect::to('list-category');
    }
     public function active($id){
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id',$id)->update(['category_status'=>0]);
        Session::put('message','Ẩn Danh Mục Thành Công');
         return Redirect::to('list-category');
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
    public function edit(string $id)
    {
        $this->AuthLogin();
        $category = Category::orderby('category_id','desc')->get();
       $edit = DB::table('tbl_category')->where('category_id',$id)->get();
        $manager_category = view('admin.category.edit_category')->with('edit',$edit)->with('category',$category);
        return view('admin_layout')->with('admin.category.edit_category',$manager_category);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = $request->category_slug;
        $data['category_keyword'] = $request->category_keyword;
        $data['category_desc'] = $request->category_desc;
         DB::table('tbl_category')->where('category_id',$id)->update($data);
        Session::put('message','Cập Nhật Danh Mục Thành Công');
        return Redirect::to('list-category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->AuthLogin();
         DB::table('tbl_category')->where('category_id',$id)->delete();
        Session::put('message','Xóa Danh Mục Thành Công');
        return Redirect::to('list-category');
    }

    // sắp xếp thứ tự

    public function array_category(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        foreach($data['page_id_array'] as $key => $value){
            $category = Category::find($value);
            $category->category_order = $key;
            $category->save();
        }
    }

    public function import_csv(){

    }

    public function export_csv(){
        
    }
}
