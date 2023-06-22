<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Fournisseur;
use App\Models\Projet;
use App\Models\Bailleur;

use Livewire\Component;

class ProformaForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $some = 0;
    public $da;
    public $ebs;
    public $bailleur;
    public $fournisseurs =[];
    protected $listeners = [
        'formProforma',
    ];
    public function formProforma($modelId){
        $this->modelId = $modelId;

        $this->da =DemAch::where("id", $this->modelId)->get();

        $das = DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
        ->where("dem_aches.id", $this->modelId)->get();

        $this->fournisseurs =Fournisseur::where("catProduct", $das[0]->categorie)->get();

        $bb = json_encode( $this->fournisseurs);

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
        return view('livewire.stock.proforma-form');
    }
}
