<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemAch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'comment',
        'motif',
        'eb',
        'amount',
        'signature',
        'niv1',
        'niv2',
        'niv3',
        'niv4',
        'active',
    ];
}
