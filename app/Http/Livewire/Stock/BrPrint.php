<?php

namespace App\Http\Livewire\Stock;

use App\Models\Bc;
use App\Models\Br;
use App\Models\BrOder;
use App\Models\DemAch;
use App\Models\Et_bes;
use App\Models\Fournisseur;
use App\Models\FournPrice;
use App\Models\Proforma;
use App\Models\Pv;
use Livewire\Component;

class BrPrint extends Component
{

    public $modelId;
    public $products;
    public $ebs;
    public $das;
    public $br;
    public $bc;
    public $fournisseur;
    public $i = 1;

    public $valid1;

    protected $listeners = [
        'printBr'
    ];

    public function printBr($modelId){
        $this->modelId = $modelId;

        $this->br = Br::where("id", $this->modelId)->get();
        $this->bc = Bc::where("id", $this->br[0]->bc)->get();
        $this->das = DemAch::where("id", $this->bc[0]->da)->get();
        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();

        $this->products = BrOder::where("br", $modelId)->orderBy("id", "DESC")->get();

        $article = BrOder::where("br", $this->br[0]->id)->get();

        if (FournPrice::where("product", $article[0]->poduit)->exists()) {

            $prf = FournPrice::where("product", $article[0]->produit)->get();
            $this->fournisseur = Fournisseur::where("id", $prf[0]->fournisseur)->get();

        }else if(Pv::where("da", $this->das[0]->id)->exists()){

            $pv = Pv::where("da", $this->das[0]->id)->get();
            $fourn = Proforma::where("id", $this->bc[0]->proforma)->get();
            $this->fournisseur = Fournisseur::where("id", $fourn[0]->fournisseur)->get();

        }


    }

    public function render()
    {
        return view('livewire.stock.br-print');
    }
}
