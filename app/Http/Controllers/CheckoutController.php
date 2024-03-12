<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Cart;
use Auth;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\CategoryPost;


class CheckoutController extends Controller
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
    /**
     * Display a listing of the resource.
     */


    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()),rand(0,26),5);

        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('u-m-d');

        $order->order_date = $order_date;
        $order->save();

         

        
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){

                $order_detail = new OrderDetails();
                $order_detail->order_code = $checkout_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->product_name = $cart['product_name'];
                $order_detail->product_price = $cart['product_price'];
                $order_detail->product_sales_quantity = $cart['product_qty'];
                $order_detail->product_coupon = $data['order_coupon'];
                $order_detail->product_feeship = $data['order_feeship'];
                $order_detail->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');

    }

    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){
                    foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }
                else{
                    Session::put('fee',100000);
                    Session::save();
                }
            }
            
        }
    }

    public function delete_fee(){
        Session::forget('fee');
        return redirect()->back();
    }

    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['matp'])->orderby('maqh','ASC')->get();
                $output.='<option>-----Chọn Quận Huyện-----</option>';
                foreach($select_province as $key => $province){
                $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{
                 $select_wards = Wards::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                 $output.='<option>-----Chọn Xã Phường-----</option>';
                foreach($select_wards as $key => $ward){
                $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function login_checkout(Request $request){
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
        $image_og = '';
        $meta_keywords ="";
        $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();



        $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // return view('pages.checkout.login_checkout')->with('cate',$cate)->with('brand',$brand);

        return view('pages.checkout.login_checkout')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
    }
    
    public function store(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id',$customer_id); 
        Session::put('customer_name',$request->customer_name); 
        return Redirect('/checkout');
    }
    
    public function checkout(Request $request){

        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();

        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        //seo
        $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
        $image_og = '';
        $meta_keywords ="";
        $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();


         $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // return view('pages.checkout.show_checkout')->with('cate',$cate)->with('brand',$brand);
        $city = City::orderBy('matp','ASC')->get();
        $province = Province::orderBy('maqh','ASC')->get();
        $wards = Wards::orderBy('xaid','ASC')->get();


        return view('pages.checkout.show_checkout')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','city','province','wards','slider','image_og','cate_post'));
    }

    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id); 
        
        return Redirect('/payment');

    }

    // thanh toán
    public function payment(Request $request){
        //danh muc bai viet
        $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
        //slider
        $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

         //seo
        $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
        $image_og = '';
        $meta_keywords ="";
        $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
        $url_canonical = $request->url();


         $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // return view('pages.checkout.payment')->with('cate',$cate)->with('brand',$brand);

        return view('pages.checkout.payment')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
    }
    //đăng xuất
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('login-checkout');
    }
    //đăng nhập
    public function login(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
            Session::put('customer_id',$result->customer_id); 
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }

    public function order_place(Request $request){
        //get payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang Chờ Xử Lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);


        // insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang Chờ Xử Lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // insert order details
        $content = Cart::content();
        foreach($content as $key => $conte){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $conte->id;
            $order_d_data['product_name'] = $conte->name;
            $order_d_data['product_price'] = $conte->price;
            $order_d_data['product_sales_quantity'] = $conte->qty;
            DB::table('tbl_order_details')->insert($order_d_data);

        }
        if($data['payment_method'] == 1){
            echo 'Thanh Toán Thẻ ATM';
        }
        elseif($data['payment_method'] == 2)
        {

            Cart::destroy();
            //danh muc bai viet
            $cate_post = CategoryPost::where('cate_post_status',1)->orderby('cate_post_id','desc')->get();
            //slider
            $slider = Banner::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
             //seo
            $meta_desc = "Chuyên Bán Đồ Điện Tử Cao Cấp Đẹp Mắt, Chất Lượng và Chính Hãng";
            $image_og = '';
            $meta_keywords ="";
            $meta_title = "Shop Điện Tử Chính Hãng, Cao Cấp và Chất Lượng";
            $url_canonical = $request->url();

             $cate = DB::table('tbl_category')->where('category_status','1')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
            $brand = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
            // return view('pages.checkout.handcash')->with('cate',$cate)->with('brand',$brand);


            return view('pages.checkout.handcash')->with(compact('cate', 'brand','meta_desc','meta_title','meta_keywords','url_canonical','slider','image_og','cate_post'));
        }
        else
        {
            echo 'Ví Điện Tử';
        }


    
    }


    //quan ly don hang
    public function manage_order(){
        $this->AuthLogin();
        $list_order = DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')->select('tbl_order.*','tbl_customer.customer_name')->orderby('tbl_order.order_id','desc')->get();


        $manager_order = view('admin.manage_order')->with('list_order',$list_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }

    // chi tiet don hang
    public function show($id){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();


        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
}
