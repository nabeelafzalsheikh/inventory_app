<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'unit_price',
        'total_price',
        'amount_paid',
        'remaining_balance',
        'lot_number',
        'expiry_date',
        'notes'
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}