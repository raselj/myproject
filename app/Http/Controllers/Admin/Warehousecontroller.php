<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Warehousecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // warehouse view controller
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = DB::table('warehouse')->latest()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<td><a href="#" class="btn btn-success rounded-0 btn-sm wedit" data-id="'.$row->id.'" data-toggle="modal" data-target="#ware-edit" style="padding-right:5px !important;"><i class="fas fa-edit"></i></a>
                                    <a href="'.route('warehouse.delete', [$row->id]).'" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="far fa-trash-alt"></i></a></td>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          

        return view('admin.category.warehouse.index');
    }

    // warehouse store controller
    public function store(Request $request){
        $validated = $request->validate([
            'warehouse_name' =>'required|unique:warehouse',
        ]);

        $data = array();
        $data['warehouse_name'] = $request->warehouse_name;
        $data['warehouse_address'] = $request->warehouse_address;
        $data['warehouse_phone'] = $request->warehouse_phone;

        DB::table('warehouse')->insert($data);
        // alert message
        $notification = array(
            'message' => 'SubCategory updated!', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // warehouse destroy controller
    public function delete($id){
      $waredel = DB::table('warehouse')->where('id', $id);
      $waredel->delete();

      $notification = array(
            'message'=>'Data deleted successfully!',
            'alert-type'=>'error',
      );
      return redirect()->back()->with($notification);
    }

    // warehouse edit controller
    public function edit($id){
        $warehouse = DB::table('warehouse')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('warehouse'));
    }

    // warehouse update controller
    public function update(Request $request){

        $data = [
            'warehouse_name' =>$request->warehouse_name,
            'warehouse_address' =>$request->warehouse_address,
            'warehouse_phone' =>$request->warehouse_phone,
        ];

        DB::table('warehouse')->where('id', $request->id)->update($data);

        $notification = array(
            'message'=>'Data updated successfully!',
            'alert-type' =>'success',
        );

        return redirect()->back()->with($notification);


    }


}
