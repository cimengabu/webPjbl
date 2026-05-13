<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecyclingCenter extends Model
{
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude',
        'accepted_materials',
    ];

    protected $casts = [
        'accepted_materials' => 'array',
    ];
}
