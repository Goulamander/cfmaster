<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\EstimateSalesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserActionsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// User Routes Module
Route::group(['middleware' => ['auth', 'user']], function () {
    //Product Cost Module
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::post('/product/updateStock', [StockController::class, 'updateStock']);
    Route::post('/product/edit', [ProductController::class, 'updateProduct']);
    Route::get('/product/showallproduct', [ProductController::class, 'showallproduct']);
    Route::get('/product/getSingleUserData/{id}', [ProductController::class, 'getSingleUserData']);
    Route::post('/product/updateDemandIncomig', [EstimateSalesController::class, 'updateDemandIncomig']);
    Route::get('/product/getDataOFDemandAndStock', [EstimateSalesController::class, 'getDataOFDemandAndStock']);
    Route::post('/product/paidInitalPayment', [ProductController::class, 'initialPaymentOFMonth']);
    Route::post('/product/paidFinalPayment', [ProductController::class, 'finalPaymentOFMonth']);
    Route::post('/product/firstHalfMonth', [ProductController::class, 'firstHalfMonthPayment']);
    Route::post('/product/secondHalfMonth', [ProductController::class, 'secondHalfMonthPayment']);
    //Running Cost Module
    Route::get('/runningCost', [CostController::class, 'index']);
    Route::get('/runningCost/all', [CostController::class, 'showAllRunningCostEntry']);
    Route::post('/runningCost/newEntry', [CostController::class, 'runningCostEntry']);
    Route::get('/runningCost/delete/{id}', [CostController::class, 'delete']);
    Route::get('/runningCost/singleRunningCost/{id}', [CostController::class, 'showSingleRunningCost']);
    Route::post('/runningCost/editRunningCost', [CostController::class, 'editRunningCost']);
    //Unique Cost Module
    Route::post('/uniqueCost/singleEntry', [CostController::class, 'uniqueCostSingleEntry']);
    Route::get('/uniqueCost/allsingleEntry', [CostController::class, 'allsingleEntry']);
    Route::get('/uniqueCost/getSingleEntry/{id}', [CostController::class, 'getSingleEntry']);
    Route::post('/uniqueCost/updatesingleEntry/', [CostController::class, 'updateSingleEntry']);
    Route::get('/uniqueCost/deleteSingleEntry/{id}', [CostController::class, 'deleteSingleEntry']);
    //stats URLs
    Route::get('/dashboard/stats', [HomeController::class, 'stats']);
    Route::get('/running/stats', [CostController::class, 'runningstats']);
    //User Action URLs
    Route::post('/user/updateCurrentDate', [UserActionsController::class, 'updateCurrentDate']);
    Route::get('/user/getUserPlan', [UserActionsController::class, 'getUserPlan']);
    Route::get('/user/profile', [UserActionsController::class, 'userProfile']);
    Route::post('/user/updateProfile',[UserActionsController::class,'updateProfile'])->name('updateUserInfo');
    Route::post('/user/change_photo',[UserActionsController::class,'updatePhoto'])->name('updatePhoto');  
    Route::post('/user/change_password',[UserActionsController::class,'changePassword'])->name('changepassword');  
    Route::get('/user/deleteAccount/{id}', [UserActionsController::class, 'deleteAccount']); 

/*     Route::post('/user/change_password',[UserActionsController::class,'changePassword'])->name('changepassword');     */
   
});
// Admin Routes Module
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/subscribers', [App\Http\Controllers\AdminController::class, 'subscribers']);
});
Route::get('migratenewdatatables', function () {
    /* php artisan migrate */
    Artisan::call('migrate');
    dd("Migartion done");
});
Route::get('optimizetheapp', function () {
    /* php artisan optimize */
    Artisan::call('optimize');
    dd("optimization done");
});
