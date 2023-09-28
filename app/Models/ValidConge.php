<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidConge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'conge',
        'resp',
        'niv',
        'motif',
    ];
}
