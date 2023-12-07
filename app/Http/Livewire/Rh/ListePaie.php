<?php

namespace App\Http\Livewire\Rh;

use App\Models\ListePaie as ModelsListePaie;
use App\Models\PayementAgent;
use App\Models\ValidPaie;
use Livewire\Component;

class ListePaie extends Component
{
    public $modelId = null;
    public $agents;
    public $lp;
    public $i = 1;

    
    public $valid1=[];
    public $valid2=[];
    protected $listeners = [
        'listePaieAf',
    ];

    public function listePaieAf($modelId){
        $this->modelId = $modelId;
        

        $this->lp = PayementAgent::where("id", $this->modelId)->get();
        $this->agents = ModelsListePaie::where("pymt", $this->modelId)->orderBy("id", "DESC")->get();

        $this->valid1 = ValidPaie::where("paie", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidPaie::where("paie", $this->modelId)->where("niv", 2)->get();

    }

    public function render()
    {
        return view('livewire.rh.liste-paie');
    }
}
