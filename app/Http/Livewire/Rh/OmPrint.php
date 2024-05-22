<?php

namespace App\Http\Livewire\Rh;

use App\Models\AgentMission;
use App\Models\Mission;
use Livewire\Component;

class OmPrint extends Component
{
    public $modelId;
    public $ms=[];
    public $agent=[];

    protected $listeners = [
        'printMission'
    ];

    public function printMission($modelId){
        $this->modelId = $modelId;
        $this->ms = Mission::where("id", $this->modelId)->get();
        $this->agent = AgentMission::where("ms", $this->modelId)->get();
    }
    public function render()
    {
        return view('livewire.rh.om-print');
    }
}
