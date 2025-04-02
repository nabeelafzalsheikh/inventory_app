<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Admin;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $trashedProducts = Product::onlyTrashed()->get();
        $trashedCategories = Category::onlyTrashed()->get();
        $trashedBrands = Brand::onlyTrashed()->get();
         $trashedAdmins = Admin::onlyTrashed()->get();
        $trashedSuppliers = Supplier::onlyTrashed()->get();
        $trashedPurchases = Purchase::onlyTrashed()->get();
        $trashedSales = Sale::onlyTrashed()->get();
        $trashedSaleItems = SaleItem::onlyTrashed()->get();

        return view('admin.trash.index', compact(
            'trashedProducts',
            'trashedCategories',
            'trashedBrands',
            'trashedAdmins',
            'trashedSuppliers',
            'trashedPurchases',
            'trashedSales',
            'trashedSaleItems'
        ));
    }

    public function restore($model, $id)
    {
        $model = "App\\Models\\" . $model;
        
        $item = $model::onlyTrashed()->findOrFail($id);
        $item->restore();

        return redirect()->route('trash.index')->with('success', 'Item restored successfully.');
    }

    public function forceDelete($model, $id)
    {
        $model = "App\\Models\\" . $model;
        
        $item = $model::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        return redirect()->route('trash.index')->with('success', 'Item permanently deleted.');
    }
}