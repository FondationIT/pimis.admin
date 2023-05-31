<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Br extends Model
{
    use HasFactory;


      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'bc',
        'projet',
        'fournisseur',
        'personne',
        'lieu',
        'bordereau',
        'etat',
        'comment',
        'signature',
    ];
}

