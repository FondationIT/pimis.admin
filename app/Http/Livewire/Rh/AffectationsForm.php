<?php

namespace App\Http\Livewire\Rh;

use Livewire\Component;
use App\Models\Projet;
use App\Models\Agent;
use App\Models\Affectation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AffectationsForm extends Component
{


    public $state = [];
    public $modelId = null;
    protected $listeners = [
        'affectationForm',
        'editAffectation',
    ];

    public function affectationForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editAffectation($modelId){
        $this->modelId = $modelId;

        $model = Affectation::find($this->modelId);
        $this->state['agent'] = $model->agent;
        $this->state['projet'] = $model->projet;
        $this->state['cath'] = $model->cath;
        $this->state['poste'] = $model->poste;
        $this->state['lieu'] = $model->lieu;
        $this->state['description'] = $model->description;
    }

    public function submit()
    {





        if ($this->modelId != null) {

            //$this->validate();
            $validator = Validator::make($this->state, [
                'agent' => ['required', 'string', 'max:255'],
                'projet' => ['required', 'string', 'max:255'],
                'poste' => ['required', 'string', 'max:255'],
                'lieu' => ['required', 'string', 'max:255'],
                'cath' => ['required', 'string', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {

                Affectation::find($this->modelId)->update([
                    'agent' => $this->state['agent'],
                    'projet' => $this->state['projet'],
                    'cath' => $this->state['cath'],
                    'poste' => $this->state['poste'],
                    'lieu' => $this->state['lieu'],
                    'description' => $this->state['description'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('affectationUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            //$this->validate();
            $validator = Validator::make($this->state, [
                'agent' => ['required', 'string', 'max:255'],
                'projet' => ['required', 'string', 'max:255'],
                'cath' => ['required', 'string', 'max:255'],
                'poste' => ['required', 'string', 'max:255'],
                'lieu' => ['required', 'string', 'max:255'],
            ])->validate();

            // Execution doesn't reach here if validation fails.
            DB::beginTransaction();
            try {

                $reference = 'AFCT-'.substr($this->state['agent'], 0, 1).''.Auth::user()->id.''.rand(100000,999999).''.substr($this->state['projet'], 0, 1);

                $data_create = Affectation::create([
                    'reference' => $reference,
                    'agent' => $this->state['agent'],
                    'projet' => $this->state['projet'],
                    'cath' => $this->state['cath'],
                    'poste' => $this->state['poste'],
                    'lieu' => $this->state['lieu'],
                    'description' => $this->state['description'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('affectationUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        return view('livewire.rh.affectations-form',[
            'agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),
            'projets' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
