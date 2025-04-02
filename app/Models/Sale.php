<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_phone',
        'grand_total'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $sale->invoice_number = 'INV-' . str_pad(Sale::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}