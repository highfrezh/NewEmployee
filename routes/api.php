<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\StateController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeDataController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => UserController::class,]);
Route::apiResources(['country' => CountryController::class,]);
Route::apiResources(['state' => StateController::class,]);
Route::apiResources(['city' => CityController::class,]);
Route::apiResources(['department' => DepartmentController::class,]);
Route::apiResources(['employee' => EmployeeController::class,]);

Route::get('employees/departments',      [EmployeeDataController::class,'departments']);
Route::get('employees/countries',        [EmployeeDataController::class,'countries']);
Route::get('employees/{country}/states', [EmployeeDataController::class,'states']);
Route::get('employees/{state}/cities',   [EmployeeDataController::class,'cities']);



