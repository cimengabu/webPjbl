<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $fillable = ['version_name', 'changelog_text', 'is_ai_powered'];
}