<?php

namespace App\Http\Livewire\Pimis;
use App\Models\User;
use App\Models\PasswordUpdate;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

use Livewire\Component;

class UserForm extends Component
{
    use WithFileUploads;
    public $roles = [];
    public $state = [];
    public $modelId = null;
    public $fileName;
    protected $listeners = [
        'userForm',
        'editUser',
    ];

    public function mount()
    {
        $this->roles = getRoles();
    }

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
                'photo' => ['required', 'image', 'mimes:png,jpg', 'max:1024'],
            ])->validate();
            DB::beginTransaction(8);
            try {

                $agents = Agent::where('id', $this->state['agent'])->get();
                //$image_name= $agents[0]->matricule;
                $image_name = $this->state['photo']->store('img/signatures','public');
                $reference = 'US-'.substr($agents[0]->lastname, 0, 1).''.$this->state['agent'].''.rand(100000,999999).''.substr($agents[0]->firstname, 0, 1);

                User::create([
                    'reference' => $reference,
                    'name' => $agents[0]->firstname.' '.$agents[0]->lastname,
                    'agent' => $this->state['agent'],
                    'email' => $this->state['email'],
                    'role' => $this->state['role'],
                    'signature' => $image_name,
                    'password' => Hash::make('password'),
                ]);

                $addedUser = User::findByReference($reference);

                PasswordUpdate::create([
                    'user' => $addedUser->id,
                    'last_updated_at' => now(),
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
