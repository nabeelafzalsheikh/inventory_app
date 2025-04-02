<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;

class SaleSeeder extends Seeder
{
    public function run()
    {
        // Create 20 sales
        Sale::factory()->count(20)->create()->each(function ($sale) {
            // For each sale, create 1-5 sale items
            $itemsCount = rand(1, 5);
            $grandTotal = 0;
            
            $items = SaleItem::factory()->count($itemsCount)->make([
                'sale_id' => $sale->id
            ]);
            
            foreach ($items as $item) {
                $grandTotal += $item->total_price;
                $item->save();
            }
            
            // Update the sale's grand total
            $sale->grand_total = $grandTotal;
            $sale->save();
        });
    }
}