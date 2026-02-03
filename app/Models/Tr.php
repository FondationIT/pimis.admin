<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'agent',
        'projet',
        'type',
        'titre',
        'niv1',
        'niv2',
        'niv3',
        'niv4',
        'active',
    ];
}
