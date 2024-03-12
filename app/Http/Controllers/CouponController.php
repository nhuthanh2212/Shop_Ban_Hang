<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //mã giảm giá coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }

                }
                else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm Mã Giảm Giá Thành Công');
            }
        }
        else{
            return redirect()->back()->with('error','Mã Giảm Giá Không Đúng');
        }
        
    }

    public function list_coupon()
    {
        $coupon = Coupon::orderBy('coupon_id','DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_coupon()
    {
        return view('admin.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        // $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_code = substr(md5(microtime()),rand(0,26),5);
        $coupon->coupon_qty = $data['coupon_qty'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();
        Session::put('message','Thêm Mã Thành Công'); 
        return Redirect::to('list-coupon');
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
        $coupon = Coupon::find($id);
        $coupon->delete();
        Session::put('message','Xóa Mã Thành Công'); 
        return Redirect::to('list-coupon');
    }

    //xóa mã 
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
           
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa Mã Khuyến Mãi Thành Công');
        }
    }
}
