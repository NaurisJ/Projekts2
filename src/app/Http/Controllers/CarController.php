<?php

namespace App\Http\Controllers;


use App\Models\Manufacturer;
use App\Models\Car;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CarRequest;


class CarController extends Controller implements HasMiddleware
{
        // call auth middleware
    public static function middleware(): array
    {
        return [
        'auth',
        ];
    }

    // display all Cars
    public function list(): View
    {
        $items = Car::orderBy('model', 'asc')->get();
        return view(
        'car.list',
        [
        'title' => 'Cars',
        'items' => $items
        ]
        );
    }

    // display new Car form
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

    private function saveCarData(Car $car, CarRequest $request): void
    {
        $validatedData = $request->validated();


            $car->fill($validatedData);
            $car->manufacturer_id = $validatedData['manufacturer_id'];
            $car->model = $validatedData['model'];
            $car->year = $validatedData['year'];
            $car->on_the_road = (bool) ($validatedData['on_the_road'] ?? false);


        
            if ($request->hasFile('image')) {
                // here you can add code that deletes old image file when new one is uploaded
                 $uploadedFile = $request->file('image');
                 $extension = $uploadedFile->clientExtension();
                 $name = uniqid();
                //  $car->image = $uploadedFile->storePubliclyAs(
                //  '/',
                //  $name . '.' . $extension,
                //  'uploads'
                //  );
                // This worked for me because this code accesses public/images directory
                $uploadedFile->move(public_path('images'), $name . '.' . $extension);
                $car->image = $name . '.' . $extension;
                }
            $car->save();
    }


    // create new Car entry
    public function put(CarRequest $request): RedirectResponse
    {
        $car = new Car();
        $this->saveCarData($car, $request);
        return redirect('/cars');
    }

    // display Car edit form
    public function update(Car $car): View
    {
        $manufacturers = Manufacturer::orderBy('name', 'asc')->get();
        return view(
        'car.form',
        [
        'title' => 'Edit info',
        'car' => $car,
        'manufacturers' => $manufacturers,
        ]
        );
        }
        // update Car data
    public function patch(Car $car, CarRequest $request): RedirectResponse
    {
        $this->saveCarData($car, $request);
        return redirect('/cars/update/' . $car->id);
    }

    public function delete(Car $car): RedirectResponse
    {
        if ($car->image) {
            unlink(getcwd() . '/images/' . $car->image);
            }
            
        $car->delete();
        return redirect('/cars');
    }




}
