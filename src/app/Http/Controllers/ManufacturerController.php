<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ManufacturerController extends Controller
{
        // display all Authors
    public function list(): View
    {
        $items = Manufacturer::orderBy('name', 'asc')->get();
        return view(
        'manufacturer.list',
        [
        'title' => 'Manufacturers',
        'items' => $items,
        ]
        );
    }

    // display new Manufacturer form
    public function create(): View
    {
        return view(
        'manufacturer.form',
        [
        'title' => 'Add new manufacturer',
        'manufacturer' => new Manufacturer()

        ]
        );
    }


    // create new Manufacturer
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        ]);
        $manufacturer = new Manufacturer();
        $manufacturer->name = $validatedData['name'];
        $manufacturer->save();
        return redirect('/manufacturers');
    }

    // display Author editing form
    public function update(Manufacturer $manufacturer): View
    {
        return view(
        'manufacturer.form',
        [
        'title' => 'Edit manufacturer',
        'manufacturer' => $manufacturer
        ]
        );
    }


    public function patch(Manufacturer $manufacturer, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        ]);
        $manufacturer->name = $validatedData['name'];
        $manufacturer->save();
        return redirect('/manufacturers');
    }


    public function delete(Manufacturer $manufacturer): RedirectResponse
    {
        // this is a good place to check if author has related Book items and prevent deletion if so
        $manufacturer->delete();
        return redirect('/manufacturers');
    }


}
