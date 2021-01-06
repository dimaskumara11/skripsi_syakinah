<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Data_Supplier;
use App\Http\Controllers\Hutang_Supplier;
use App\Http\Controllers\Laporan_PO;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Purchase_Order;
use App\Http\Controllers\Request_Order;
use App\Http\Controllers\Request_Product;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::prefix('login')->group(function () {
    Route::get('/', [Login::class, 'index'])->name("login");
    Route::post('post', [Login::class, 'post'])->name("login.post");
});

// Route::prefix('cpanel')->middleware(check_session_login::class)->group(function () {
Route::prefix('cpanel')->middleware(check_session_login::class)->group(function () {
    Route::get('logout', [Logout::class, 'index'])->name("cpanel.logout");
    Route::get('dashboard', [Dashboard::class, 'index'])->name("cpanel.dashboard");
    Route::prefix('data_supplier')->middleware(check_superadmin_divisi::class)->group(function () {
        Route::get('list', [Data_Supplier::class, 'list'])->name("cpanel.data_supplier");
        Route::get('form/{id?}', [Data_Supplier::class, 'form'])->name('cpanel.data_supplier.form');
        Route::get('delete/{id}', [Data_Supplier::class, 'delete'])->name('cpanel.data_supplier.delete');
        Route::post('insert', [Data_Supplier::class, 'insert'])->name('cpanel.data_supplier.insert');
        Route::post('update', [Data_Supplier::class, 'update'])->name('cpanel.data_supplier.update');
    });
    Route::prefix('request_order')->middleware(check_superadmin_divisi::class)->group(function () {
        Route::get('list', [Request_Order::class, 'list'])->name("cpanel.request_order");
        Route::get('form/{id?}', [Request_Order::class, 'form'])->name('cpanel.request_order.form');
        Route::get('delete/{id}', [Request_Order::class, 'delete'])->name('cpanel.request_order.delete');
        Route::post('insert', [Request_Order::class, 'insert'])->name('cpanel.request_order.insert');
        Route::post('update', [Request_Order::class, 'update'])->name('cpanel.request_order.update');
    });
    Route::prefix('purchase_order')->middleware(check_superadmin_divisi::class)->group(function () {
        Route::get('list', [Purchase_Order::class, 'list'])->name("cpanel.purchase_order");
        Route::get('form/{id?}', [Purchase_Order::class, 'form'])->name('cpanel.purchase_order.form');
        Route::get('delete/{id}', [Purchase_Order::class, 'delete'])->name('cpanel.purchase_order.delete');
        Route::post('insert', [Purchase_Order::class, 'insert'])->name('cpanel.purchase_order.insert');
        Route::post('update', [Purchase_Order::class, 'update'])->name('cpanel.purchase_order.update');
    });
    Route::prefix('request_product')->group(function () {
        Route::get('get_request_order/{id?}', [Request_Product::class, 'get_request_order'])->name("cpanel.request_product.get_request_order");
        Route::get('get_by_id/{id?}', [Request_Product::class, 'get_by_id'])->name("cpanel.request_product.get_by_id");
        Route::get('update', [Request_Product::class, 'update'])->name("cpanel.request_product.update");
        Route::get('delete/{id?}', [Request_Product::class, 'delete'])->name("cpanel.request_product.delete");
    });
    Route::prefix('laporan_po')->middleware([check_superadmin_divisi::class])->group(function () {
        Route::get('list', [Laporan_PO::class, 'list'])->name("cpanel.laporan_po");
    });
    Route::prefix('user')->middleware(check_superadmin_divisi::class)->group(function () {
        Route::get('list', [User::class, 'list'])->name("cpanel.user");
        Route::get('profile', [User::class, 'profile'])->name('cpanel.user.profile');
        Route::get('profile_update', [User::class, 'profile_update'])->name('cpanel.user.profile_update');
        Route::get('form/{id?}', [User::class, 'form'])->name('cpanel.user.form');
        Route::get('delete/{id}', [User::class, 'delete'])->name('cpanel.user.delete');
        Route::post('insert', [User::class, 'insert'])->name('cpanel.user.insert');
        Route::post('update', [User::class, 'update'])->name('cpanel.user.update');
    });
    Route::prefix('hutang_supplier')->middleware(check_superadmin_divisi::class)->group(function () {
        Route::get('list', [Hutang_Supplier::class, 'list'])->name("cpanel.hutang_supplier");
        Route::get('form/{id?}', [Hutang_Supplier::class, 'form'])->name('cpanel.hutang_supplier.form');
        Route::get('delete/{id}', [Hutang_Supplier::class, 'delete'])->name('cpanel.hutang_supplier.delete');
        Route::post('insert', [Hutang_Supplier::class, 'insert'])->name('cpanel.hutang_supplier.insert');
        Route::post('update', [Hutang_Supplier::class, 'update'])->name('cpanel.hutang_supplier.update');
    });
});