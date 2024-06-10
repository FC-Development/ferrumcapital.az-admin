<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainWeb\MkSliderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RegionController;
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
Route::get("/get/FerrumCapital/MusteriKabineti/slider",[MkSliderController::class,'getData']);

//get city and region names
Route::get('cities/names', [CityController::class, 'getCityNames']);
Route::get('regions/{city_id}', [RegionController::class, 'getRegionsByCityId']);