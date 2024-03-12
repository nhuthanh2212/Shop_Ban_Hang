<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use App\Http\Requests;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
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
        // $list = DB::table('tbl_brand')->get();
        $list = Brand::orderBy('brand_id','DESC')->get();
        $manager_brand = view('admin.brand.list_brand')->with('list',$list);
        return view('admin_layout')->with('admin.brand.list_brand',$manager_brand);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->AuthLogin();
        return view('admin.brand.add_brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['brand_desc'] = $request->brand_desc;
        // $data['brand_status'] = $request->brand_status;
        // DB::table('tbl_brand')->insert($data);cach thong thuong
        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_keyword = $data['brand_keyword'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        Session::put('message','Thêm Thương Hiệu Thành Công'); 
        return Redirect::to('list-brand');

    }

    public function unactive($id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$id)->update(['brand_status'=>1]);
        Session::put('message','Hiển Thị Thương Hiệu Thành Công');
         return Redirect::to('list-brand');
    }
     public function active($id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$id)->update(['brand_status'=>0]);
        Session::put('message','Ẩn Thương Hiệu Thành Công');
         return Redirect::to('list-brand');
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
       // $edit = DB::table('tbl_brand')->where('brand_id',$id)->get();
        $edit = Brand::find($id);
        $manager_brand = view('admin.brand.edit_brand')->with('edit',$edit);
        return view('admin_layout')->with('admin.brand.edit_brand',$manager_brand);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_name;
        // $data['brand_desc'] = $request->brand_desc;
        //  DB::table('tbl_brand')->where('brand_id',$id)->update($data);
        $data = $request->all();
        $brand = Brand::find($id);
        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_keyword = $data['brand_keyword'];
        $brand->brand_desc = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];
        $brand->save();
        Session::put('message','Cập Nhật Thương Hiệu Thành Công');
        return Redirect::to('list-brand');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->AuthLogin();
         DB::table('tbl_brand')->where('brand_id',$id)->delete();
        Session::put('message','Xóa Thương Hiệu Thành Công');
        return Redirect::to('list-brand');
    }
}
