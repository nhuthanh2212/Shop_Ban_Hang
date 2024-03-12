<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Feeship;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use PDF;

class OrderController extends Controller
{

    //In hóa đơn Đơn hàng bằng PDF
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_detail = OrderDetails::where('order_code',$checkout_code)->get();

        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_detail_product = OrderDetails::with('product')->where('order_code',$checkout_code)->get();

        foreach($order_detail_product as $key => $order_de){
            $product_coupon = $order_de->product_coupon;
            

        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();

            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            if($coupon_condition==1){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition==2){
                $coupon_echo = number_format($coupon_number,0,",",".").'<sup>đ</sup>';
            }
        }
        else{
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_echo = 0;
        }

        $output = '';
        $output.='
        <style>
            body{
                font-family: DejaVu Sans;
            }
            .table-styling{
                border: 1px solid #000;
            }
            .table-styling th{
                border: 1px solid #000;
            }
            .table-styling td{
                border: 1px solid #000;
            }
        </style>
        <h3><center> CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM </center></h3>
        <h3><center> Độc Lập - Tự Do - Hạnh Phúc </center></h3>
        <h5><center> Công Ty TNHH Một Thành Viên Cung Cấp Đồ Điện Tử </center></h5> 
        <p>THÔNG TIN KHÁCH HÀNG.</p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    
                </tr>
            </thead>
            <tbody>';
           
            $output.='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>
                    
                </tr>';
            
        $output.='
            </tbody>

         </table>

        <p>THÔNG TIN GIAO HÀNG. </p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên Người Nhận</th>
                    <th>Số Điện Thoại</th>
                    <th>Email</th>
                    <th>Dịa Chỉ</th>
                    <th>Ghi Chú</th>
                    
                </tr>
            </thead>
            <tbody>';
           
            $output.='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_email.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                    <td>'.$shipping->shipping_notes.'</td>
                    
                </tr>';
            
        $output.='
            </tbody>

         </table>

         <p>Đơn Hàng. </p>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Mã Giảm Giá</th>
                    <th>Phí Ship</th>
                    <th>Số Lượng</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>';

            
            $total = 0;

                foreach($order_detail_product as $key => $product){
                    $subtotal = $product->product_price * $product->product_sales_quantity ;
                    $total += $subtotal;
                    if($product->product_coupon != 'no'){
                        $product_coupon = $product->product_coupon;
                    }else{
                        $product_coupon = "Không Tồn Tại.";
                    }

            $output.='
                <tr>
                    <td>'.$product->product_name.'</td>
                    <td>'.$product_coupon.'</td>
                    <td>'.number_format($product->product_feeship,0,",",".").'<sup>đ</sup></td>
                    <td>'.$product->product_sales_quantity.'</td>
                    <td>'.number_format($product->product_price,0,",",".").'<sup>đ</sup></td>
                    <td>'.number_format($subtotal,0,",",".").'<sup>đ</sup></td>
                    
                </tr>';
            }

            if($coupon_condition==1){
                $total_after_coupon = ($total * $coupon_number) / 100;
                
                $total_coupon = $total - $total_after_coupon + $product->product_feeshi;
            }else
            {
                
                $total_coupon = $total - $coupon_number + $product->product_feeship;
            }

        $output.='<tr>
            <td colspan="6">
                <p>Tổng Tiền: '.number_format($total,0,",",".").'<sup>đ</sup></p>
            </td>

        </tr>';

        $output.='<tr>
            <td colspan="6">
                <p>Phí Ship: '.number_format($product->product_feeship,0,",",".").'<sup>đ</sup></p>
            </td>

        </tr>';

        $output.='<tr>
            <td colspan="6">
                <p>Giảm: '.$coupon_echo.'</p>
            </td>

        </tr>';

        $output.='<tr>
            <td colspan="6">
                <p>Thanh Toán: '.number_format($total_coupon,0,",",".").'<sup>đ</sup></p>
            </td>

        </tr>';

        $output.='
            </tbody>

         </table>



         ';
        $output.='
            </tbody>

         </table>

        <p>Ký Tên. </p>
        <table >
            <thead>
                <tr>
                    <th width="300px">Cửa Hàng Điện Tử</th>
                    <th width="400px">Người Nhận</th>
                    
                    
                </tr>
            </thead>
            <tbody>';
           
            
            
        $output.='
            </tbody>

         </table>';

         return $output;
    }


    public function manage_order(){
       
        $order = Order::orderBy('created_at','DESC')->where('order_status',1)->get();
        return view('admin.order.manage_order')->with(compact('order'));
    }


    public function view_order(string $order_code){
        $order_detail = OrderDetails::with('product')->where('order_code',$order_code)->get();

        $order = Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_detail_product = OrderDetails::with('product')->where('order_code',$order_code)->get();
        foreach($order_detail_product as $key => $order_de){
            $product_coupon = $order_de->product_coupon;
            

        }
        if($product_coupon != 'no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }
        else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        
        
        return view('admin.order.information_detail_order')->with(compact('order','customer','shipping','order_detail','coupon_condition', 'coupon_number','order_status'));

    }
    public function update_order_qty(Request $request){
        $data = $request->all();
        //update order
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date',$order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        if ($order->order_status == 2) {
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                $product_price = $product->product_price;
                $product_cost = $product->price_cost;

                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['quantity'] as $key1 => $qty){
                    if($key == $key1){
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();

                        $quantity+=$qty;
                        $total_order += 1;
                        $sales+=$product_price*$qty;
                        $profit = $sales - ($product_cost*$qty);
                    }
                }
            }
            //updte danh so

            if($statistic_count>0){
                $statistic_update = Statistic::where('order_date',$order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit = $statistic_update->profit + $profit;

                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            }
            else{
                $statistic_new = new Statistic();
                $statistic_new->order_date = $order_date;

                $statistic_new->sales = $sales;
                $statistic_new->profit = $profit;

                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }

        }
        elseif($order->order_status!=2 && $order->order_status!=1 ){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key1 => $qty){
                    if($key == $key1){
                        $pro_remain = $product_quantity + $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }
    public function update_qty(Request $request){
        $data = $request->all();
        $order_detail = OrderDetails::where('product_id', $data['order_product_id'])->where('order_code', $data['order_code'])->first();
        $order_detail->product_sales_quantity = $data['order_qty']; 
        $order_detail->save(); 

    }
    public function loc_order(){
        $sapxep = '';
        if (array_key_exists('orders', $_GET)) {
            $sapxep = $_GET['orders'];
        }

        if ($sapxep == '') {
            $order = Order::orderBy('created_at', 'DESC')->where('order_status', 1)->get();
        } else {
            $order = Order::orderBy('created_at', 'DESC')->where('order_status', $sapxep)->get();
        }
        
        return view('admin.order.manage_order')->with(compact('order'));
    }

}
