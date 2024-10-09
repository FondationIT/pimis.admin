<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Proforma;
use App\Models\Agent;
use App\Models\Bailleur;
use App\Models\Projet;
use Livewire\Component;

class PvForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $proforma = [];
    public $product = [];
    public $da;
    public $ebs;
    public $some = 0;
    public $bailleur;
    protected $listeners = [
        'formPV',
    ];
    public function formPV($modelId){
        $this->modelId = $modelId;

        $this->da =DemAch::where("id", $this->modelId)->get();

        $this->proforma = Proforma::where("da", $this->modelId)->get();

        $this->product = ProductOder::where("etatBes", $this->da[0]->eb)->get();

        $this->ebs = Et_bes::where("id", $this->da[0]->eb)->get();
        $projet = Projet::where("id", $this->ebs[0]->projet)->get();
        $this->bailleur = Bailleur::where("id", $projet[0]->bailleur)->get();

        $this->some  = ProductOder::join('prices', 'prices.product', '=', 'product_oders.description')
        ->selectRaw("prices.prix * product_oders.quantite as price")
        ->where('product_oders.etatBes', $this->da[0]->eb)
        ->whereDate('prices.debut','<=', $this->da[0]->created_at)->whereDate('prices.fin','>=', $this->da[0]->created_at)
        ->get('price')
        ->sum('price');

    }


    public function render()
    {
        return view('livewire.stock.pv-form',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
