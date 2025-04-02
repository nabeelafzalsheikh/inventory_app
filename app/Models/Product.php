<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'price',
        'brand_id',
        'pieces',
        'description',
        'status',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function getStockQuantityAttribute()
    {
        return $this->purchases()->sum('quantity');
    }

    public function getStockValueAttribute()
    {
        return $this->purchases()->sum('total_price');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }
}