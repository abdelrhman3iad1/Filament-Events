<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'brand_id',
        'image',
        'quantity',
        'price',
        'is_visible',
        'is_featured',
        'type',
        'published_at',
    ];

    protected $casts = [
        'is_visible'=> 'boolean',
        'is_featured'=> 'boolean',
    ] ;

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

}
