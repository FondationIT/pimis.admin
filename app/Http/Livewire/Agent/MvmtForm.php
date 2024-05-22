<?php

namespace App\Http\Livewire\Agent;

use App\Models\Agent;
use App\Models\Mouvement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class MvmtForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $service;
    protected $listeners = [
        'mvntForm',
        'mvnt2Form',
    ];

    public function mvntForm(){
        $this->reset('state');
        $this->modelId = null;
        $this->state['agent'] = Auth::user()->agent;
    }

    public function mvnt2Form(){
        $this->reset('state');
        $this->modelId = null;
        $this->service = Agent::firstWhere('id', Auth::user()->agent)->service;
    }



    public function submit()
    {
        // Execution doesn't reach here if validation fails.

        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'agent' => ['required', 'max:255'],
                'destination' => ['required', 'string'],
                'dateD' => ['required', 'string'],
                'dateF' => ['required', 'string'],
                'motif' => ['required'],
            ])->validate();
            DB::beginTransaction();
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();

                Mouvement::find($this->modelId)->update([
                    'agent' => $this->state['agent'],
                    'destination' => $this->state['destination'],
                    'depart' => $this->state['dateD'],
                    'retour' => $this->state['dateF'],
                    'motif' => $this->state['motif'],
                ]);

                DB::commit();
                $this->reset('state');
                $this->modelId = null;
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('usersUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }


        }else {

            $validator = Validator::make($this->state, [
                'agent' => ['required', 'max:255'],
                'destination' => ['required', 'string'],
                'dateD' => ['required', 'string'],
                'dateF' => ['required', 'string'],
                'motif' => ['required'],
            ])->validate();
            DB::beginTransaction(8);
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();
                $reference = 'MT-'.substr($agents[0]->lastname, 0, 1).''.$this->state['agent'].''.rand(100000,999999).''.substr($agents[0]->firstname, 0, 1);

                Mouvement::create([
                    'reference' => $reference,
                    'agent' => $this->state['agent'],
                    'destination' => $this->state['destination'],
                    'depart' => $this->state['dateD'],
                    'retour' => $this->state['dateF'],
                    'motif' => $this->state['motif'],
                    'signature' => Auth::user()->id,
                ]);



                DB::commit();
                $this->reset('state');
                $this->modelId = null;
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('congeUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }


    }
    public function render()
    {
        return view('livewire.agent.mvmt-form',['agents' => Agent::where("active", "1")->where("service", $this->service)->where("id","!=", Auth::user()->agent)->orderBy("id", "DESC")->get(),]);
    }
}
