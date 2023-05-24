<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\Pv;
use App\Models\Proforma;
use App\Models\PrixPv;
use App\Models\ValidBc;

use Livewire\Component;

class BcPrint extends Component
{
    public $modelId;
    public $products;
    public $das;
    public $some;
    public $bcs;
    public $ebs;
    public $pvs;
    public $i = 1;

    protected $listeners = [
        'printBc'
    ];

    public function printBc($modelId){
        $this->modelId = $modelId;

        $this->bcs = Bc::where("id", $this->modelId)->get();
        $this->das = DemAch::where("id", $this->bcs[0]->da)->get();
        $this->pvs = Pv::where("da", $this->bcs[0]->da)->get();

        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();

        $prof = Proforma::where("fournisseur", $this->pvs[0]->fournisseur)->where("da", $this->pvs[0]->da)->get();

        $this->products = PrixPv::where("pv", $this->pvs[0]->id)->where("proforma", $prof[0]->id)->orderBy("id", "DESC")->get();

        $this->valid1 = ValidBc::where("bc", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidBc::where("bc", $this->modelId)->where("niv", 2)->get();

        $this->some  = PrixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.product')
            ->selectRaw("prix_pvs.prix * product_oders.quantite as price")
            ->where("prix_pvs.pv", $this->pvs[0]->id)
            ->where("proforma", $prof[0]->id)
            ->get('price')
            ->sum('price');

    }

    public function render()
    {
        return view('livewire.stock.bc-print');
    }
}
