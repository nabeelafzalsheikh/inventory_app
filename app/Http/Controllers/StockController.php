<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
    
    $stocks = Stock::with('product')->get();
    return view('admin.stocks.index', compact('stocks'));
       
    }



public function show($stock)
{
    $stock=Stock::with('product')->find($stock);
    if ($stock) {
        $product=Product::find($stock->product_id);
        $purchases = $product->purchases()
        ->with('supplier')
        ->orderBy('expiry_date', 'asc')
        ->get();

        return view('admin.stocks.details', compact('stock', 'purchases'));
    } else {
        abort(404);

}
}

}
