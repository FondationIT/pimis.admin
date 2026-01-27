<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvCommissionersConcents extends Model
{
    use HasFactory;
    protected $attributes = [
        'comment' => "Je reconnais avoir pris part aux travaux de cette analyse et déclare accepter sans réserve les conclusions issues de ladite PV d'analyse.",
    ];
    protected $fillable = [
        'reference',
        'pv',
        'agent',
    ];
    
}
