<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;

class PurchaseReportController extends Controller
{
    public function index(Request $request)
    {
        // Get filter values from request
        $productId = $request->input('product');
        $supplierId = $request->input('supplier');
        $date = $request->input('date');

        // Base query with relationships
        $query = Purchase::with(['product', 'supplier'])
                    ->orderBy('created_at', 'desc');

        // Apply filters
        if ($productId) {
            $query->where('product_id', $productId);
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        // Get all products and suppliers for dropdowns
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        // Get filtered purchases
        $purchases = $query->paginate(10);

        return view('admin.report.purchases', compact('purchases', 'products', 'suppliers'));
    }
}