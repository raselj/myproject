<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Productcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // start product index controller
    public function index(){
        $category = DB::table('categories')->get();
        $childcategory = DB::table('childcategories')->get();
        $brand = DB::table('brands')->get();
        $pickuppoint = DB::table('pickupcontroller')->get();
        $warehouse = DB::table('warehouse')->get();
        
        return view('admin.product.create', compact('category','childcategory', 'brand', 'warehouse', 'pickuppoint'));
    }
    // end product index controller

    // start product store controller
    public function store(Request $request){
        dd($request->all());
    }








}
