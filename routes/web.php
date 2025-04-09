<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\SalesAnalysisController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function() {
   return redirect()->route('admin.dashboard');
})->middleware('admin.auth');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';


Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin.auth')->group(function () {
        // Route::get('dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('admin.dashboard');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('suppliers', SupplierController::class);        
        Route::resource('purchases', PurchaseController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
        Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
        Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
        Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
        Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
        Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
        Route::get('/stocks/{product}', [StockController::class, 'show'])->name('stocks.details');
        Route::get('/report/sales', [SalesAnalysisController::class, 'index'])->name('report.sales');
        Route::get('/report/purchases', [PurchaseReportController::class, 'index'])->name('purchases.report');
        Route::get('/messages/unread-count', function() {
            return response()->json([
                'count' => auth()->guard('admin')->user()->unreadMessages()->count()
            ]);
        })->middleware('admin.auth')->name('messages.unread-count');
    
    });
});

Route::middleware(['admin.auth'])->group(function () {
    Route::resource('admin/admins', AdminController::class)->except(['show']);
});

Route::middleware(['admin.auth'])->group(function() {
    Route::resource('admin/messages', MessageController::class)->except(['edit', 'update']);
});

Route::middleware(['admin.auth'])->group(function () {
    Route::prefix('admin/trash')->group(function () {
        Route::get('/', [TrashController::class, 'index'])->name('trash.index');
        Route::post('/restore/{model}/{id}', [TrashController::class, 'restore'])->name('trash.restore');
        Route::delete('/force-delete/{model}/{id}', [TrashController::class, 'forceDelete'])->name('trash.forceDelete');
    });
});




