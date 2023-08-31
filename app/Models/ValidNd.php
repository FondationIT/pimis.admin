<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidNd extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'nd',
        'resp',
        'niv',
        'motif',
    ];
}
