<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', LoginController::class)->name('login');

Route::middleware('auth:sanctum')->group(function () {
    //3|mY9ogpZgYteOAfsBUy8GHpIJZxHNMJoWdPKPecGP60027226
    Route::controller(SessionController::class)->prefix('session')->group(function () {
        Route::get('', 'index');
        Route::post('create', 'store');
    });

    Route::controller(\App\Http\Controllers\CourseController::class)->prefix('course')->group(function () {
        /*/api/course - post;  create a new record
        /api/course - get;  list all records
        /api/course/2 - get;  read specific record;
        /api/course/2/edit - get;  read specific record;
        /api/course/2/update - put,patch;  read specific record;*/

        Route::get('', 'index'); //api/course
        Route::post('', 'store'); //api/course
        Route::get('{id}', 'show'); //api/course/2
        Route::patch('{id}/update', 'update'); //api/course/2
    });
});