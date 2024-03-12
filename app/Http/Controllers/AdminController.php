<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Auth;
use App\Models\Login;
use App\Models\Social;
use Socialite;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\Hash;
use App\Rules\Captch;
use Validator;
use App\Models\Statistic;
use App\Models\Visitors;
use App\Models\Product;

use App\Models\Post;

use App\Models\Order;
use App\Models\Customer;


use Carbon\Carbon;





class AdminController extends Controller
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
    public function login()
    {
        return view('admin_login');
    }
    public function index()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login vao trang admin
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->admin_id);
            
        }
        else{
            $admin_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider'=>'facebook'
            ]);
            $orang = Login::where('admin_email',$provider->getEmail())->first();
            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $account_name = Login::where('admin_id',$admin_login->user)->first();
            Session::put('admin_name',$admin_login->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$admin_login->admin_id);
           
        }
         return redirect('/dashboard')->with('message','Đăng Nhập Admin Thành Công');
    }

    public function dashboard(Request $request)
    {
        
        $this->AuthLogin();

        $user_ip_address = $request->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();

        $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();

        $visitor_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get();
        $visitor_year_count = $visitor_of_year->count();

        $visitors = Visitors::all();
        $visitor_total = $visitors->count();

        $visitor_current = Visitors::where('ip_address',$user_ip_address)->get();
        $visitor_count = $visitor_current->count(); 

        if($visitor_count<1){
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        

        $products = Product::all()->count();

        $product_view = Product::orderBy('product_view','DESC')->take(20)->get();
        $posts = Post::all()->count();

        $post_views = Post::orderby('post_view','DESC')->take(20)->get();

        $orders = Order::all()->count();

        $customers = Customer::all()->count();

        return view('admin.dashboard')->with(compact('visitor_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count','products','product_view','posts','post_views','orders','customers'));


       
     
    }

     public function logout(Request $request)
    {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    /**
     * Show the form for creating a new resource.
     */

    // lọc ngày tháng năm
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderby('order_date','ASC')->get();

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,

                'profit' => $val->profit,
                'quantity' => $val->quantity,


            );
        }
        echo $data = json_encode($chart_data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7ngay,$now])->orderby('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thang_truoc,$cuoi_thang_truoc])->orderby('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dau_thang_nay,$now])->orderby('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365ngay,$now])->orderby('order_date','ASC')->get();
        }

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,

                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    /**
     * Display the specified resource.
     */
    public function days_order(Request $request)
    {
        
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',[$sub60days,$now])->orderby('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,

                'profit' => $val->profit,
                'quantity' => $val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
