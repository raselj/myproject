<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use File;
use Illuminate\Support\Str;
use App\Models\Brand;
use Yajra\Datatables\Datatables;


class Brandcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // view controller section

    public function index(Request $request){

        {
            if ($request->ajax()) {
                
                $data = DB::table('brands')->get();
    
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
           
                                $btn = '<td><a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#child-edit" style="padding-right:5px !important;"><i class="fas fa-edit"></i></a>
                                        <a href="'.route('brand.delete', [$row->id]).'" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="far fa-trash-alt"></i></a></td>';
          
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
              
        
            return view('admin.category.brand.index');
        }

    }

    // brand data store here

    public function bstore(Request $request){

        $validated = $request->validate([
            'brand_name'=>'required|unique:brands|max:55',
        ]);

        $slug = Str::slug($request->brand_logo, '-');

        $data = array();

        $data['brand_name']=$request->brand_name;
        $data['brand_slug']=Str::slug($request->brand_name, '-');
        // working with image
        $photo = $request->brand_logo;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        
        $photo->move('public/image/', $photoname);

        $data['brand_logo'] = 'public/image/'.$photoname;

        DB::table('brands')->insert($data);

        // submit alert message
        $notification = array(
            'message' => 'Brand Submitted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // delete brand data

    public function destroy($id){
        $data = DB::table('brands')->where('id', $id)->first();
        // for delete image file from folder
        $image = $data->brand_logo;
        if(!File::exists($image)){
            unlink($image);
        }

        DB::table('brands')->where('id', $id)->delete();
        // alert message when delete data
        $notification = array(
            'message' => 'Brand Deleted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // brand edit data here

    public function edit($id){
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('data'));
       
    }

    // brand update data here 

    public function update(Request $request){
        
        $slug = Str::slug($request->brand_logo, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_logo, '-');
        if($request->brand_logo){

            $image = $request->olf_logo;
            if(!File::exists($image)){
                unlink($image);
            }

            $data['brand_name']=$request->brand_name;
            $data['brand_slug']=Str::slug($request->brand_name, '-');
            // working with image
            $photo = $request->brand_logo;
            $photoname = $slug.'.'.$photo->getClientOriginalExtension();
            
            $photo->move('public/image/', $photoname);

            $data['brand_logo'] = 'public/image/'.$photoname;
            DB::table('brands')->where('id', $request->id)->update($data);

            // alert message is here
            $notification = array(
                'message' => 'Brand Successfully updated!', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);


        }else{

            $data['brand_logo'] = $request->olf_logo;

            // alert message is here
            $notification = array(
                'message' => 'Brand Successfully updated!', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }




    }


}
