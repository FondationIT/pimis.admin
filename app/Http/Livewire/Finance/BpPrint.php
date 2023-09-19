<?php

namespace App\Http\Livewire\Finance;

use App\Models\Bc;
use App\Models\Bp;
use App\Models\Compte;
use App\Models\DemAch;
use App\Models\Et_bes;
use App\Models\FournPrice;
use App\Models\Nd;
use App\Models\NdOder;
use App\Models\prixPv;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\RCaisse;
use App\Models\Tr;
use App\Models\TrOder;
use App\Models\ValidBc;
use App\Models\ValidBp;
use Livewire\Component;

class BpPrint extends Component
{

    public $modelId;
    public $products;
    public $das;
    public $compte =[];
    public $some;
    public $bcs;
    public $bps =[];
    public $index;
    public $pvs;
    public $odrs;
    public $prof;
    public $valid1;
    public $valid2;
    public $valid3;
    public $i = 1;
    
    protected $listeners = [
        'printBp'
    ];

    public function printBp($modelId){
        $this->modelId = $modelId;

        $this->bps = Bp::where("id", $this->modelId)->get();

        

        if($this->bps[0]->categorie == 2){
            $this->bcs = Bc::where("id", $this->bps[0]->bc)->get();
            $this->das = DemAch::where("id", $this->bcs[0]->da)->get();
            $this->index = Et_bes::where("id", $this->das[0]->eb)->get();
            $this->odrs = ProductOder::where("etatBes", $this->index[0]->id)->get();
            

            if(Pv::where("da", $this->bcs[0]->da)->exists()){
                $this->pvs = Pv::where("da", $this->bcs[0]->da)->get();

                $this->compte = Compte::where("type", 2)->where("proprietaire", $this->pvs[0]->fournisseur)->get();
    
                $this->prof = Proforma::where("id", $this->pvs[0]->fournisseur)->where("da", $this->pvs[0]->da)->get();
    
                $this->products = prixPv::where("pv", $this->pvs[0]->id)->where("proforma", $this->prof[0]->id)->orderBy("id", "DESC")->get();
    
                
    
                $this->some  = PrixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.description')
                    ->selectRaw("prix_pvs.prix * product_oders.quantite as price")
                    ->where("prix_pvs.pv", $this->pvs[0]->id)
                    ->where("proforma", $this->prof[0]->id)
                    ->where("product_oders.etatBes", $this->index[0]->id)
                    ->get('price')
                    ->sum('price');
            }elseif (FournPrice::where("product", $this->odrs[0]->description)->exists()) {
                
                $this->prof = FournPrice::where("product", $this->odrs[0]->description)->get();

                $this->compte = Compte::where("type", 2)->where("proprietaire", $this->prof[0]->fournisseur)->get();
    
                $this->products = ProductOder::join('fourn_prices', 'fourn_prices.product', '=', 'product_oders.description')
                    ->selectRaw("product_oders.description as produit,fourn_prices.prix as prix")
                    ->where("fourn_prices.product", $this->odrs[0]->description)
                    ->where("product_oders.etatBes", $this->index[0]->id)
                    ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                    ->get();
    
    
                $this->some  = FournPrice::join('product_oders', 'fourn_prices.product', '=', 'product_oders.description')
                    ->selectRaw("fourn_prices.prix * product_oders.quantite as price")
                    ->where("fourn_prices.product", $this->odrs[0]->description)
                    ->where("product_oders.etatBes", $this->index[0]->id)
                    ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                    ->get('price')
                    ->sum('price');
    
            }
        }elseif($this->bps[0]->categorie == 3){
            $this->index = Tr::where("id", $this->bps[0]->bc)->get();
            $this->products = TrOder::where("tr", $this->index[0]->id)->get();
            $this->some = TrOder::where('tr',$this->bps[0]->bc)->selectRaw("prix * quantite as price")->get('price')->sum('price');
            $this->compte = Compte::where("type", 2)->where("proprietaire", 1)->get();

        }elseif($this->bps[0]->categorie == 4){
            $this->index = Nd::where("id", $this->bps[0]->bc)->get();
            $this->products = NdOder::where("nd", $this->index[0]->id)->get();
            $this->some = NdOder::where('nd',$this->bps[0]->bc)->selectRaw("prix * quantite as price")->get('price')->sum('price');

            $this->compte = Compte::where("type", 1)->where("proprietaire", 1)->get();

        }elseif($this->bps[0]->categorie == 5){
            $this->index = RCaisse::where("id", $this->bps[0]->bc)->get();
            $this->products = [];
            $this->some = $this->bps[0]->montant;

        }

        $this->valid1 = ValidBp::where("bp", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidBp::where("bp", $this->modelId)->where("niv", 2)->get();
        $this->valid3 = ValidBp::where("bp", $this->modelId)->where("niv", 3)->get();
        

        

    }
    public function render()
    {
        return view('livewire.finance.bp-print');
    }
}
