<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
use App\Models\Banner;
use App\Models\CategoryPost;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
        $image_og = '';
        $meta_keywords ="";
        $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();
        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // return view('pages.cart.show_cart')->with('cate',$cate)->with('brand',$brand);
        return view('pages.cart.show_cart')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
    }

     public function gio_hang(Request $request)
    {
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $meta_desc = "Giỏ Hàng Của Bạn";
        $image_og = '';
        $meta_keywords ="Giỏ Hàng";
        $meta_title = "Giỏ Hàng";
        $url_canonical = $request->url();

        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // return view('pages.cart.show_cart')->with('cate',$cate)->with('brand',$brand);
        return view('pages.cart.cart_ajax')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $productId = $request->productid_hidden;
        $quality = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quality;
        $data['name'] = $product_info->product_name;

        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        // Cart::setGlobalTax(10);
      
        return Redirect::to('/show-cart'); 
          Cart::destroy();
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
     
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                     $cart[] = array(
                        'session_id'=> $session_id,
                        'product_name'=> $data['cart_product_name'],
                        'product_id'=> $data['cart_product_id'],
                        'product_image'=> $data['cart_product_image'],
                        'product_quantity'=> $data['cart_product_quantity'],
                        'product_price'=> $data['cart_product_price'],
                        'product_qty'=> $data['cart_product_qty'],
                    );
                     Session::put('cart',$cart);
                }

            
        }else
        {
            $cart[] = array(
                'session_id'=> $session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=> $data['cart_product_id'],
                'product_quantity'=> $data['cart_product_quantity'],
                'product_image'=> $data['cart_product_image'],
                'product_price'=> $data['cart_product_price'],
                'product_qty'=> $data['cart_product_qty'],
            );
            Session::put('cart',$cart);
        }
        
        Session::save();

        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->quantity_cart;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }


    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $qty <  $cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue">'.$i.' Cập Nhật Sản Phẩm '.$cart[$session]['product_name'].' Số Lượng '.$qty.' Thành Công</p>';
                    }
                    elseif($val['session_id'] == $key && $qty >=  $cart[$session]['product_quantity']){
                        $message.='<p style="color:red" >'.$i.' Cập Nhật Sản Phẩm '.$cart[$session]['product_name'].' Số Lượng '.$qty.' Thất Bại</p>';
                    }
                }
            }
            Session::put('cart',$cart);
             return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập Nhật Số Lượng Thất Bại');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $rowID)
    {
        Cart::remove($rowID);
        return Redirect::to('/show-cart');
    }

    public function deleted_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa Sản Phẩm Thành Công');
        }else{
            return redirect()->back()->with('message','Xóa Sản Phẩm Thất Bại');
        }

    }
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa Tất Sản Phẩm Thành Công');
        }
    }

    
}
