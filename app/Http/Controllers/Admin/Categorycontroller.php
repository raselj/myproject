<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;

class Categorycontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // category view

    public function category(){
    
        $data = Category::all();
        return view('admin.category.category.index', compact('data'));
        
    }

    // category store

    public function store(Request $request){

        $validated = $request->validate([
            'category_name'=>'required|unique:categories|max:55',
        ]);

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_slug'] =Str::slug($request->category_name, '-');
        // DB::table('categories')->insert($data);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ]);
        $notification = array(
            'message' => 'Category inserted successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // delete category

    public function destroy($id){
    
        $category = Category::find($id);
        $category->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // category edit

    public function edit($id){
    
        $data = Category::find($id);
        return response()->json($data);        
    }

    // category update

    public function update(Request $request){

        
         $data = [
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name, '-')
        ];
        
        DB::table('categories')->where('id', $request->id)->update($data);
        
        $notification = array(
            'message' => 'Category updated!', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }

    //getchild category controller***
    public function getchild($id){
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }



}
