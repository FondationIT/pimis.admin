<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrActivite extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'activite',
        'observation',
    ];
}
