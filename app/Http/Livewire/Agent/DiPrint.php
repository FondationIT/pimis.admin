<?php

namespace App\Http\Livewire\Agent;

use App\Models\Di;
use App\Models\DiOder;
use App\Models\ValidDi;
use Livewire\Component;

class DiPrint extends Component
{
    public $modelId;
    public $products;
    public $dis=[];
    public $valid1=[];
    public $valid2=[];
    public $i = 1;

    protected $listeners = [
        'printEb'
    ];

    public function printEb($modelId){
        $this->modelId = $modelId;

        $this->products = DiOder::where("di", $this->modelId)->orderBy("id", "DESC")->get();
        $this->dis = Di::where("id", $this->modelId)->get();
        $this->valid1 = ValidDi::where("eb", $this->modelId)->where("niv", 1)->get();
    }
    public function render()
    {
        return view('livewire.agent.di-print');
    }
}
