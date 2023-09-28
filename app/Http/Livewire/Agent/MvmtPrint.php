<?php

namespace App\Http\Livewire\Agent;

use App\Models\Mouvement;
use App\Models\ValidMvnt;
use Livewire\Component;

class MvmtPrint extends Component
{

    public $modelId;
    public $mvnt=[];
    public $valid1=[];
    public $valid2=[];

    protected $listeners = [
        'printMvnt'
    ];

    public function printMvnt($modelId){
        $this->modelId = $modelId;

        $this->mvnt = Mouvement::where("id", $this->modelId)->get();
        $this->valid1 = ValidMvnt::where("mvnt", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidMvnt::where("mvnt", $this->modelId)->where("niv", 2)->get();
    }

    public function render()
    {
        return view('livewire.agent.mvmt-print');
    }
}
