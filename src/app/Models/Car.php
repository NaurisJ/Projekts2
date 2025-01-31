<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = [
        'manufacturer_id',
        'model',
        'year',
        'type_id',
        ];
        

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
        'manufacturer_id' => intval($this->id),
        'model' => $this->model,
        'type' => ($this->type ? $this->type->name : ''),
        'year' => intval($this->year),
        'image' => asset('images/' . $this->image),
        ];


        // 'manufacturer_id' => 'required',
        // 'model' => 'required|nullable',
        // 'year' => 'required|numeric|min:1900',
        // 'image' => 'nullable',
        // 'on_the_road' => 'boolean',
        // 'type_id' => 'required',
    }

}
