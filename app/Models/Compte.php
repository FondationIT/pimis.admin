<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'intitule',
        'numero',
        'type',
        'proprietaire',
        'banque',
        'adresse',
        'solde',
        'signature',
        'active',
    ];

  
}
