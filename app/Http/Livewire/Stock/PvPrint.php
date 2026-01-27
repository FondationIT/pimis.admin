<?php

namespace App\Http\Livewire\Stock;

use App\Models\Bailleur;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\Proforma;
use App\Models\Projet;
use App\Models\Pv;
use App\Models\PvCommissionersConcents;
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
    public $bailleur;
    public $ebs;
    public $i = 1;
    public $commissionMembers = [];

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

        $this->ebs = Et_bes::where("id", $this->da[0]->eb)->get();
        $projet = Projet::where("id", $this->ebs[0]->projet)->get();
        $this->bailleur = Bailleur::where("id", $projet[0]->bailleur)->get();

        $this->some  = ProductOder::join('prices', 'prices.product', '=', 'product_oders.description')
        ->selectRaw("prices.prix * product_oders.quantite as price")
        ->where('product_oders.etatBes', $this->da[0]->eb)
        ->whereDate('prices.debut','<=', $this->da[0]->created_at)->whereDate('prices.fin','>=', $this->da[0]->created_at)
        ->get('price')
        ->sum('price');

        $PvComInstance = PvCommissionersConcents::where('pv', $modelId)->leftJoin('users', 'users.agent', '=', 'pv_commissioners_concents.agent');
        if($PvComInstance->exists()){
            $this->commissionMembers = $PvComInstance->select('users.name', 'pv_commissioners_concents.is_approved', 'users.signature')
            ->get();
        }
    }

    public function render()
    {
        return view('livewire.stock.pv-print');
    }
}
