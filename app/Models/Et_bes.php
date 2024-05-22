<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Et_bes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'agent',
        'projet',
        'ligne',
        'comment',
        'categorie',
        'niv1',
        'niv2',
        'active',
    ];

    public function scopeActive($q){
        return $q->where('et_bes.active', 1)->where('et_bes.niv1', 1)->where('et_bes.niv2', 1);
    }

    public function scopeInactive($q){
        return $q->where('et_bes.active', 0);
    }

    public function scopeEnCours($q){
        return $q->where('et_bes.active', 1)->where(function ($query) {
            $query->where('et_bes.niv1', 0)
                ->orWhere('et_bes.niv2', 0);
        });
    }
}
