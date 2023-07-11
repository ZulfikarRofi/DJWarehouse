<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashbpoardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WarehouseController;
use App\Models\Transaction;
use App\Models\Warehouse;
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
Route::get('/login', [UsersController::class, 'getLogin']);
Route::post('/login', [UsersController::class, 'postLogin']);

Route::group(['middleware' => 'auth'], function () {
    // Route Get Function
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/users', [UsersController::class, 'getDataUser']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/warehouses', [WarehouseController::class, 'index']);
    Route::get('/classification', [WarehouseController::class, 'classification']);
    Route::get('/sellreport', [ReportController::class, 'getSellReport']);
    Route::get('/stockreport', [ReportController::class, 'getStockReport']);


    // Route Post Function
    Route::post('/register', [UsersController::class, 'RegisterUser']);
    Route::post('/logout', [UsersController::class, 'postLogout']);
    Route::post('/createproduct', [ProductController::class, 'store']);
    Route::post('/createtransaction', [TransactionController::class, 'store']);
    Route::post('/createwarehouse', [WarehouseController::class, 'store']);
    Route::post('/createlocation', [WarehouseController::class, 'locationStore']);
    Route::post('/storeAddRack', [WarehouseController::class, 'addRackStore']);
    Route::post('/createcategory', [WarehouseController::class, 'addCategory']);
    Route::post('/createplacement', [WarehouseController::class, 'storeAddPlacement']);
    Route::post('/classification', [WarehouseController::class, 'classification']);


    // Route Delete Function
    Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']);
    Route::delete('/deletetransaction/{id}', [TransactionController::class, 'destroy']);


    //testing route
    Route::get('/test', [DashboardController::class, 'test']);
});
