<?php

namespace App\Http\Livewire\Stock;

use App\Models\Agent;
use App\Models\DemAch;
use App\Models\ProductOder;
use App\Models\Proforma;
use Livewire\Component;

class PvAttrForm extends Component
{

    public $modelId = null;
    public $proforma = [];
    public $product = [];
    public $pv = [];
    public $da;
    protected $listeners = [
        'formPVAttr',
    ];
    public function formPVAttr($modelId){
        $this->modelId = $modelId;

        $this->da =DemAch::where("id", $this->modelId)->get();

        $this->proforma = Proforma::where("da", $this->modelId)->get();

        $this->pv = Proforma::where("da", $this->modelId)->get();

        $this->product = ProductOder::where("etatBes", $this->da[0]->eb)->get();



    }

    public function render()
    {
        return view('livewire.stock.pv-attr-form', ['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
