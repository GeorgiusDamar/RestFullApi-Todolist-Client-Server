<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodolistControllerApi;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Generate token
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/todos', [TodolistControllerApi::class, 'index']);
    // Route::post('/todos', [TodolistControllerApi::class, 'store']);
    Route::get('/todos/{id}', [TodolistControllerApi::class, 'show']);
    Route::put('/todos/{id}', [TodolistControllerApi::class, 'update']);
    Route::delete('/todos/{id}', [TodolistControllerApi::class, 'destroy']);
    Route::post('/todos', [TodolistControllerApi::class, 'store']);
});


// Route::middleware('auth:sanctum')->get('/admin', function (Request $request){
//     return $request->admin();
// });

// Route::get('todo', [TodolistControllerApi::class, 'index'])->name('todolists');
