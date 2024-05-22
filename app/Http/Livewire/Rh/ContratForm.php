<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\Projet;
use Livewire\Component;

class ContratForm extends Component
{
    protected $listeners = [
        'contratAForm'=> '$refresh'
    ];
    public function render()
    {
        return view('livewire.rh.contrat-form',
        [
            'agent' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),
            'projet' => Projet::where("active", "1")->where("id", "!=", "3")->orderBy("id", "DESC")->get(),
            'projets' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),


        ]);
    }
}
