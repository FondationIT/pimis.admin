<?php

namespace App\Http\Livewire\Rh;

use App\Models\ListePaie as ModelsListePaie;
use App\Models\PayementAgent;
use App\Models\Projet;
use App\Models\ValidPaie;
use Livewire\Component;

class ListePaie extends Component
{
    public $modelId = null;
    public $projet;
    public $agents;
    public $lp;
    public $some = 0;
    public $i = 1;

    
    public $valid1=[];
    public $valid2=[];
    protected $listeners = [
        'listePaieAf',
        'listePaieAf2',
    ];

    public function listePaieAf($modelId){
        $this->modelId = $modelId;
        

        $this->lp = PayementAgent::where("id", $this->modelId)->get();
        $this->agents = ModelsListePaie::where("pymt", $this->modelId)->orderBy("id", "DESC")->get();

        $this->valid1 = ValidPaie::where("paie", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidPaie::where("paie", $this->modelId)->where("niv", 2)->get();

    }

    public function listePaieAf2($modelId,$projet){
        $this->modelId = $modelId;
        $this->projet = Projet::where("id", $projet)->get();
        

        $this->lp = PayementAgent::where("id", $this->modelId)->get();
        $this->agents = ModelsListePaie::join('contrats', 'contrats.id', '=', 'liste_paies.contrat')
            ->where("liste_paies.pymt", $this->modelId)
            ->where('contrats.projet', $projet)
            ->orderBy("liste_paies.id", "DESC")->get();

        $this->valid1 = ValidPaie::where("paie", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidPaie::where("paie", $this->modelId)->where("niv", 2)->get();

    }

    public function render()
    {
        return view('livewire.rh.liste-paie');
    }
}
