<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'agents',
        'msg_id',
        'is_read',
        'task',
        'is_delegated',
        'delegated_by',
        'is_niv1',
        'is_niv2',
        'is_niv3',
        'is_niv4',
    ];

    protected $casts = [
        'agents' => 'array',
        'is_delegated' => 'boolean',
    ];
}
