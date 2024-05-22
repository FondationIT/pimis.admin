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

    public function scopeActive($q){
        return $q->where('dem_aches.active', 1)->where('dem_aches.niv1', 1)->where('dem_aches.niv2', 1)->where('dem_aches.niv3', 1)->where('dem_aches.niv4', 1);
    }

    public function scopeInactive($q){
        return $q->where('dem_aches.active', 0);
    }

    public function scopeEnCours($q){
        return $q->where('dem_aches.active', 1)->where(function ($query) {
            $query->where('dem_aches.niv1', 0)
                ->orWhere('dem_aches.niv2', 0)
                ->orWhere('dem_aches.niv3', 0)
                ->orWhere('dem_aches.niv4', 0);
        });
    }
}
