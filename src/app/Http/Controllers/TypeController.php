<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TypeController extends Controller
{
            // display all Types
    public function list(): View
    {
        $items = Type::orderBy('name', 'asc')->get();
        return view(
        'type.list',
        [
        'title' => 'Types',
        'items' => $items,
        ]
        );
    }
        
        // display new Type form
        public function create(): View
        {
            return view(
            'type.form',
            [
            'title' => 'Add new type',
            'type' => new Type()
    
            ]
            );
        }
    
    
        // create new Type
        public function put(Request $request): RedirectResponse
        {
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            ]);
            $Type = new Type();
            $Type->name = $validatedData['name'];
            $Type->save();
            return redirect('/types');
        }
    
        // display Type editing form
        public function update(Type $type): View
        {
            return view(
            'type.form',
            [
            'title' => 'Edit type',
            'type' => $type
            ]
            );
        }
    
    
        public function patch(Type $type, Request $request): RedirectResponse
        {
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            ]);
            $type->name = $validatedData['name'];
            $typ->save();
            return redirect('/types');
        }
    
    
        public function delete(Type $type): RedirectResponse
        {
            // this is a good place to check if author has related Book items and prevent deletion if so
            $type->delete();
            return redirect('/types');
        }
}
