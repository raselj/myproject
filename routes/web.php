<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Childcontroller;
use App\Http\Controllers\Admin\Brandcontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => ['api']], function () {
//     // Routes in this group will use the 'api' middleware group
//     Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminview'])->name('admin.dashboard');
//  });

 Route::group(['namespace'=> 'App\Http\Controllers\Admincontroller', 'middleware'=>'IsAdmin'], function(){
    Route::get('/admin/home', [App\Http\Controllers\Admincontroller::class, 'adminview'])->name('admin.dashboard');
    Route::get('/admin/logout', [App\Http\Controllers\Admincontroller::class, 'logout'])->name('admin.logout');
    Route::get('/password/change', [App\Http\Controllers\Admincontroller::class, 'passwordChange'])->name('password.change');
    Route::post('/pass/reset', [App\Http\Controllers\Admincontroller::class, 'passwordUpdate'])->name('pass.reset');
    // category route here

    Route::group(['prefix'=>'category'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Categorycontroller::class, 'category'])->name('category.index');
        Route::post('/store', [App\Http\Controllers\Admin\Categorycontroller::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\Categorycontroller::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Categorycontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Categorycontroller::class, 'update'])->name('category.update');
    
    });

    // Global Route here
    Route::get('/get-child-category/{id}', [App\Http\Controllers\Admin\Categorycontroller::class, 'getchild']);


    // subcategory route here

    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Subcategorycontroller::class, 'subcategory'])->name('subcategory.index');
        Route::post('/store', [App\Http\Controllers\Admin\Subcategorycontroller::class, 'substore'])->name('subcategory.store');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\Subcategorycontroller::class, 'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Subcategorycontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Subcategorycontroller::class, 'update'])->name('subcategory.update');
    
    });

    // childcategory route here

    Route::group(['prefix'=>'childcategory'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Childcontroller::class, 'index'])->name('childcategory.index');
        Route::post('/store', [App\Http\Controllers\Admin\Childcontroller::class,'substore'])->name('childcategory.store');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\Childcontroller::class, 'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Childcontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Childcontroller::class, 'update'])->name('childcategory.update');
    
    });

    // brand route here

    Route::group(['prefix'=>'brand'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Brandcontroller::class, 'index'])->name('brand.index');
        Route::post('/store', [App\Http\Controllers\Admin\Brandcontroller::class,'bstore'])->name('brand.store');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\Brandcontroller::class, 'destroy'])->name('brand.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Brandcontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Brandcontroller::class, 'update'])->name('brand.update');
    
    });

    // warehouse route here

    Route::group(['prefix'=>'warehouse'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Warehousecontroller::class, 'index'])->name('warehouse.index');
        Route::post('/store', [App\Http\Controllers\Admin\Warehousecontroller::class,'store'])->name('warehouse.store');
        Route::get('/delete/{id}', [App\Http\Controllers\Admin\Warehousecontroller::class, 'delete'])->name('warehouse.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Warehousecontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Warehousecontroller::class, 'update'])->name('warehouse.update');
    
    });  

    // product route here

    Route::group(['prefix'=>'product'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Productcontroller::class, 'index'])->name('product.index');
        Route::post('/store', [App\Http\Controllers\Admin\Productcontroller::class,'store'])->name('product.store');
        // Route::get('/delete/{id}', [App\Http\Controllers\Admin\Warehousecontroller::class, 'delete'])->name('warehouse.delete');
        // Route::get('/edit/{id}', [App\Http\Controllers\Admin\Warehousecontroller::class, 'edit']);
        // Route::put('/update', [App\Http\Controllers\Admin\Warehousecontroller::class, 'update'])->name('warehouse.update');
    
    });

    // Offer Coupon Route here

    Route::group(['prefix'=>'coupons'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Couponcontroller::class, 'index'])->name('coupon.index');
        Route::post('/store', [App\Http\Controllers\Admin\Couponcontroller::class,'cstore'])->name('coupon.store');
        Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Couponcontroller::class, 'cdelete'])->name('coupon.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Couponcontroller::class, 'edit']);
        Route::put('/update', [App\Http\Controllers\Admin\Couponcontroller::class, 'update'])->name('coupon.update');
    
    });  

    // pickup point Route here

    Route::group(['prefix'=>'pickups'], function(){
        Route::get('/', [App\Http\Controllers\Admin\Pickupcontroller::class, 'index'])->name('pickup_point.index');
        Route::post('/store', [App\Http\Controllers\Admin\Pickupcontroller::class,'pstore'])->name('pickup_point.store');
        Route::delete('/delete/{id}', [App\Http\Controllers\Admin\Pickupcontroller::class, 'pdelete'])->name('pickup.delete');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\Pickupcontroller::class, 'cedit']);
        Route::put('/update', [App\Http\Controllers\Admin\Pickupcontroller::class, 'update'])->name('pickup_point.update');
    
    });

    // setting route here

    Route::group(['prefix'=>'setting'], function(){

        // seo setting view
        Route::group(['prefix'=>'brand'], function(){
            Route::get('/', [App\Http\Controllers\Admin\settingController::class, 'seo'])->name('seo.setting');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\settingController::class, 'updateseo'])->name('seo.setting.update');
        });

        // smtp setting view
        Route::group(['prefix'=>'smtp'], function(){
            Route::get('/', [App\Http\Controllers\Admin\settingController::class, 'smtp'])->name('smtp.setting');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\settingController::class, 'updatesmtp'])->name('smtp.setting.update');
        });

        // page setting here
        Route::group(['prefix'=>'pages'], function(){
            Route::get('/', [App\Http\Controllers\Admin\pagecontroller::class, 'indexpage'])->name('page.setting');
            Route::get('/create', [App\Http\Controllers\Admin\pagecontroller::class, 'createpage'])->name('pagecreate.setting');
            Route::post('/store', [App\Http\Controllers\Admin\pagecontroller::class, 'storepage'])->name('pagestore.setting');
            Route::get('/delete/{id}', [App\Http\Controllers\Admin\pagecontroller::class, 'deletepage'])->name('pagedelete.setting');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\pagecontroller::class, 'editpage'])->name('pageedit.setting');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\pagecontroller::class, 'updatepage'])->name('pageupdate.setting');
        });

        // website setting view
        Route::group(['prefix'=>'website'], function(){
            Route::get('/', [App\Http\Controllers\Admin\settingController::class, 'website'])->name('website.setting');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\settingController::class, 'websupdate'])->name('websupdate.setting');
    
        });
        
    });




});