<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Op extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'agent',
        'projet',
        'bp',
        'beneficiare',
        'compteB',
        'banqueB',
        'numero',
        'montant',
        'lieu',
        'motif',
    ];

}
