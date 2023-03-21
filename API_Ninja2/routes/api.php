<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NinjaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\RecruitControllerx;

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
Route::prefix('/ninjas')->group(function()
{
    Route::get('/index',[NinjaController::class,'index']);
    Route::get('/buscar/nombre/{name}',[NinjaController::class,'show_by_name']);
    Route::put('/store',[NinjaController::class,'create']);

    Route::post('/update/{id}',[NinjaController::class,'update']);
    Route::post('/retire/{id}',[NinjaController::class,'retire']);
    Route::post('/{getMission/{id}/missions',[NinjaController::class,'getMissions']);
    Route::post('/{assing/{id}',[NinjaController::class,'assignToMission']);

});

Route::prefix('/clients')->group(function()
{
    Route::get('/getClients',[ClientController::class,'index']);
    Route::put('/create',[ClientController::class,'crear']);
    Route::post('/update/{id}',[ClientController::class,'update']);


});
Route::prefix('/misiones')->group(function()
{
    Route::put('/create',[MissionController::class,'store']);
    Route::post('/update/{id}',[MissionController::class,'update']);
});
Route::prefix('/reclutas')->group(function()
{
    Route::get('/index',[RecruitController::class,'index']);
    Route::get('/buscar/nombre/{name}',[RecruitController::class,'show_by_name']);
    Route::put('/create',[RecruitController::class,'store']);
    Route::post('/update/{id}',[RecruitController::class,'update']);
    Route::post('/retire/{id}',[RecruitController::class,'retire']);
});

