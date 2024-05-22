<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Be extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'agent',
        'projet',
        'montant',
        'montantTL',
        'motif',
        'active',
        'signature',
    ];
}
