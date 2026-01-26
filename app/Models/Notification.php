<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'agent',
        'msg_id',
        'is_read',
        'task',
        'is_delegated',
        'delegated_by'
    ];

    protected $casts = [
        'is_delegated' => 'boolean',
    ];
}
