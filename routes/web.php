<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
Route::get('storage-link',function(){
    Artisan::call('storage:link');
    return response()->json(['message' => 'Storage Link Successfully']);
});
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('auth.profile');
    Route::get('/changepassword', [App\Http\Controllers\UserController::class, 'changepassword'])->name('auth.changepassword');

    Route::group(['middleware' => ['can:manage user']], function () {
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::get('/users/{user_id}/customers/create', [App\Http\Controllers\UserCustomerController::class, 'create'])->name('users.customers.create');
    });

    Route::group(['middleware' => ['can:manage brand']], function () {
        Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/create', [App\Http\Controllers\BrandController::class, 'create'])->name('brands.create');
        Route::get('/brands/{id}', [App\Http\Controllers\BrandController::class, 'show'])->name('brands.show');
        Route::get('/brands/{id}/edit', [App\Http\Controllers\BrandController::class, 'edit'])->name('brands.edit');
    });

    Route::group(['middleware' => ['can:manage zone']], function () {
        Route::get('/zones', [App\Http\Controllers\ZoneController::class, 'index'])->name('zones.index');
        Route::get('/zones/create', [App\Http\Controllers\ZoneController::class, 'create'])->name('zones.create');
        Route::get('/zones/{id}', [App\Http\Controllers\ZoneController::class, 'show'])->name('zones.show');
        Route::get('/zones/{id}/edit', [App\Http\Controllers\ZoneController::class, 'edit'])->name('zones.edit');
    
        Route::get('/zones/{zone_id}/products/{id}/edit', [App\Http\Controllers\ZonePriceController::class, 'edit'])->name('zones.products.edit');
    });

    
    Route::group(['middleware' => ['can:manage shipment']], function () {
        Route::get('/shipments', [App\Http\Controllers\ShipmentController::class, 'index'])->name('shipments.index');
        Route::get('/shipments/create', [App\Http\Controllers\ShipmentController::class, 'create'])->name('shipments.create');
        Route::get('/shipments/{id}', [App\Http\Controllers\ShipmentController::class, 'show'])->name('shipments.show');
        Route::get('/shipments/{id}/edit', [App\Http\Controllers\ShipmentController::class, 'edit'])->name('shipments.edit');

        
        Route::get('/shipments/{shipment_id}/details/create', [App\Http\Controllers\ShipmentDetailController::class, 'create'])->name('shipments.details.create');
        Route::get('/shipments/{shipment_id}/details/{id}/edit', [App\Http\Controllers\ShipmentDetailController::class, 'edit'])->name('shipments.details.edit');
    });
    
    Route::group(['middleware' => ['can:manage uom']], function () {
        Route::get('/uoms', [App\Http\Controllers\UomController::class, 'index'])->name('uoms.index');
        Route::get('/uoms/create', [App\Http\Controllers\UomController::class, 'create'])->name('uoms.create');
        Route::get('/uoms/{id}', [App\Http\Controllers\UomController::class, 'show'])->name('uoms.show');
        Route::get('/uoms/{id}/edit', [App\Http\Controllers\UomController::class, 'edit'])->name('uoms.edit');
    });

    Route::group(['middleware' => ['can:manage category']], function () {
        Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    });

    
    Route::group(['middleware' => ['can:manage product']], function () {
        Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
        Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    });

    
    Route::group(['middleware' => ['can:read customer']], function () {
        Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
        Route::group(['middleware' => ['can:manage customer']], function () {
            Route::get('/customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
            Route::get('/customers/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
        });
        Route::group(['middleware' => ['can:manage self customerproduct']], function () {
            Route::get('/customers/{customer_id}/products/{id}/edit', [App\Http\Controllers\CustomerProductController::class, 'edit'])->name('customers.products.edit');
        });
        Route::get('/customers/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customers.show');


    });

    
    Route::group(['middleware' => ['can:manage forecast']], function () {
        Route::get('/forecasts', [App\Http\Controllers\ForecastController::class, 'index'])->name('forecasts.index');
        Route::get('/forecasts/create', [App\Http\Controllers\ForecastController::class, 'create'])->name('forecasts.create');
        Route::get('/forecasts/{id}', [App\Http\Controllers\ForecastController::class, 'show'])->name('forecasts.show');

        Route::get('/forecasts/{forecast_id}/details/{id}/edit', [App\Http\Controllers\ForecastDetailController::class, 'edit'])->name('forecasts.details.edit');

    });
    
    
    Route::group(['middleware' => ['permission:read cmo|manage cmo']], function () {
        Route::get('/cmos', [App\Http\Controllers\CmoController::class, 'index'])->name('cmos.index');
        Route::get('/cmos/{id}', [App\Http\Controllers\CmoController::class, 'show'])->name('cmos.show');
    });
    
    Route::group(['middleware' => ['permission:manage reportsales']], function () {
        Route::get('/reportsales', [App\Http\Controllers\ReportSalesController::class, 'index'])->name('reportsales.index');
        Route::get('/reportsales/create', [App\Http\Controllers\ReportSalesController::class, 'create'])->name('reportsales.create');
        Route::get('/reportsales/{id}', [App\Http\Controllers\ReportSalesController::class, 'show'])->name('reportsales.show');
        Route::get('/summaries/sales', [App\Http\Controllers\SummaryController::class, 'sales'])->name('summaries.sales');
    
        Route::get('/reportsalechecks/sales', [App\Http\Controllers\ReportSaleCheckController::class, 'sales'])->name('reportsalechecks.sales');
    });
    
    Route::group(['middleware' => ['permission:manage reportinventorylevel']], function () {
        Route::get('/reportinventories', [App\Http\Controllers\ReportInventoryController::class, 'index'])->name('reportinventories.index');
        Route::get('/reportinventories/create', [App\Http\Controllers\ReportInventoryController::class, 'create'])->name('reportinventories.create');
        Route::get('/reportinventories/{id}', [App\Http\Controllers\ReportInventoryController::class, 'show'])->name('reportinventories.show');
    });
    
    Route::group(['middleware' => ['permission:manage reportdeliveryplan']], function () {
        Route::get('/reportdeliveryplans', [App\Http\Controllers\ReportDeliveryPlanController::class, 'index'])->name('reportdeliveryplans.index');
        Route::get('/reportdeliveryplans/create', [App\Http\Controllers\ReportDeliveryPlanController::class, 'create'])->name('reportdeliveryplans.create');
        Route::get('/reportdeliveryplans/{id}', [App\Http\Controllers\ReportDeliveryPlanController::class, 'show'])->name('reportdeliveryplans.show');
    });
        

    

    // Route::group(['middleware' => ['can:manage user']], function () {
    //     Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    // });
});
