<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'reference',
        'enfant',
        'etatcivil',
        'bus',
        'sociale',
        'active',
        'signature',

    ];
}
