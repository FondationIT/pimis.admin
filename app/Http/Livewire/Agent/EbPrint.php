<?php

namespace App\Http\Livewire\Agent;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\Ligne;
use App\Models\ValidEb;

use Livewire\Component;

class EbPrint extends Component
{
    public $modelId;
    public $products;
    public $ebs=[];
    public $valid1=[];
    public $valid2=[];
    public $i = 1;
    public $ligne;

    protected $listeners = [
        'printEb'
    ];

    public function printEb($modelId){
        $this->modelId = $modelId;

        $this->products = ProductOder::where("etatBes", $this->modelId)->orderBy("id", "DESC")->get();
        $this->ebs = Et_bes::where("id", $this->modelId)->get();
        $this->valid1 = ValidEb::where("eb", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidEb::where("eb", $this->modelId)->where("niv", 2)->get();
        $this->ligne = Ligne::where("code", $this->ebs[0]->ligne)->get();
    }



    public function render()
    {

        return view('livewire.agent.eb-print');
    }
}
