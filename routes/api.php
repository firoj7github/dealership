<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\JWTAuthController;
use App\Http\Controllers\Api\V1\Dealer\InventoryController;
use App\Http\Controllers\Api\V1\Lead\LeadController;
use App\Http\Controllers\Api\Buyer\BuyerLoginRegisterController;
use App\Http\Controllers\Auth\MigrationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [JWTAuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('inventories', InventoryController::class);
Route::get('inventory',[InventoryController::class,'latestInventory'])->name('latest.inventory');


// buyer login register route  rest api
Route::post('buyer/login',[BuyerLoginRegisterController::class,'loginCheck']);
Route::post('buyer/register',[BuyerLoginRegisterController::class,'register']);


// lead store route start
Route::post('lead/store',[LeadController::class,'leadStore']);

Route::delete('/migrations/{filename}', [MigrationController::class,'index'])->name('mset');
