<?php

namespace App\Http\Livewire\Agent;

use App\Models\Agent;
use App\Models\Conge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CongeForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $service;
    protected $listeners = [
        'congeForm',
        'conge2Form',
    ];

    public function congeForm(){
        $this->reset('state');
        $this->modelId = null;
        $this->state['agent'] = Auth::user()->agent;
    }

    public function conge2Form(){
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
                'type' => ['required', 'string', 'max:255'],
                'dateD' => ['required', 'string'],
                'dateF' => ['required', 'string'],
                'dure' => ['required'],
            ])->validate();
            DB::beginTransaction();
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();

                Conge::find($this->modelId)->update([
                    'agent' => $this->state['agent'],
                    'type' => $this->state['type'],
                    'debut' => $this->state['dateD'],
                    'fin' => $this->state['dateF'],
                    'dure' => $this->state['dure'],
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
                'type' => ['required', 'string', 'max:255'],
                'dateD' => ['required', 'string', 'max:20'],
                'dateF' => ['required', 'string', 'max:20'],
                'dure' => ['required'],
            ])->validate();
            DB::beginTransaction(8);
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();
                $reference = 'CG-'.substr($agents[0]->lastname, 0, 1).''.$this->state['agent'].''.rand(100000,999999).''.substr($agents[0]->firstname, 0, 1);

                Conge::create([
                    'reference' => $reference,
                    'agent' => $this->state['agent'],
                    'type' => $this->state['type'],
                    'debut' => $this->state['dateD'],
                    'fin' => $this->state['dateF'],
                    'dure' => $this->state['dure'],
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
        return view('livewire.agent.conge-form',['agents' => Agent::where("active", "1")->where("service", $this->service)->where("id","!=", Auth::user()->agent)->orderBy("id", "DESC")->get(),]);
    }
}
