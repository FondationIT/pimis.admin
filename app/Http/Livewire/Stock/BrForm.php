<?php

namespace App\Http\Livewire\Stock;

use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Br;
use App\Models\Et_bes;
use App\Models\Fournisseur;
use App\Models\FournPrice;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\Projet;
use App\Models\Pv;
use App\Models\PvAttr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class BrForm extends Component
{

    public $bc;
    public $da;
    public $pvAttr;
    public $eb;
    public $projet;
    public $fournisseur;
    public $modelId;
    public $product =[];

    protected $listeners = [
        'formBR'
    ];

    public function formBR($modelId){
        $this->modelId = $modelId;

        $this->bc = Bc::where("id", $this->modelId)->get();
        $this->da = DemAch::where("id", $this->bc[0]->da)->get();
        $this->eb = Et_bes::where("id", $this->da[0]->eb)->get();
        $this->projet = Projet::where("id", $this->eb[0]->projet)->get();

        $this->pvAttr = PvAttr::where("da", $this->bc[0]->da)->get();

        

        $this->product = ProductOder::join('select_pvs', 'select_pvs.produit', '=', 'product_oders.description')
             ->where("etatBes", $this->da[0]->eb)
             ->where("select_pvs.pv", $this->pvAttr[0]->id)
             ->where("select_pvs.proforma", $this->bc[0]->proforma)
             ->get();

        if (Pv::where("da", $this->da[0]->id)->exists()) {
            $pv = Pv::where("da", $this->da[0]->id)->get();
            $fourn = Proforma::where("id", $this->bc[0]->proforma)->get();
            $this->fournisseur = Fournisseur::where("id", $fourn[0]->fournisseur)->get();

        }else{
            $fourn = FournPrice::where("product", $this->product[0]->description)->get();
            $this->fournisseur = Fournisseur::where("id", $fourn[0]->fournisseur)->get();
        }


        
        


    }

   

    public function render()
    {
        return view('livewire.stock.br-form');
    }
}
