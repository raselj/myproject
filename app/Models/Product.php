<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brandcontroller;
use App\Models\Pickuppoint;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ['category_id','subcategory_id','childcategory_id','brand_id','name','code','unit','tags','video','purchaes_price','selling_price','discount_price','stock_quantity','warehouse','description','thumbnail','images','featured','today_deal','status','flash_deal_id','cash_on_delivery','admin_id'];
     
    public function Category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function Childcategory(){
        return $this->belongsTo(Childcategory::class, 'childcategory_id');
    }

    public function Brand(){
        return $this->belongsTo(Brandcontroller::class, 'brand_id');
    }

    public function Pickuppoint(){
        return $this->belongsTo(Pickuppoint::class, 'pickup_point_id');
    }

}

    