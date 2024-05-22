<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'reference',
        'ms',
        'active',

    ];
}
