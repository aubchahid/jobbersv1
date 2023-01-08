<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;
use App\Models\Job;
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


// Get All Jobs
Route::get('/jobs', [JobsController::class, 'index']);

// Get a specif job
Route::get('/jobs/{id}', [JobsController::class, 'show']);


// Register a user
Route::post('/register', [AuthController::class, 'register']);


// Login a user 
Route::post('/login', [AuthController::class, 'login']);

// Protecting the routes with sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Update a Job
    Route::put('/jobs/{id}', [JobsController::class, 'update']);

    // Delete a Job
    Route::delete('/jobs/{id}', [JobsController::class, 'destroy']);


    // Create a Job
    // Always adding in the headers : Accept => application/json
    Route::post('/jobs', [JobsController::class, 'store']);

    // Logout a user
    Route::post('/logout', [AuthController::class, 'logout']);
});



// Group routes 
//Route::resource('jobs', JobsController::class);
