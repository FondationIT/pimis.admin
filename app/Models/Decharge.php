<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'projet',
        'bp',
        'beneficiare',
        'qualite',
        'piece',
        'phone',
        'montant',
        'montantTL',
        'institution',
        'motif',
        'active',
    ];
}
