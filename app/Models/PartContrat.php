<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartContrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'projet',
        'contrat',
        'debut',
        'fin',
        'pourcentage',
        'statut',
        'active',
    ];
}
