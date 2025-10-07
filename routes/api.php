<?php

use App\Http\Controllers\Api\ApiAccountdetailController;
use App\Http\Controllers\Api\ApicategoryController;
use App\Http\Controllers\Api\ApiDocumentController;
use App\Http\Controllers\Api\Apilogincontroller;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiProfileController;
use App\Http\Controllers\Api\ProductAttributeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sign-up', [Apilogincontroller::class, 'signUp']);
Route::post('login', [Apilogincontroller::class, 'login']);
Route::post('social-login', [Apilogincontroller::class, 'socialsignup']);

//profile
Route::get('profile/get', [ApiProfileController::class, 'get']);
Route::get('profile/update', [ApiProfileController::class, 'update']);


//categories
Route::get('categories/get', [ApicategoryController::class, 'get']);
Route::get('subcategory/get', [ApicategoryController::class, 'subcategory_get']);

//userprefrence
Route::get('userprefrence/get', [ApicategoryController::class, 'userprefrence']);
//document
Route::post('document/store', [ApiDocumentController::class, 'store']);
//account detail
Route::post('accountdetail/store', [ApiAccountdetailController::class, 'store']);
Route::get('accountdetail/get', [ApiAccountdetailController::class, 'get']);
//product shop
Route::post('shopproduct/store', [ApiProductController::class, 'store']);
Route::get('shopproduct/get', [ApiProductController::class, 'get']);
//color size shoptype get

Route::get('color/get', [ProductAttributeController::class, 'color_get']);
Route::get('size/get', [ProductAttributeController::class, 'size_get']);
Route::get('shoptype/get', [ProductAttributeController::class, 'shoptype_get']);
Route::get('shoptype-related/product/get', [ProductAttributeController::class, 'shoptype_product_get']);
Route::get('shoptype-related/product-data/get', [ProductAttributeController::class, 'shoptype_product_dataget']);