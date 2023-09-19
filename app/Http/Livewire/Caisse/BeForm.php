<?php

namespace App\Http\Livewire\Caisse;

use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Be;
use App\Models\Projet;
use App\Models\RCaisse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class BeForm extends Component
{
    public $modelId;
    public $state;

    protected $listeners = [
        'beForm'=> '$refresh'
    ];

    public function render()
    {
        return view('livewire.caisse.be-form',
        [
            'projet' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),
            'agent' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }

    public function submit()
    {
        
        $validator = Validator::make($this->state, [
            'montantTL' => ['required', 'max:255'],
            'agent' => ['required', 'max:255'],
            'projet' => ['required', 'max:255'],
            'motif' => ['required', 'max:255'],
            'montant' => ['required', 'max:255'],
        ])->validate();

        
        DB::beginTransaction();
        try {
            //code...
    
            $montant = $this->state['montant'];
            $ref = 'BE-'. $this->state['projet'].$this->state['agent'].''.rand(1000,9999);

            Be::create([
                'reference' => $ref,
                'signature' => Auth::user()->id,
                'agent' => $this->state['agent'],
                'projet' => $this->state['projet'],
                'montant' => $montant,
                'montantTL' => $this->state['montantTL'],
                'motif' => $this->state['motif'],
            ]);

            $sld = RCaisse::where('projet', $this->state['projet'] )->orderBy('created_at', 'desc')->first()->solde;

            $solde = $sld + $montant;

            $ref2 = 'RC-'. $this->state['projet'].$this->state['agent'].''.rand(1000,9999);
            RCaisse::create([
                'reference' => $ref2,
                'projet' => $this->state['projet'],
                'solde' => $solde,
            ]);

            DB::commit();
            $this->reset('state');
            $this->modelId = null;
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('beUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
