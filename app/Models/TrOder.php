<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrOder extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'reference',
        'libelle',
        'tr',
        'unite',
        'quantite',
        'ligne',
        'prix',
        'active',
    ];
}
