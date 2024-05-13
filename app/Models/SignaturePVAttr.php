<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignaturePVAttr extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'reference',
        'pv',
        'active',
        'signature',

    ];
}
