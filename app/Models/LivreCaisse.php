<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class LivreCaisse extends Model
{
    //use MassPrunable;
    use HasFactory;
    use Notifiable, SoftDeletes;
    protected $fillable = [
        'reference',
        'signature',
        'projet',
        'index',
        'type',
        'entree',
        'sortie',
        'libelle',
        'active',
        'deleted_at'
    ];

   

    public function projets()
    {
        return $this->belongsTo(Projet::class, 'projet', 'id');
    }

}
