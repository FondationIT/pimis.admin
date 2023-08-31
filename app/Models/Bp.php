<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bp extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'bc',
        'projet',
        'beneficiaire',
        'type',
        'montant',
        'montantTL',
        'categorie',
        'dateP',
        'comment',
        'signature',
        'niv1',
        'niv2',
        'niv3',
        'active',
    ];
}