<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class Subcategorycontroller extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // sub category view
    public function subcategory(){
        // $data = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')
        //    ->select('subcategories.*', 'categories.category_name')->get();
        
        $category = Category::all();
        $subcategory = Subcategory::all();

        return view('admin.category.subcategory.index', compact('category', 'subcategory'));
    }

    // sub category store

    public function substore(Request $request){

        $validated = $request->validate([
            'subcategory_name' => 'required|max:55',
        ]);

        // $array = array();
        // $data['category_id'] = $request->category_id;
        // $data['subcategory_name'] = $request->subcategory_name;
        // $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');
        // DB::table('subcategories')->insert($data);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name, '-')
        ]);

        $notification = array(
            'message' => 'SubCategory inserted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // destroy sub category

    public function destroy($id){

        $subcat = Subcategory::find($id);
        $subcat->delete();

        $notification = array(
            'message' => 'SubCategory Deleted!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // category edit

    public function edit($id){
    
        $data = Subcategory::find($id);
        $category = DB::table('categories')->get();
        
        return view('admin.category.subcategory.edit', compact('data', 'category'));
    }


    //update category 

    public function update(Request $request){
       
        $data = [
            'id' => $request->id,
            'subcategory_name' => $request->subcategory_name,
            'subcat_slug' => Str::slug($request->subcategory_name, '-')
        ];
        
        DB::table('subcategories')->where('id', $request->id)->update($data);

       $notification = array(
           'message' => 'SubCategory updated!', 
           'alert-type' => 'success'
       );
       return redirect()->back()->with($notification);
       
   }


}
