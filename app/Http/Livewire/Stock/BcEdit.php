<?php

namespace App\Http\Livewire\Stock;

use App\Models\DemAch;
use App\Models\PvAttr;
use App\Models\SelectPv;
use Livewire\Component;

class BcEdit extends Component
{
    public $da;
    public $pv;
    public $modelId;
    public $proforma=[];

    protected $listeners = [
        'editBC'
    ];

    public function editBC($modelId){
        $this->modelId = $modelId;

        $this->da = DemAch::where("id", $this->modelId)->get();

        $this->pv = PvAttr::where("da", $this->modelId)->get();
        $this->proforma = SelectPv::where("pv", $this->pv[0]->id)->get();

    }
    public function formBC($modelId,$modelProf){  
        $this->emit('formBC',$modelId,$modelProf);
    }
    public function render()
    {
        return view('livewire.stock.bc-edit');
    }
}
