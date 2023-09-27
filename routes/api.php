<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ProjectAmenityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ProjectGalleryController;
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

    Route::post('signup', [UserController::class, 'signup']);
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('forgotpassword', [UserController::class, 'forgotPassword'])->name('forgotPassword');


    Route::group(["middleware"=>'auth:sanctum'],function () {
        Route::prefix('project')->group(function () {
            Route::post('create', [ProjectController::class, 'create']);
            Route::get('{id}/get', [ProjectController::class, 'getById']);
            Route::get('list', [ProjectController::class, 'getList']);
            Route::put('{id}/update', [ProjectController::class, 'edit']);
            Route::delete('{id}/delete', [ProjectController::class, 'destroy']);
        });
        Route::prefix('amenities')->group(function () {
            Route::post('create', [AmenityController::class, 'create']);
            Route::get('{id}/get', [AmenityController::class, 'show']);
            Route::get('list', [AmenityController::class, 'index']);
            Route::post('{id}/update', [AmenityController::class, 'update']);
            Route::delete('{id}/delete', [AmenityController::class, 'destroy']);
        });
        Route::prefix('contact')->group(function () {
            Route::post('create', [ContactController::class, 'create']);
            Route::get('{id}/get', [ContactController::class, 'show']);
            Route::get('list', [ContactController::class, 'index']);
            Route::put('{id}/update', [ContactController::class, 'update']);
            Route::delete('{id}/delete', [ContactController::class, 'destroy']);
        });
        Route::prefix('enquiry')->group(function () {
            Route::post('create', [EnquiryController::class, 'create']);
            Route::get('{id}/get', [EnquiryController::class, 'show']);
            Route::get('list', [EnquiryController::class, 'index']);
            Route::put('{id}/update', [EnquiryController::class, 'update']);
            Route::delete('{id}/delete', [EnquiryController::class, 'destroy']);
        });
        Route::prefix('project/amenity')->group(function () {
            Route::post('create', [ProjectAmenityController::class, 'create']);
            Route::get('{id}/get', [ProjectAmenityController::class, 'show']);
            Route::delete('{id}/delete', [ProjectAmenityController::class, 'destroy']);
        });        
        Route::prefix('gallery')->group(function () {
            Route::post('{id}/create', [ProjectGalleryController::class, 'create']);
            Route::get('{id}/get', [ProjectGalleryController::class, 'index']);

        });        
        Route::prefix('blog')->group(function () {
            Route::post('create', [BlogController::class, 'create']);
            Route::get('{id}/get', [BlogController::class, 'show']);
            Route::get('list', [BlogController::class, 'index']);
            Route::put('{id}/update', [BlogController::class, 'update']);
            Route::delete('{id}/delete', [BlogController::class, 'destroy']);
        });
    });
    