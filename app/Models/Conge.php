<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'agent',
        'motif',
        'debut',
        'fin',
        'dure',
        'type',
        'niv1',
        'niv2',
        'active',
    ];
}
