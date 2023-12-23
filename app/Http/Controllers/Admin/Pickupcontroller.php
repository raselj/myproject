<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class Pickupcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // start pickup view data
    public function index(Request $request){

        {
            if ($request->ajax()) {
                
                $data = DB::table('pickupcontroller')->latest()->get();
    
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
           
                                $btn = '<td><a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#pickupedit" style="padding-right:5px !important;"><i class="fas fa-edit"></i></a>
                                        <a href="'.route('pickup.delete', [$row->id]).'" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm" id="delete_pickup"><i class="far fa-trash-alt"></i></a></td>';
          
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
              
        
            return view('admin.pickup_point.index');
        }

    }
    // end pickup view data

    // start pickup point insert
    public function pstore(Request $request){

        $data = array();
        $data['pickup_point_name'] = $request->pickup_point_name;
        $data['pickup_point_address'] = $request->pickup_point_address;
        $data['pickup_point_phone'] = $request->pickup_point_phone;
        $data['pickup_point_phone_two'] = $request->pickup_point_phone_two;

        DB::table('pickupcontroller')->insert($data);
        return response()->json('Data Inserted successfully!');
    }
    // end pickup point Insert

    // start edit pickup point
    public function cedit($id){
        $pickup = DB::table('pickupcontroller')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('pickup'));
        
    }
    // 

    // start pickup point update
    public function update(Request $request){
        $data = [
            'pickup_point_name' =>$request->pickup_point_name,
            'pickup_point_address' =>$request->pickup_point_address,
            'pickup_point_phone' =>$request->pickup_point_phone,
            'pickup_point_phone_two' =>$request->pickup_point_phone_two,
        ];

        DB::table('pickupcontroller')->where('id', $request->id)->update($data);
        return response()->json('Data updated successfully!');
    }
    // end pickup point update

    //start delete coupon controller
    public function pdelete($id){
        DB::table('pickupcontroller')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Deleted Successfully!',
            'alert-type' => 'error'
        );
        return response()->json($notification);
    }
    // end delete coupon controller


}
