<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RCaisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'projet',
        'solde',
    ];
}
