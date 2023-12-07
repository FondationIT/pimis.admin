<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListePaie extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'agent',
        'sAgent',
        'pymt',
        'month',
        'SB',
        'jp',
        'ne',
        'statut',
        'active',
    ];
}
