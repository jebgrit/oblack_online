<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    // protected $casts = [
    //     'product_color' => 'array',
    //     'product_size' => 'array',
    // ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }


    /**
     * one to Many.
     */
    public function images()
    {
        return $this->hasMany(MultiImg::class, 'product_id', 'id');
    }
}
