<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;

use Yajra\Datatables\Datatables;


class Childcontroller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


   // view index controller with ajax table
   public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $data = DB::table('childcategories')->leftJoin('categories', 'childcategories.category_id','categories.id')
                   ->leftJoin('subcategories', 'childcategories.subcategory_id','subcategories.id')
                   ->select('categories.category_name', 'subcategories.subcategory_name', 'childcategories.*')->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<td><a href="#" class="btn btn-success rounded-0 btn-sm edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#child-edit" style="padding-right:5px !important;"><i class="fas fa-edit"></i></a>
                                    <a href="'.route('childcategory.delete', [$row->id]).'" style="margin-left:6px;" name="action" class="btn btn-danger rounded-0 btn-sm Deletep"><i class="far fa-trash-alt"></i></a></td>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        $category = DB::table('categories')->get();
        return view('admin.category.childcategory.index', compact('category'));
    }
    // end view index controller with ajax


  // start insert or store data controller 
  public function substore(Request $request){

    $cat = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
    
        //    $childcategory = Str::slug($request->childcategory_name, '-');
        
        //    $data = array();

        //    $data['category_id'] = $cat->category_id;
        //    $data['subcategory_id'] = $request->subcategory_id;
        //    $data['childcategory_slug'] = $childcategory;
        //    $data['childcategory_name'] = $request->childcategory_name;
        //    DB::table('childcategories)->insert($data);


        Childcategory::insert([
            'category_id' => $cat->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_name' => $request->childcategory_name,
            'childcategory_slug' => Str::slug($request->childcategory_name, '-')
        ]);
    
        return redirect()->back()->with('success', 'data submited successfully!');

    }
    // end insert or store data controller


    //start destroy data controller
    public function destroy($id){

        $childd = DB::table('childcategories')->where('id', $id);
        $childd->delete();

        $notification = array(
            'message' => 'Deleted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    // end destroy data controller

    // start edit data controller 
    public function edit($id){
    
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id', $id)->first();
        
        return view('admin.category.childcategory.edit', compact('category','data'));
    }
    // end edit data controller

    // start update data controller
    public function update(Request $request){
        
        $cat = DB::table('subcategories')->where('id', $request->subcategory_id)->first();
        
        $data = [
            
        'id' => $request->id,
        'category_id' => $cat->category_id,
        'subcategory_id' => $request->subcategory_id,
        'childcategory_name' => $request->childcategory_name,
        'childcategory_slug' => Str::slug($request->childcategory_name, '-')

        ];

    
        DB::table('childcategories')->where('id', $request->id)->update($data);

       $notification = array(
           'message' => 'SubCategory updated!', 
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);

    }
    // end update data controller


}

