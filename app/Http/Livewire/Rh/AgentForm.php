<?php

namespace App\Http\Livewire\Rh;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class AgentForm extends Component
{
    public $state = [];
    public $modelId = null;
    protected $listeners = [
        'agentForm',
        'editAgent',
    ];

    public function agentForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editAgent($modelId){
        $this->modelId = $modelId;

        $model = Agent::find($this->modelId);
        $this->state['name'] = $model->firstname;
        $this->state['name2'] = $model->lastname;
        $this->state['name3'] = $model->middlename;
        $this->state['genre'] = $model->gender;
        $this->state['email'] = $model->email;
        $this->state['phone'] = $model->phone;
        $this->state['lieuN'] = $model->lieu;
        $this->state['dateN'] = $model->birthdate;
        $this->state['service'] = $model->service;
        $this->state['adresse'] = $model->adress;
        $this->state['pays'] = $model->country;
        $this->state['region'] = $model->region;
        $this->state['description'] = $model->description;
        $this->state['etatcivil'] = $model->etatcivil;
    }

    public function submit()
    {


        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'string', 'max:255'],
                'name2' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'lieuN' => ['required', 'string', 'max:255'],
                'dateN' => ['required', 'date', 'max:255'],
                'genre' => ['required', 'string', 'max:255'],
                'service' => ['required', 'string', 'max:255'],
                'etatcivil' => ['required', 'string', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {


                Agent::find($this->modelId)->update([
                    'firstname' => $this->state['name'],
                    'lastname' => $this->state['name2'],
                    'middlename' => $this->state['name3'],
                    'gender' => $this->state['genre'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'lieu' => $this->state['lieuN'],
                    'service' => $this->state['service'],
                    'birthdate' => $this->state['dateN'],
                    'adress' => $this->state['adresse'],
                    'country' => $this->state['pays'],
                    'region' => $this->state['region'],
                    'description' => $this->state['description'],
                    'etatcivil' => $this->state['etatcivil'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('agentUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            $validator = Validator::make($this->state, [
                'name' => ['required', 'string', 'max:255'],
                'name2' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
                'phone' => ['required', 'string', 'max:255', 'unique:agents'],
                'lieuN' => ['required', 'string', 'max:255'],
                'dateN' => ['required', 'date', 'max:255'],
                'genre' => ['required', 'string', 'max:255'],
                'service' => ['required', 'string', 'max:255'],
                'etatcivil' => ['required', 'string', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {

                $matricule = 'FP-'.substr($this->state['name'], 0, 1).''.rand(1000,9999).''.substr($this->state['name2'], 0, 1);
                
                $data_create = Agent::create([
                    'firstname' => $this->state['name'],
                    'lastname' => $this->state['name2'],
                    'middlename' => $this->state['name3'],
                    'matricule' => $matricule,
                    'gender' => $this->state['genre'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'lieu' => $this->state['lieuN'],
                    'service' => $this->state['service'],
                    'birthdate' => $this->state['dateN'],
                    'adress' => $this->state['adresse'],
                    'country' => $this->state['pays'],
                    'region' => $this->state['region'],
                    'description' => $this->state['description'],
                    'etatcivil' => $this->state['etatcivil'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('agentUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        return view('livewire.rh.agent-form');
    }
}
