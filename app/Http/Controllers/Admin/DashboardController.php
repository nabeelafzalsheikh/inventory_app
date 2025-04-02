<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $stockData = Stock::selectRaw("
        COALESCE(SUM(total_stock_value), 0) as totalStockValue,
        COUNT(CASE WHEN quantity = 0 THEN 1 END) as outOfStock,
        COUNT(CASE WHEN quantity < 5 THEN 1 END) as lowStock
    ")->first();
    
    $salesData = Sale::whereDate('created_at', Carbon::today())->sum('grand_total');
    $monthlySales = Sale::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->sum('grand_total');
    $data = [
        'totalProducts' => Product::count(),
        'totalStockValue' => $stockData->totalStockValue,
        'outOfStock' => $stockData->outOfStock,
        'lowStock' => $stockData->lowStock,
        'totalSaleToday' => $salesData,
        'amountPayable' => Purchase::sum('remaining_balance'),
        'todayRevenue' => $salesData,
        'monthlyRevenue' => $monthlySales,
        'monthlySalesData' => $this->getMonthlySalesData(),
    ];
        return view('admin.dashboard', $data);
    }

    protected function getMonthlySalesData()
    {
        $salesData = [];
        $months = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths(11)->addMonths($i);
            $months[] = $date->format('M');
            
            $salesData[] = Sale::whereMonth('created_at', $date->month)
                              ->whereYear('created_at', $date->year)
                              ->sum('grand_total');
        }
        
        return [
            'labels' => $months,
            'data' => $salesData,
        ];
    }
}