<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tr_ref',
        'objectif',
        'resultat',
        'de',
        'a'
    ];
}
