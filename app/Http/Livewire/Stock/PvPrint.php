<?php

namespace App\Http\Livewire\Stock;

use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\Pv;

use Livewire\Component;

class PvPrint extends Component
{

    public $modelId;
    public $products;
    public $das;
    public $some;
    public $pvs;
    public $i = 1;

    protected $listeners = [
        'printPv'
    ];

    public function printPv($modelId){
        $this->modelId = $modelId;

        $this->pvs = Pv::where("id", $this->modelId)->get();
        //$this->products = ProductOder::where("etatBes", $this->das[0]->eb)->orderBy("id", "DESC")->get();

    }

    public function render()
    {
        return view('livewire.stock.pv-print');
    }
}
