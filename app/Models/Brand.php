<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
      protected $fillable = [
        'name',
        'slug',
        'description',
        'url',
        'primary_color',
        'is_visible',
    ];


     protected $casts = [
        'is_visible' => 'boolean',
    ];


     public function products()
    {
        return $this->hasMany(Product::class);
    }
}
