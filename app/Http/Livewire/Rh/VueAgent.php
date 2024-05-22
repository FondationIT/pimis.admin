<?php

namespace App\Http\Livewire\Rh;

use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Contrat;
use App\Models\StatutAgent;
use Livewire\Component;

class VueAgent extends Component
{
    public $modelId = null;
    public $agent;
    public $affectation;
    public $contrat;
    public $statut;
    protected $listeners = [
        'vueAgent'
    ];

    public function vueAgent($modelId){
        $this->modelId = $modelId;
        $this->agent = Agent::find($this->modelId);
        $this->statut = StatutAgent::where('agent', $modelId)->where('active', true)->get()[0];
        $this->affectation = Affectation::where('agent', $modelId)->where('active', true)->get();
        $this->contrat = Contrat::where('agent', $modelId)->where('statut', true)->whereDate('debut','<=', date("Y-m-d"))->whereDate('fin','>=', date("Y-m-d"))->get();
    }

    public function render()
    {
        return view('livewire.rh.vue-agent');
    }
}
