<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvAttrCommissionersConcents extends Model
{
    use HasFactory;
    protected $attributes = [
        'comment' => "Je reconnais avoir pris connaissance du présent document et de l’ensemble de son contenu. J’en comprends les termes et j’autorise qu’il soit procédé conformément à ce qui y est stipulé.",
    ];
}
