<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    public function getTopCars(): JsonResponse
    {
        $cars = Car::where('on_the_road', true)
        ->inRandomOrder()
        ->take(3)
        ->get();
        return response()->json($cars);
    }
    // Return selected Car if it's published
    public function getCar(Car $car): JsonResponse
    {
    $selectedCar = Car::where([
    'id' => $car->id,
    'on_the_road' => true,
    ])
    ->firstOrFail();
    return response()->json($selectedCar);
    }
    // Return 3 Cars in random order- except the selected Car
    public function getRelatedCars(Car $car): JsonResponse
    {
        $cars = Car::where('on_the_road', true)
        ->where('id', '<>', $car->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
        return response()->json($cars);
    }
}
