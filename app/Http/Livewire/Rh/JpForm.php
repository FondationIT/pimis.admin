<?php

namespace App\Http\Livewire\Rh;

use App\Models\Contrat;
use App\Models\PayementAgent;
use Livewire\Component;

class JpForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $contrat =[];
    public $paie;
    protected $listeners = [
        'jpA',
    ];

    public function jpA($modelId){
        $this->modelId = $modelId;
        

        $this->paie = PayementAgent::where('id', $this->modelId)->get();

        $this->contrat = Contrat::where('type', $this->paie[0]->type)->whereDate('fin','>=', $this->paie[0]->month)->where('active', true)->where('statut', true)->get();

    }

    public function render()
    {
        return view('livewire.rh.jp-form');
    }
}
