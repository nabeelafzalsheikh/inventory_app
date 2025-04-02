<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Purchase;
use App\Models\Product;
use Carbon\Carbon;

class SalesAnalysisController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters or use current month/year
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        // Calculate date range
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        // Get sales data for the period
        $sales = SaleItem::with(['product.category', 'sale'])
            ->whereHas('sale', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();
            
        // Get purchases for the period
        $purchases = Purchase::with('product')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
            
        // Calculate summary statistics
        $totalPurchasePrice = $purchases->sum('total_price');
        $totalSalePrice = $sales->sum('total_price');
        $totalAmountPayable = $purchases->sum('remaining_balance');
        $totalSoldItems = $sales->sum('quantity');
        
        // Calculate remaining items
        $remainingItems = Product::sum('pieces') - $totalSoldItems;
        
        $totalRevenueWithoutPayable = $totalSalePrice;
        $totalRevenueWithPayable = $totalSalePrice - $totalAmountPayable;
        
        // Prepare data for charts
        $pieChartData = [
            'labels' => ['Total Purchase Price', 'Total Sale Price', 'Total Revenue Without Payable'],
            'data' => [$totalPurchasePrice, $totalSalePrice, $totalRevenueWithoutPayable]
        ];
        
        // Get monthly sales data for the year
        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthStart = Carbon::create($year, $i, 1)->startOfMonth();
            $monthEnd = Carbon::create($year, $i, 1)->endOfMonth();
            
            $monthlySales[$i] = SaleItem::whereHas('sale', function($query) use ($monthStart, $monthEnd) {
                $query->whereBetween('created_at', [$monthStart, $monthEnd]);
            })->sum('total_price');
        }
        
        $lineChartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => array_values($monthlySales)
        ];
        
        // Prepare table data
        $tableData = [];
        foreach ($sales as $index => $sale) {
            $product = $sale->product;
            $purchase = $product->purchases->first(); // Simplified - in real app you'd need more complex logic
            
            $tableData[] = [
                'id' => $index + 1,
                'date' => $sale->created_at->format('Y-m-d'),
                'product' => $product->name,
                'sku' => $product->sku,
                'category' => $product->category->name ?? 'N/A',
                'purchase_price' => $purchase ? $purchase->unit_price : 0,
                'sale_price' => $sale->unit_price,
                'amount_payable' => $purchase ? $purchase->remaining_balance : 0,
                'sold_items' => $sale->quantity,
                'remaining_items' => $product->pieces - $sale->quantity,
                'revenue_without_payable' => $sale->total_price,
                'revenue_with_payable' => $sale->total_price - ($purchase ? $purchase->remaining_balance : 0),
                'status' => 'Completed' // Simplified
            ];
        }
        
        return view('admin.report.sales', [
            'month' => $month,
            'year' => $year,
            'totalPurchasePrice' => $totalPurchasePrice,
            'totalSalePrice' => $totalSalePrice,
            'totalAmountPayable' => $totalAmountPayable,
            'totalSoldItems' => $totalSoldItems,
            'remainingItems' => $remainingItems,
            'totalRevenueWithoutPayable' => $totalRevenueWithoutPayable,
            'totalRevenueWithPayable' => $totalRevenueWithPayable,
            'pieChartData' => $pieChartData,
            'lineChartData' => $lineChartData,
            'tableData' => $tableData
        ]);
    }
}