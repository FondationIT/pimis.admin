<?php

namespace App\Http\Livewire\Caisse;

use App\Models\Bp;
use App\Models\Decharge;
use App\Models\LivreCaisse;
use App\Models\Projet;
use App\Models\RCaisse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class DechargeForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $bps;
    public $some;
    public $solde;

    protected $listeners = [
        'formDecharge'
    ];

    public function formDecharge($modelId){
        $this->modelId = $modelId;

        $this->bps = Bp::where("id", $this->modelId)->get();

        $this->state['don'] = Projet::where('id',$this->bps[0]->projet)->get()[0]->name;

        $this->state['montantBp'] = $this->bps[0]->montant;

        $y = Decharge::where('bp', $this->modelId)->get('montant')->sum('montant');

        $this->some = $this->bps[0]->montant;
        $this->solde = $this->bps[0]->montant - $y;

        $this->state['soldeBp'] = $this->solde;
    }

    public function submit()
    {
        Validator::make($this->state, [
            'ben' => ['required', 'max:255'],
            'qualite' => ['required', 'max:255'],
            'pid' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'montant' => ['required', 'max:255'],
            'inst' => ['required', 'max:255'],
            'montantTL' => ['required', 'max:255'],
            'motif' => ['required', 'max:255'],
        ])->validate();

        DB::beginTransaction();
        try {
            $ref = 'DCG-'.rand(100000,999999).'-FP'.rand(100,999);
            $sld = RCaisse::where('projet', $this->bps[0]->projet )->orderBy('created_at', 'desc')->first()->solde;

            if($sld >= $this->state['montant']){

                Decharge::create([
                    'reference' => $ref,
                    'signature' => Auth::user()->id,
                    'projet' => $this->bps[0]->projet,
                    'bp' => $this->bps[0]->id,
                    'beneficiare' => $this->state['ben'],
                    'qualite' => $this->state['qualite'],
                    'piece' => $this->state['pid'],
                    'montant' => $this->state['montant'],
                    'phone' => $this->state['phone'],
                    'institution' => $this->state['inst'],
                    'montantTL' => $this->state['montantTL'],
                    'motif' => $this->state['motif']
                ]);

                $ref1 = 'LVC-'.$ref;
                $index = Decharge::firstWhere('reference', $ref )->id;
                LivreCaisse::create([
                    'reference' => $ref1,
                    'signature' => Auth::user()->id,
                    'projet' => $this->bps[0]->projet,
                    'index' => $index,
                    'type' => 21,//Decharge//
                    'sortie' => $this->state['montant'],
                    'libelle' => $this->state['motif'],
                ]);

                

                $solde = $sld - $this->state['montant'];

                $ref2 = 'RC-'. $this->bps[0]->projet.$this->bps[0]->id.''.rand(1000,9999);
                RCaisse::create([
                    'reference' => $ref2,
                    'projet' => $this->bps[0]->projet,
                    'solde' => $solde,
                ]);
            }

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
        return view('livewire.caisse.decharge-form');
    }
}
