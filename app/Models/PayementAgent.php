<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayementAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'signature',
        'month',
		'taux',
        'type',
        'niv1',
        'niv2',
        'statut',
        'active',
    ];
}
