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
}
