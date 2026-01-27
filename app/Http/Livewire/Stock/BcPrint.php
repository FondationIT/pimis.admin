<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\FournPrice;
use App\Models\Pv;
use App\Models\Proforma;
use App\Models\PrixPv;
use App\Models\PvAttr;
use App\Models\SelectPv;
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
    public $pvAttr;
    public $odrs;
    public $prof;
    public $valid1;
    public $valid2;
    public $i = 1;

    protected $listeners = [
        'printBc'
    ];

    public function printBc($modelId){
        $this->modelId = $modelId;

        $this->bcs = Bc::where("id", $this->modelId)->get();
        $this->das = DemAch::where("id", $this->bcs[0]->da)->get();
        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();

        $this->valid1 = ValidBc::where("bc", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidBc::where("bc", $this->modelId)->where("niv", 2)->get();
        $this->odrs = ProductOder::where("etatBes", $this->ebs[0]->id)->get();

        if(Pv::where("da", $this->bcs[0]->da)->exists()){
            $this->pvs = Pv::where("da", $this->bcs[0]->da)->get();
            $this->pvAttr = PvAttr::where("da", $this->bcs[0]->da)->get();

            $this->prof = Proforma::where("id", $this->bcs[0]->proforma)->where("da", $this->bcs[0]->da)->get();

            //$this->products = PrixPv::where("pv", $this->pvs[0]->id)->where("proforma", $this->prof[0]->id)->orderBy("id", "DESC")->get();

            $this->products = SelectPv::where("pv", $this->pvAttr[0]->id)->where("proforma", $this->prof[0]->id)->orderBy("id", "DESC")->get();

            

            // $this->some  = PrixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.description')
            //     ->join('select_pvs', 'prix_pvs.produit', '=', 'select_pvs.produit')
            //     ->selectRaw("prix_pvs.prix * product_oders.quantite as price")
            //     ->where("select_pvs.pv", $this->pvAttr[0]->id)
            //     ->where("select_pvs.proforma", $this->prof[0]->id)
            //     ->where("prix_pvs.pv", $this->pvs[0]->id)
            //     ->where("prix_pvs.proforma", $this->prof[0]->id)
            //     ->where("product_oders.etatBes", $this->ebs[0]->id)
            //     ->get('price')
            //     ->sum('price');
        }elseif (FournPrice::where("product", $this->odrs[0]->description)->exists()) {
            
            $this->prof = FournPrice::where("product", $this->odrs[0]->description)->get();

            $this->products = ProductOder::join('fourn_prices', 'fourn_prices.product', '=', 'product_oders.description')
                ->selectRaw("product_oders.description as produit,fourn_prices.prix as prix")
                ->where("fourn_prices.product", $this->odrs[0]->description)
                ->where("product_oders.etatBes", $this->ebs[0]->id)
                ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                ->get();


            $this->some  = FournPrice::join('product_oders', 'fourn_prices.product', '=', 'product_oders.description')
                ->selectRaw("fourn_prices.prix * product_oders.quantite as price")
                ->where("fourn_prices.product", $this->odrs[0]->description)
                ->where("product_oders.etatBes", $this->ebs[0]->id)
                ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                ->get('price')
                ->sum('price');

        }

    }
    

    public function render()
    {
        return view('livewire.stock.bc-print');
    }
}
