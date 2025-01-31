<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DataController;



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
Route::get('/cars/update/{car}', [CarController::class, 'update']);
Route::post('/cars/patch/{car}', [CarController::class, 'patch']);
Route::post('/cars/delete/{car}', [CarController::class, 'delete']);


Route::get('/types', [TypeController::class, 'list']);
Route::get('/types/create', [TypeController::class, 'create']);
Route::post('/types/put', [TypeController::class, 'put']);

Route::get('/types/update/{type}', [TypeController::class, 'update']);
Route::post('/types/patch/{type}', [TypeController::class, 'patch']);

Route::post('/types/delete/{type}', [TypeController::class, 'delete']);


// Data/API
Route::get('/data/get-top-cars', [DataController::class, 'getTopCars']);
Route::get('/data/get-car/{car}', [DataController::class, 'getcar']);
Route::get('/data/get-related-cars/{car}', [DataController::class, 'getRelatedCars']);
