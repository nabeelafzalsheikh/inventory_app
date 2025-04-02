<?php

namespace Database\Factories;

use DB;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        $quantity = $this->faker->numberBetween(10, 100);
        $unitPrice = $this->faker->randomFloat(2, 5, 50);
        $totalPrice = $quantity * $unitPrice;
        $amountPaid = $this->faker->randomFloat(2, 0, $totalPrice);

        return [
            'product_id' => Product::factory(),
            'supplier_id' => \App\Models\Supplier::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
            'amount_paid' => $amountPaid,
            'remaining_balance' => $totalPrice - $amountPaid,
            'lot_number' => $this->faker->bothify('LOT-#####'),
            'expiry_date' => $this->faker->dateTimeBetween('+1 month', '+2 years'),
            'notes' => $this->faker->sentence,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Purchase $purchase) {
            // Increase stock
        
            // Update or create stock record    
            Stock::updateOrCreate(
                ['product_id' => $purchase->product_id],
                [
                    'quantity' => DB::raw("quantity + {$purchase->quantity}"),
                    'total_stock_value' => \DB::raw("total_stock_value + ({$purchase->quantity} * {$purchase->unit_price})"),
                ]
            );
        });
    }
}
