<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class pagecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // view page
    public function indexpage(){
        $page = DB::table('pages')->latest()->get();
        return view('admin.setting.pages.index', compact('page'));
    }

    // view create page 
    public function createpage(){
        return view('admin.setting.pages.create');
    }

    // view store page
    public function storepage(Request $request){
        
        $data = array();

        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name, '-');
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;

        DB::table('pages')->insert($data);
        $notification = array(
            'message' => 'Page Created Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    // destroy page
    public function deletepage($id){
        DB::table('pages')->where('id',$id)->delete();
        $notification = array(
            'message' => 'Page Deleted Successfully!',
            'alert-type' => 'error',
        );

        return redirect()->back()->with($notification);
    }

    // edit page 
    public function editpage($id){
        $page = DB::table('pages')->where('id',$id)->first();
        return view('admin.setting.pages.edit',compact('page'));
    }

    // update page
    public function updatepage(Request $request,$id){
        $page = array();
        $page['page_position'] = $request->page_position;
        $page['page_name'] = $request->page_name;
        $page['page_slug'] = Str::slug($request->page_name);
        $page['page_title'] = $request->page_title;
        $page['page_description'] = $request->page_description;

        DB::table('pages')->where('id', $id)->update($page);

        $notification = array(
            'message' => 'Page updated successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }



}
