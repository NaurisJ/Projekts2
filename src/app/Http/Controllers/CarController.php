<?php

namespace App\Http\Controllers;


use App\Models\Manufacturer;
use App\Models\Car;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class CarController extends Controller implements HasMiddleware
{
        // call auth middleware
    public static function middleware(): array
    {
        return [
        'auth',
        ];
    }

    // display all Books
    public function list(): View
    {
        $items = Car::orderBy('make', 'asc')->get();
        return view(
        'car.list',
        [
        'title' => 'Cars',
        'items' => $items
        ]
        );
    }

    // display new Book form
    public function create(): View
    {
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        return view(
        'car.form',
        [
        'title' => 'Add new car',
        'car' => new Car(),
        'manufacturers' => $manufacturers,
        ]
        );
    }


    // create new Book entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'make' => 'required|min:3|max:256',
        'manufacturer_id' => 'required',
        'model' => 'nullable',
        'year' => 'numeric',
        'image' => 'nullable|image',
        'on_the_road' => 'nullable',
        ]);
        $book = new Car();
        $book->make = $validatedData['make'];
        $book->manufacturer_id = $validatedData['manufacturer_id'];
        $book->model = $validatedData['model'];
        $book->year = $validatedData['year'];
        $book->display = (bool) ($validatedData['display'] ?? false);
        $book->save();
        return redirect('/cars');
    }


}
