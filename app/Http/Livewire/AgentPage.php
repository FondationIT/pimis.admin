<?php

namespace App\Http\Livewire;

use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Contrat;
use App\Models\StatutAgent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AgentPage extends Component
{
    public $modelId;
    
    public function render()
    {
        $this->modelId = Auth::user()->agent;
        return view('livewire.agent-page',[
            'agent' => Agent::find($this->modelId),
            'statut' => StatutAgent::where('agent', $this->modelId)->where('active', true)->get()[0],
            'affectation' => Affectation::where('agent', $this->modelId)->where('active', true)->get(),
            'contrat' => Contrat::where('agent', $this->modelId)->where('statut', true)->whereDate('debut','<=', date("Y-m-d"))->whereDate('fin','>=', date("Y-m-d"))->get(),
            
        ]);
    }
}
