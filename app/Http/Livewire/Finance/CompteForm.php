<?php

namespace App\Http\Livewire\Finance;

use App\Models\Agent;
use App\Models\Compte;
use App\Models\Fournisseur;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CompteForm extends Component
{
    public $type;
    public $users = [];
    public $state;

    public function change($type)
    {
        if($type == 1){
            $this->users = Projet::where("active", true)->get();
        }elseif($type == 2){
            $this->users = Agent::where("active", true)->get();
        }elseif($type == 3){
            $this->users = Fournisseur::where("active", true)->get();
        }elseif($type == 4){
            $this->users = User::where("active", true)->get();
        }   
    }

    public function submit()
    {
        Validator::make($this->state, [
            'type' => ['required', 'max:255'],
            'prop' => ['required', 'max:255'],
            'int' => ['required', 'max:255'],
            'num' => ['required', 'max:255'],
            'banque' => ['required', 'max:255'],
            'adresse' => ['required', 'max:255']
        ])->validate();

        DB::beginTransaction();
        try {
            $ref = 'CMPT-'.$this->state['type'].rand(100000,999999).'-FP'.rand(100,999);

            Compte::create([
                'reference' => $ref,
                'signature' => Auth::user()->id,
                'intitule' => $this->state['int'],
                'type' => $this->state['type'],
                'numero' => $this->state['num'],
                'proprietaire' => $this->state['prop'],
                'banque' => $this->state['banque'],
                'adresse' => $this->state['adresse'],
                'solde' => 0
            ]);

            DB::commit();
            $this->reset('state');
            $this->emit('compteUpdated');
            $this->dispatchBrowserEvent('formSuccess');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.finance.compte-form');
    }
}
