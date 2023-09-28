<?php

namespace App\Http\Livewire\Agent;

use App\Models\Conge;
use App\Models\ValidConge;
use Livewire\Component;

class CongePrint extends Component
{

    public $modelId;
    public $conge=[];
    public $valid1=[];
    public $valid2=[];

    protected $listeners = [
        'printConge'
    ];

    public function printConge($modelId){
        $this->modelId = $modelId;

        $this->conge = Conge::where("id", $this->modelId)->get();
        $this->valid1 = ValidConge::where("conge", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidConge::where("conge", $this->modelId)->where("niv", 2)->get();
    }
    public function render()
    {
        return view('livewire.agent.conge-print');
    }
}
