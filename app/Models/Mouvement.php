<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'agent',
        'motif',
        'depart',
        'retour',
        'destination',
        'niv1',
        'niv2',
        'active',
    ];
}
