<?php

namespace App\Http\Livewire\Agent;
use App\Models\ProductOder;
use App\Models\Et_bes;

use Livewire\Component;

class EbPrint extends Component
{
    public $modelId;
    public $products;
    public $ebs;
    public $i = 1;

    protected $listeners = [
        'printEb'
    ];

    public function printEb($modelId){
        $this->modelId = $modelId;

        $this->products = ProductOder::where("etatBes", $this->modelId)->orderBy("id", "DESC")->get();
        $this->ebs = Et_bes::where("id", $this->modelId)->get();
    }



    public function render()
    {

        return view('livewire.agent.eb-print');
    }
}
