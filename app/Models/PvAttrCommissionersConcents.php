<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PvAttrCommissionersConcents extends Model
{
    use HasFactory;
    protected $table = 'pv_attr_commissioners_concents';

    protected $fillable = [
        'pv_attr',
        'agent',
        'is_approved',
        'comment',
    ];

    protected $attributes = [
        'comment' => "Je reconnais avoir pris connaissance du présent document et de l’ensemble de son contenu. J’en comprends les termes et j’autorise qu’il soit procédé conformément à ce qui y est stipulé.",
        'is_approved' => 'En attente',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent');
    }

    public function pvAttr()
    {
        return $this->belongsTo(PvAttr::class, 'pv_attr');
    }
}
