<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NdOder extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'reference',
        'libelle',
        'nd',
        'unite',
        'quantite',
        'prix',
        'active',
    ];
}
