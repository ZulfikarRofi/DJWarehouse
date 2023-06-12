<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashbpoardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WarehouseController;
use App\Models\Transaction;
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
    return view('welcome');
});

// Route Get Function
Route::get('/', [DashboardController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/warehouses', [WarehouseController::class, 'index']);


// Route Post Function
Route::post('/createproduct', [ProductController::class, 'store']);
Route::post('/createtransaction', [TransactionController::class, 'store']);
Route::post('/createwarehouse', [WarehouseController::class, 'store']);
Route::post('/createlocation', [WarehouseController::class, 'locationStore']);


// Route Delete Function
Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']);
Route::delete('/deletetransaction/{id}', [TransactionController::class, 'destroy']);


//testing route
Route::get('/test', [DashboardController::class, 'test']);
