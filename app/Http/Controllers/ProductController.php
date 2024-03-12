<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Comment;

use Illuminate\Support\Facades\File;
session_start();


class ProductController extends Controller
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
        $list = DB::table('tbl_product')->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.product.list_product')->with('list',$list);
        return view('admin_layout')->with('admin.product.list_product',$manager_product);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->AuthLogin();
        $cate = DB::table('tbl_category')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.product.add_product')->with('cate',$cate)->with('brand',$brand);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_tags'] = $request->product_tags;
        $data['product_desc'] = $request->product_desc;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['price_cost'] = $request->price_cost;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        
        $path ='public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            file::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }

        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_name = $request->product_name;
        $gallery->gallery_image = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm Sản Phẩm Thành Công');
        return Redirect::to('list-product');




       

    }

    public function unactive($id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$id)->update(['product_status' => 1]);
        Session::put('message','Hiển Thị Sản Phẩm Thành Công');
         return Redirect::to('list-product');
    }
     public function active($id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$id)->update(['product_status' => 0]);
        Session::put('message','Ẩn Sản Phẩm Thành Công');
         return Redirect::to('list-product');
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
        $cate = DB::table('tbl_category')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit = DB::table('tbl_product')->where('product_id',$id)->get();
        $manager_product = view('admin.product.edit_product')->with('edit',$edit)->with('cate',$cate)->with('brand',$brand);
        return view('admin_layout')->with('admin.product.edit_product',$manager_product);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
        $data['product_tags'] = $request->product_tags;
        $data['product_desc'] = $request->product_desc;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['price_cost'] = $request->price_cost;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$id)->update($data);
            Session::put('message','Cập Nhât Sản Phẩm Thành Công');
            return Redirect::to('list-product');
        }
        
        DB::table('tbl_product')->where('product_id',$id)->update($data);
        Session::put('message','Cập Nhật Sản Phẩm Thành Công');
        return Redirect::to('list-product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->AuthLogin();
        $product = Product::find($id);
        $path_unlink = 'public/uploads/product/'.$product->product_image;
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        $product->delete();
        Session::put('message','Xóa Sản Phẩm Thành Công');
        return Redirect::to('list-product');

    
    }

    //duyệt bình luận 
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function duyet_comment(Request $request){
        $data = $request->all();
         $comment = Comment::find($data['comment_id']);
         $comment->comment_status = $data['comment_status'];
         $comment->save();
    }
    //trả lời bình luận
    public function reply_comment(Request $request){
         $data = $request->all();
         $comment = new Comment();
         $comment->comment = $data['comment'];
         $comment->product_id = $data['comment_product_id'];
         $comment->comment_parent_comment = $data['comment_id'];
         $comment->comment_status= 1;
         $comment->comment_name = 'SHOP ĐIỆN TỬ';
         $comment->save();

    }
}
