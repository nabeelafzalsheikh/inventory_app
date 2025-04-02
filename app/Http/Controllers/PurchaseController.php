<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['product', 'supplier'])->latest()->paginate(10);
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchases.create', compact('products', 'suppliers'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $data = $request->validated();
        $data['total_price'] = $data['quantity'] * $data['unit_price'];
        $data['remaining_balance'] = $data['total_price'] - $data['amount_paid'];
        
        $purchase = Purchase::create($data);
        $this->increaseStock($purchase->product_id, $purchase->quantity, $purchase->unit_price);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase created successfully.');
    }

    private function increaseStock($productId, $quantity, $unitPrice)
    {
        $stock = Stock::firstOrCreate(['product_id' => $productId]);
    
        $stock->quantity += $quantity;
        $stock->total_stock_value += ($quantity * $unitPrice);
    
        $stock->save();
    }


    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchases.edit', compact('purchase', 'products', 'suppliers'));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $data = $request->validated();
        $data['total_price'] = $data['quantity'] * $data['unit_price'];
        $data['remaining_balance'] = $data['total_price'] - $data['amount_paid'];
        
        $purchase->update($data);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }
}