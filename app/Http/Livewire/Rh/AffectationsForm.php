<?php

namespace App\Http\Livewire\Rh;

use Livewire\Component;
use App\Models\Projet;
use App\Models\Agent;
use App\Models\Affectation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AffectationsForm extends Component
{


    public $state = [];
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
        $this->state['poste'] = $model->poste;
        $this->state['lieu'] = $model->lieu;
        $this->state['description'] = $model->description;
    }

    public function submit()
    {





        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255','unique:bailleurs'],
            ])->validate();

            DB::beginTransaction();
            try {

                $ref = 'PJ-'.substr($this->state['name'], 0, 1).''.rand(1000,9999);


                Bailleur::find($this->modelId)->update([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('bailleurUpdated');
            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255','unique:bailleurs'],
                'email' => ['required', 'string', 'max:255', 'unique:bailleurs'],
                'phone' => ['required', 'string', 'max:20','unique:bailleurs'],
            ])->validate();

            DB::beginTransaction();
            try {

                $data_create = Bailleur::create([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('bailleurUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }






        //$this->validate();
        $validator = Validator::make($this->state, [
            'agent' => ['required', 'string', 'max:255'],
            'projet' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
            'lieu' => ['required', 'string', 'max:255'],
        ])->validate();

        // Execution doesn't reach here if validation fails.
        DB::beginTransaction();
        try {

            $data_create = Affectation::create([
                'agent' => $this->state['agent'],
                'projet' => $this->state['projet'],
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
    }

    public function render()
    {
        return view('livewire.rh.affectations-form',[
            'agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),
            'projets' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
