<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use DB;

class Couponcontroller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // start coupon view data
    public function index(Request $request){

        {
            if ($request->ajax()) {
                
                $data = DB::table('coupons')->latest()->get();
    
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
           
                                $btn = '<td><a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#coupon_edit" style="padding-right:5px !important;"><i class="fas fa-edit"></i></a>
                                        <a href="'.route('pickup.delete', [$row->id]).'" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm" id="delete_coupon"><i class="far fa-trash-alt"></i></a></td>';
          
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
              
        
            return view('admin.offers.coupon.index');
        }

    }
    // end coupon view data

    // start coupon insert data
    public function cstore(Request $request){
        $validated = $request->validate([
            'coupon_code' =>'required',
        ]);

        $data = array();
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_amount'] = $request->coupon_amount;
        $data['coupon_type'] = $request->coupon_type;
        $data['valid_date'] = $request->valid_date;
        $data['status'] = $request->status;

        DB::table('coupons')->insert($data);
        
        return response()->json('Coupon Insert successfully!');
    }
    // end coupon insert data

    // start edit view controller
    public function edit($id){
        $data = DB::table('coupons')->where('id', $id)->first();
        return view('admin.offers.coupon.edit', compact('data'));
    }
    // end edit view controller

    // start update coupon controller
    public function update(Request $request){

        $data = [
            'coupon_code' =>$request->coupon_code,
            'coupon_type' =>$request->coupon_type,
            'coupon_amount' =>$request->coupon_amount,
            'valid_date' =>$request->valid_date,
            'status' =>$request->status,
        ];

        DB::table('coupons')->where('id', $request->id)->update($data);

        return response()->json('Updated successfully!');
    }
    // end update coupon controller

    
    //start delete coupon controller
    public function cdelete($id){
        $coupon = DB::table('coupons')->where('id', $id);
        $coupon->delete();
        $notification = array(
            'message' => 'Deleted Successfully!',
            'alert-type' => 'error'
        );
        return response()->json($notification);
    }
    // end delete coupon controller



}
