<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SaleItem;

class SaleItemFactory extends Factory
{
    protected $model = SaleItem::class;
    public function definition()
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $unitPrice = $this->faker->randomFloat(2, 10, 500);
        $totalPrice = $quantity * $unitPrice;

        return [
            'sale_id' => \App\Models\Sale::factory(),
            'product_id' => \App\Models\Product::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $totalPrice,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (SaleItem $saleItem) {
            // Decrease stock
            Stock::where('product_id', $saleItem->product_id)
                ->where('quantity', '>=', $saleItem->quantity)
                ->decrement('quantity', $saleItem->quantity);

            // Optional: Update stock value
            Stock::where('product_id', $saleItem->product_id)
                ->decrement('total_stock_value', $saleItem->quantity * $saleItem->unit_price);
        });
    }
}