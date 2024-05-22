<?php

namespace App\Http\Livewire\Stock;

use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\signaturePv;
use Livewire\Component;

class PvPrint extends Component
{

    public $modelId;
    public $product;
    public $da;
    public $some;
    public $proforma;
    public $agent;
    public $pvs;
    public $i = 1;

    protected $listeners = [
        'printPv'
    ];

    public function printPv($modelId){
        $this->modelId = $modelId;

        $this->pvs = Pv::where("id", $this->modelId)->get();
        //$this->products = ProductOder::where("etatBes", $this->das[0]->eb)->orderBy("id", "DESC")->get();

        $this->da =DemAch::where("id", $this->pvs[0]->da)->get();

        $this->proforma = Proforma::where("da", $this->pvs[0]->da)->get();

        $this->product = ProductOder::where("etatBes", $this->da[0]->eb)->get();

        $this->agent = signaturePv::where("pv", $modelId)->get();

    }

    public function render()
    {
        return view('livewire.stock.pv-print');
    }
}
