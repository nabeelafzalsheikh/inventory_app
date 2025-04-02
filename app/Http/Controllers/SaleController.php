<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSaleRequest;

class SaleController extends Controller
{

    public function index(Request $request)
{
    $query = Sale::with('items')->latest();

    // Search functionality
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('invoice_number', 'like', "%{$search}%")
              ->orWhere('customer_name', 'like', "%{$search}%")
              ->orWhere('customer_phone', 'like', "%{$search}%");
        });
    }

    // Date filtering
    if ($request->has('date_from') && $request->has('date_to')) {
        $query->whereBetween('created_at', [
            $request->input('date_from') . ' 00:00:00',
            $request->input('date_to') . ' 23:59:59'
        ]);
    }

    $sales = $query->paginate(15);

    return view('admin.sales.index', compact('sales'));
}

    public function create()
    {
        $products = Product::all();
        return view('admin.sales.create', compact('products'));
    }

    public function store(StoreSaleRequest $request)
    {
        $data = $request->validated();
        
        // Calculate grand total
        $grandTotal = collect($data['items'])->sum('total_price');
        
        // Create sale
        $sale = Sale::create([
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'grand_total' => $grandTotal
        ]);
        
        // Create sale items
        foreach ($data['items'] as $item) {
            $sale->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price']
            ]);

            $this->reduceStock($item['product_id'], $item['quantity']);
        }
        
        return redirect()->route('sales.show', $sale)
            ->with('success', 'Sale completed successfully!');
    }

    private function reduceStock($productId, $quantity)
    {
        $stock = Stock::where('product_id', $productId)->first();
    
        if ($stock && $stock->quantity >= $quantity) {
            $stock->quantity -= $quantity;
            $stock->total_stock_value -= ($stock->total_stock_value / max($stock->quantity + $quantity, 1)) * $quantity;
    
            $stock->save();
        } else {
            throw new \Exception("Not enough stock available for product ID: $productId");
        }
    }

    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
{
    $sale->delete();
    return redirect()->route('sales.index')
        ->with('success', 'Sale deleted successfully');
}
}