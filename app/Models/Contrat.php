<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'agent',
        'projet',
        'type',
        'debut',
        'fin',
        'salaire',
        'description',
        'statut',
        'active',
    ];
}
