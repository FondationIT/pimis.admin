<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvAttrCommissionSignatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pv_attr',
        'niv_1',
        'niv_2',
        'niv_3',
        'comments'
    ];
}
