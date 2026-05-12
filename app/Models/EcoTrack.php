<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcoTrack extends Model
{
    use HasFactory;

    // Tambahkan ini supaya bisa input data ke database
    protected $fillable = [
    'user_id', 
    'item_name', 
    'qr_code', 
    'status', 
    'points', 
    'weight'
];
}