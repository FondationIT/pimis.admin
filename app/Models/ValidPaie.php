<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidPaie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'paie',
        'resp',
        'niv',
        'motif',
    ];

}
