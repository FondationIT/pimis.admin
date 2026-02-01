<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCardDailyScan extends Model
{
    use HasFactory;
    protected $fillable = [
        'card',
        'scan_type'
    ];
}
