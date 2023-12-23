<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // seo setting controller

    public function seo(){ 
        $data = DB::table('createseotable')->first();
        return view('admin.setting.seo', compact('data'));
    }

    public function updateseo(Request $request, $id){
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['google_verification'] = $request->google_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_adsense'] = $request->google_adsense;
        
        DB::table('createseotable')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Seo Data Updated Successfully!',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);

    }

    // smtp setting controller

    public function smtp(){
        $data = DB::table('smtptable')->first();
        return view('admin.setting.smtp', compact('data'));
    }

    public function updatesmtp(Request $request, $id){

        $data = array();
        $data['mailer'] = $request->mailer;
        $data['host'] = $request->host;
        $data['port'] = $request->port;
        $data['user_name'] = $request->user_name;
        $data['password'] = $request->password;

        DB::table('smtptable')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'SMTP Data Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    // website setting view controller

    public function website(){
        $setting = DB::table('settings')->first();
        return view('admin.setting.website_setting', compact('setting'));
    }

    //website setting update controller

    public function websupdate(Request $request, $id){
        $data = array();
        $data['currency'] = $request->currency;
        $data['phoneone'] = $request->phoneone;
        $data['phonetwo'] = $request->phonetwo;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['logo'] = $request->logo;
        $data['favicon'] = $request->favicon;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;

        // setting logo
        if($request->logo){
            $logo = $request->logo;
            $logo_name = uniqid().'.'.$logo->getClientOriginalExtension();
            $logo->move('public/settingimg/', $logo_name);
            $data['logo'] = 'public/settingimg/'.$logo_name;
        }else{
            $data['logo'] = $request->old_logo;
        }
        
         // setting favicon
         if($request->favicon){
            $favicon = $request->favicon;
            $favicon_name = uniqid().'.'.$favicon->getClientOriginalExtension();
            $favicon->move('public/settingimg/',$favicon_name);
            $data['favicon'] = 'public/settingimg/'.$favicon_name;
        }else{
            $data['favicon'] = $request->old_favicon;
        }
        
        DB::table('settings')->where('id', $id)->update($data);
        
        $notification = array(
            'message' => 'Data setting updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }


}
