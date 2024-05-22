<?php

namespace App\Http\Livewire\Finance;

use App\Models\Bp;
use App\Models\Cheque;
use App\Models\Compte;
use App\Models\Fournisseur;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ChequeForm extends Component
{


    public $state = [];
    public $modelId = null;
    public $bps;

    protected $listeners = [
        'formCheque'
    ];

    public function formCheque($modelId){
        $this->modelId = $modelId;

        $this->bps = Bp::where("id", $this->modelId)->get();

        $this->state['don'] = Projet::where('id',$this->bps[0]->projet)->get()[0]->name;
        $this->state['cDon'] = Compte::where('proprietaire',$this->bps[0]->projet)->where('type',1)->get()[0]->numero;

        if($this->bps[0]->categorie == 4){
            $this->state['ben'] = Projet::where('id',$this->bps[0]->beneficiaire)->get()[0]->name;
        }
        else if($this->bps[0]->categorie == 3){
            $this->state['ben'] = Fournisseur::where('id',$this->bps[0]->beneficiaire)->get()[0]->name;
        }
        else if($this->bps[0]->categorie == 5){
            $this->state['ben'] = 'Caisse projet';
        }
        $this->state['montant'] = $this->bps[0]->montant;
    }


    public function submit()
    {
        Validator::make($this->state, [
            'num' => ['required', 'max:255'],
            'lieu' => ['required', 'max:255'],
            'motif' => ['required', 'max:255'],
        ])->validate();

        DB::beginTransaction();
        try {
            $ref = 'CQ-'.rand(100000,999999).'-FP'.rand(100,999);

            Cheque::create([
                'reference' => $ref,
                'agent' => Auth::user()->id,
                'projet' => $this->bps[0]->projet,
                'bp' => $this->bps[0]->id,
                'beneficiare' => $this->state['ben'],
                'numero' => $this->state['num'],
                'lieu' => $this->state['lieu'],
                'montant' => $this->state['montant'],
                'motif' => $this->state['motif']
            ]);

            DB::commit();
            $this->reset('state');
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('bpUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }



    public function render()
    {
        return view('livewire.finance.cheque-form');
    }
}
