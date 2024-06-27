<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'brand_id', 'name', 'slug', 'description', 'price', 'image', 'is_active', 'is_featured', 'in_stock', 'on_sale'];

    protected $casts = [
        'image' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->image)) {
                $product->image = ['https://placehold.co/600x400?text=' . urlencode($product->name)];
            }
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

}
