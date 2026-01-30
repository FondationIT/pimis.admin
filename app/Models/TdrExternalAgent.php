<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdrExternalAgent extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'firstname',
        'lastname',
        'middlename',
        'position',
        'organization',
        'contact',
        'active',
    ];
}
