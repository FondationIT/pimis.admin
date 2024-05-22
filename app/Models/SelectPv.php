<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectPv extends Model
{
    use HasFactory;

    protected $fillable = [
        'pv',
        'reference',
        'produit',
        'proforma',
        'active',
        'signature',

    ];
}
