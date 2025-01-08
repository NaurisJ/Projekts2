<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturerController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/manufacturers', [ManufacturerController::class, 'list']);

Route::get('/manufacturers/create', [ManufacturerController::class, 'create']);
Route::post('/manufacturers/put', [ManufacturerController::class, 'put']);

Route::get('/manufacturers/update/{manufacturer}', [ManufacturerController::class, 'update']);
Route::post('/manufacturers/patch/{manufacturer}', [ManufacturerController::class, 'patch']);

Route::post('/manufacturers/delete/{manufacturer}', [ManufacturerController::class, 'delete']);