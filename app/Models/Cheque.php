<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'agent',
        'projet',
        'bp',
        'beneficiare',
        'numero',
        'montant',
        'lieu',
        'motif',
        'active',
    ];
}
