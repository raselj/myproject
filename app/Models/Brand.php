<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brandcontroller;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'brand_slug',
        'brand_logo',
    ];
}
