<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return [
        'message' => 'Laravel API is working!',
        'status' => 'success',
        'app' => 'Gym App Backend',
        'timestamp' => now()
    ];
});

Route::post('register', [UserController::class,'register'])->name('register');
Route::post('login', [UserController::class,'login'])->name('login');



Route::post('add_profile', [ProfileController::class,'add_Profile'])->name('add_profile')->middleware('auth:sanctum');

Route::get('/api/test', function () {
    return response()->json([
        'message' => 'API is working perfectly!',
        'data' => ['Laravel', 'Railway', 'Flutter']
    ]);
});
