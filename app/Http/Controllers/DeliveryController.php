<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_delivery()
    {
        $feeship = Feeship::orderBy('fee_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive"> 
                    <table class="table table-bordered" >
                        <thread>
                            <tr>
                                <th>Tên Thành Phố</th>
                                <th>Tên Quận Huyện</th>
                                <th>Tên Xã Phường</th>
                                <th>Phí</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach($feeship as $key => $fee){
            $output .= '
                    <tr>
                        <td>'.$fee->city->name_city.'</td>
                        <td>'.$fee->province->name_quanhuyen.'</td>
                        <td>'.$fee->wards->name_xaphuong.'</td>
                        <td contenteditable data-fee_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship, 0, ',', '.').'</td>
                    </tr>
                    ';
        }

        $output .= '
                    </tbody>
                </table>
            </div>
        ';

        echo $output;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_delivery()
    {
        $city = City::orderBy('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function select_delivery(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update_feeship(Request $request)
    {
        $data= $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
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
