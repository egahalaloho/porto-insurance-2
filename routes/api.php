<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('testing-api', function (Request $request) {
    return response()->json(['test' => 'testing api']); 
 });
 
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('registers', [AuthController::class, 'register']);

Route::get('protected', function () {
    dd('Route accessed');
})->middleware(['jwt']);

Route::middleware(['jwt.auth'])->group(function () {
     Route::post('logout', [AuthController::class, 'logout']);
});