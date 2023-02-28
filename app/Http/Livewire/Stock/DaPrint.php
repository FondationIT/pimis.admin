<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;

use Livewire\Component;

class DaPrint extends Component
{
    public $modelId;
    public $products;
    public $ebs;
    public $das;
    public $i = 1;

    protected $listeners = [
        'printDa'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;

        $this->das = DemAch::where("id", $this->modelId)->get();
        $this->products = ProductOder::where("etatBes", $this->das[0]->eb)->orderBy("id", "DESC")->get();
        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();
    }

    public function render()
    {
        return view('livewire.stock.da-print');
    }
}
