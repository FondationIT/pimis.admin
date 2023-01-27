<?php

namespace App\Http\Livewire\Pimis;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class UserForm extends Component
{
    public $state = [];
    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];

    public function submit()
    {
        //$this->validate();
        sleep(5);
        $validator = Validator::make($this->state, [
            'agent' => ['required', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
        ])->validate();

        // Execution doesn't reach here if validation fails.
        DB::beginTransaction();
        try {
            $agents = Agent::where('id', $this->state['agent'])->get();

            $users_create = User::create([
                'name' => $agents[0]->firstname.' '.$agents[0]->lastname,
                'agent' => $this->state['agent'],
                'email' => $this->state['email'],
                'role' => $this->state['role'],
                'password' => Hash::make('password'),
            ]);
            DB::commit();
            $this->reset('state');
            $this->dispatchBrowserEvent('formSuccess');
            //$this->emit('allUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.pimis.user-form',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
