<?php

namespace App\Http\Livewire\Rh;
use App\Models\Agent;
use App\Models\TdrExternalAgent;
use App\Models\Service;
use App\Models\StatutAgent;
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
    public bool $isExternal = false;

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
        $model1 = StatutAgent::where('agent',$this->modelId)->where('active', true)->orderBy('created_at', 'desc')->first();

        $this->state['name'] = $model->firstname;
        $this->state['name2'] = $model->lastname;
        $this->state['name3'] = $model->middlename;
        $this->state['genre'] = $model->gender;
        $this->state['email'] = $model->email;
        $this->state['phone'] = $model->phone;
        $this->state['lieuN'] = $model->lieu;
        $this->state['dateN'] = $model->birthdate;
        $this->state['service'] = $model->service;
        $this->state['fonction'] = $model->fonction;
        $this->state['adresse'] = $model->adress;
        $this->state['pays'] = $model->country;
        $this->state['region'] = $model->region;
        $this->state['description'] = $model->description;
        $this->state['etatcivil'] = $model1->etatcivil;
        $this->state['enfant'] = $model1->enfant;

        $this->state['sociale'] = $model1->sociale;
        $this->state['bus'] = $model1->bus;

        $this->state['nom2'] = $model->nom2;
        $this->state['phone2'] = $model->contact;
    }

    public function submit()
    {
        logger()->info('Submitting agent form', ['state' => $this->state, 'modelId' => $this->modelId, 'isExternal' => $this->isExternal]);

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
                'fonction' => ['required', 'string', 'max:255'],
                'etatcivil' => ['required', 'string', 'max:255'],
                'enfant' => ['required', 'string', 'max:255'],

                'sociale' => ['required'],
                'bus' => ['required'],

                'nom2' => ['required', 'string', 'max:255'],
                'phone2' => ['required', 'string', 'max:255'],
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
                    'fonction' => $this->state['fonction'],
                    'birthdate' => $this->state['dateN'],
                    'adress' => $this->state['adresse'],
                    'country' => $this->state['pays'],
                    'region' => $this->state['region'],
                    'description' => $this->state['description'],
                    'nom2' => $this->state['nom2'],
                    'contact' => $this->state['phone2'],
                ]);

                StatutAgent::where('agent',$this->modelId)->update([
                    'active' => false
                ]);

                $ref = 'STFP-'.substr($this->state['name'], 0, 1).''.rand(1000,9999).''.substr($this->state['name2'], 0, 1);

                StatutAgent::create([
                    'reference' => $ref,
                    'agent' =>$this->modelId,
                    'enfant' => $this->state['enfant'],
                    'etatcivil' => $this->state['etatcivil'],
                    'bus' => $this->state['bus'],
                    'sociale' => $this->state['sociale'],
                    'signature' => Auth::user()->id,
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('agentUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{
            if(!$this->isExternal){
                $validator = Validator::make($this->state, [
                    'name' => ['required', 'string', 'max:255'],
                    'name2' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
                    'phone' => ['required', 'string', 'max:255', 'unique:agents'],
                    'lieuN' => ['required', 'string', 'max:255'],
                    'dateN' => ['required', 'date', 'max:255'],
                    'genre' => ['required', 'string', 'max:255'],
                    'service' => ['required', 'string', 'max:255'],
                    'fonction' => ['required', 'string', 'max:255'],
                    'etatcivil' => ['required', 'string', 'max:255'],
                    'enfant' => ['required', 'string', 'max:255'],

                    'sociale' => ['required'],
                    'bus' => ['required'],

                    'nom2' => ['required', 'string', 'max:255'],
                    'phone2' => ['required', 'string', 'max:255'],
                ])->validate();

                DB::beginTransaction();
                try {

                    $matricule = 'FP-'.substr($this->state['name'], 0, 1).''.rand(1000,9999).''.substr($this->state['name2'], 0, 1);
                    
                    Agent::create([
                        'firstname' => $this->state['name'],
                        'lastname' => $this->state['name2'],
                        'middlename' => $this->state['name3'],
                        'matricule' => $matricule,
                        'gender' => $this->state['genre'],
                        'email' => $this->state['email'],
                        'phone' => $this->state['phone'],
                        'lieu' => $this->state['lieuN'],
                        'service' => $this->state['service'],
                        'fonction' => $this->state['fonction'],
                        'birthdate' => $this->state['dateN'],
                        'adress' => $this->state['adresse'],
                        'country' => $this->state['pays'],
                        'region' => $this->state['region'],
                        'description' => $this->state['description'],
                        'nom2' => $this->state['nom2'],
                        'contact' => $this->state['phone2'],
                        'signature' => Auth::user()->id,
                    ]);

                    $agent = Agent::where("matricule", $matricule)->get();
                    $ref = 'STFP-'.substr($this->state['name'], 0, 1).''.rand(1000,9999).''.substr($this->state['name2'], 0, 1);

                    StatutAgent::create([
                        'reference' => $ref,
                        'agent' =>$agent[0]->id,
                        'enfant' => $this->state['enfant'],
                        'bus' => $this->state['bus'],
                        'sociale' => $this->state['sociale'],
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
            }else{
                $validator = Validator::make($this->state, [
                    'firstname' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'position' => ['required', 'string', 'max:255'],
                    'organization' => ['required', 'string', 'max:255'],
                    'contact' => ['required', 'string', 'max:255']
                ])->validate();

                $ref = 'AGEXT-'.substr($this->state['firstname'], 0, 1).''.rand(1000,9999).''.substr($this->state['lastname'], 0, 1);

                DB::beginTransaction();
                try {
                    TdrExternalAgent::create([
                        'reference' => $ref,
                        'firstname' => $this->state['firstname'],
                        'lastname' => $this->state['lastname'],
                        'position' => $this->state['position'],
                        'organization' => $this->state['organization'],
                        'contact' => $this->state['contact']
                    ]);
                    
                    DB::commit();
                    $this->reset('state');
                    $this->dispatchBrowserEvent('formSuccess');
                    $this->emit('agentEterneUpdated');
                } catch (\Throwable $th) {
                    logger()->error('Error creating external agent', ['error' => $th->getMessage()]);
                    DB::rollBack();
                }
            }
                
            
        }

    }

    public function render()
    {
        return view('livewire.rh.agent-form',[
            'service' => Service::orderBy("id", "ASC")->get(),]);
    }
}
