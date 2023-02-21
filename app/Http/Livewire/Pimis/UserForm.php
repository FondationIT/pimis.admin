<?php

namespace App\Http\Livewire\Pimis;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class UserForm extends Component
{
    public $state = [];
    public $modelId = null;
    protected $listeners = [
        'userForm',
        'editUser',
    ];

    public function userForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editUser($modelId){
        $this->modelId = $modelId;

        $model = User::find($this->modelId);
        $this->state['agent'] = $model->agent;
        $this->state['role'] = $model->role;
        $this->state['email'] = $model->email;
    }


    public function submit()
    {
        // Execution doesn't reach here if validation fails.


        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'agent' => ['required', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
                'role' => ['required', 'string', 'max:20'],
            ])->validate();
            DB::beginTransaction();
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();

                User::find($this->modelId)->update([
                    'name' => $agents[0]->firstname.' '.$agents[0]->lastname,
                    'agent' => $this->state['agent'],
                    'email' => $this->state['email'],
                    'role' => $this->state['role']
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
                'email' => ['required', 'string', 'max:255', 'unique:users'],
                'role' => ['required', 'string', 'max:20'],
            ])->validate();
            DB::beginTransaction();
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();

                User::create([
                    'name' => $agents[0]->firstname.' '.$agents[0]->lastname,
                    'agent' => $this->state['agent'],
                    'email' => $this->state['email'],
                    'role' => $this->state['role'],
                    'password' => Hash::make('password'),
                ]);

                DB::commit();
                $this->reset('state');
                $this->modelId = null;
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('usersUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }


    }
    public function render()
    {
        return view('livewire.pimis.user-form',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
