<?php

namespace App\Http\Livewire\Stock;

use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Br;
use App\Models\Et_bes;
use App\Models\Fournisseur;
use App\Models\ProductOder;
use App\Models\Projet;
use App\Models\Pv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class BrForm extends Component
{

    public $bc;
    public $da;
    public $eb;
    public $projet;
    public $pv;
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
        $this->pv = Pv::where("da", $this->da[0]->id)->get();
        $this->fournisseur = Fournisseur::where("id", $this->pv[0]->fournisseur)->get();
        $this->product = ProductOder::where("etatBes", $this->da[0]->eb)->get();


    }

   

    public function render()
    {
        return view('livewire.stock.br-form');
    }
}
