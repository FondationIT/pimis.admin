<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvAttr extends Model
{
    use HasFactory;

    protected $fillable = [
        'da',
        'reference',
        'titre',    
        'type',
        'observation',
        'justification',
        'active',
        'signature',

    ];
}
