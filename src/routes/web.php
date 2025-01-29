<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;



Route::get('/', [HomeController::class, 'index']);

Route::get('/manufacturers', [ManufacturerController::class, 'list']);

Route::get('/manufacturers/create', [ManufacturerController::class, 'create']);
Route::post('/manufacturers/put', [ManufacturerController::class, 'put']);

Route::get('/manufacturers/update/{manufacturer}', [ManufacturerController::class, 'update']);
Route::post('/manufacturers/patch/{manufacturer}', [ManufacturerController::class, 'patch']);

Route::post('/manufacturers/delete/{manufacturer}', [ManufacturerController::class, 'delete']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/cars', [CarController::class, 'list']);
Route::get('/cars/create', [CarController::class, 'create']);
Route::post('/cars/put', [CarController::class, 'put']);
Route::get('/cars/update/{book}', [CarController::class, 'update']);
Route::post('/cars/patch/{book}', [CarController::class, 'patch']);
Route::post('/cars/delete/{book}', [CarController::class, 'delete']);
