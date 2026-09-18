<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
|
| Semua route di bagian ini dapat diakses tanpa login.
|
*/


// ==========================================================================
// HALAMAN UTAMA USER
// ==========================================================================

Route::get('/', [
    OrderController::class,
    'track',
])->name('user.order');


// ==========================================================================
// BUAT PESANAN USER
// ==========================================================================
//
// User dapat membuat pesanan tanpa login.
//

Route::post('/order', [
    OrderController::class,
    'storePublic',
])->name('user.order.store');


// ==========================================================================
// TRACKING PESANAN
// ==========================================================================

// Halaman tracking
Route::get('/track', [
    OrderController::class,
    'track',
])->name('track');


// Data pesanan untuk realtime tracking / AJAX polling
Route::get('/track/{order}', [
    OrderController::class,
    'trackingData',
])->name('track.data');


/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
|
| Login dan logout khusus administrator.
|
*/


// ==========================================================================
// LOGIN ADMIN
// ==========================================================================

Route::get('/admin/login', [
    AdminAuthController::class,
    'showLogin',
])->name('admin.login');


// Proses login admin
Route::post('/admin/login', [
    AdminAuthController::class,
    'login',
])->name('admin.login.submit');


// ==========================================================================
// DEFAULT LOGIN ROUTE
// ==========================================================================
//
// Middleware "auth" Laravel akan mencari route bernama "login"
// ketika seseorang mencoba membuka halaman admin tanpa login.
//
// Kita arahkan ke halaman login admin.
//

Route::get('/login', function () {

    return redirect()->route('admin.login');

})->name('login');


// ==========================================================================
// LOGOUT ADMIN
// ==========================================================================

Route::post('/admin/logout', [
    AdminAuthController::class,
    'logout',
])
    ->middleware('auth')
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
|
| Semua route di bawah ini WAJIB login.
|
*/


Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        // ==================================================================
        // DASHBOARD ADMIN
        // ==================================================================

        Route::get('/', [
            OrderController::class,
            'index',
        ])->name('orders.index');


        // ==================================================================
        // CREATE ORDER - ADMIN
        // ==================================================================

        // Form tambah pesanan
        Route::get('/orders/create', [
            OrderController::class,
            'create',
        ])->name('orders.create');


        // Simpan pesanan dari admin
        Route::post('/orders', [
            OrderController::class,
            'store',
        ])->name('orders.store');


        // ==================================================================
        // EDIT ORDER
        // ==================================================================

        // Form edit pesanan
        Route::get('/orders/{order}/edit', [
            OrderController::class,
            'edit',
        ])->name('orders.edit');


        // Simpan perubahan pesanan
        Route::put('/orders/{order}', [
            OrderController::class,
            'update',
        ])->name('orders.update');


        // ==================================================================
        // UPDATE STATUS ORDER
        // ==================================================================

        Route::patch('/orders/{order}/status', [
            OrderController::class,
            'updateStatus',
        ])->name('orders.status');


        // ==================================================================
        // ARCHIVE / DELETE ORDER
        // ==================================================================

        Route::delete('/orders/{order}', [
            OrderController::class,
            'destroy',
        ])->name('orders.destroy');


        // ==================================================================
        // RECEIPT / NOTA
        // ==================================================================

        Route::get('/orders/{order}/receipt', [
            OrderController::class,
            'receipt',
        ])->name('orders.receipt');

    });