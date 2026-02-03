<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bc extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'reference',
        'da',
        'proforma',
        'personne',
        'lieu',
        'delai',
        'comment',
        'niv1',
        'niv2',
        'active',
        'signature',
    ];
}
