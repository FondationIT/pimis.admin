<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Proforma;
use App\Models\Agent;

use Livewire\Component;

class PvForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $proforma = [];
    public $product = [];
    public $da;
    protected $listeners = [
        'formPV',
    ];
    public function formPV($modelId){
        $this->modelId = $modelId;

        $this->da =DemAch::where("id", $this->modelId)->get();

        $this->proforma = Proforma::where("da", $this->modelId)->get();

        $this->product = ProductOder::where("etatBes", $this->da[0]->eb)->get();



    }


    public function render()
    {
        return view('livewire.stock.pv-form',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
