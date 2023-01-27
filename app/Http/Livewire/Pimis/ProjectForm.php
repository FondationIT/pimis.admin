<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Bailleur;
use App\Models\Projet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class ProjectForm extends Component
{
    public $state = [];
    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];


    public function submit()
    {
        //$this->validate();
        $validator = Validator::make($this->state, [
            'name' => ['required', 'max:255'],
            'dateD' => ['required', 'date'],
            'bailleur' => ['required', 'max:255'],
        ])->validate();

        // Execution doesn't reach here if validation fails.
        DB::beginTransaction();
        try {
            $ref = 'PJ-'.substr($this->state['name'], 0, 1).''.rand(1000,9999);

            $users_create = User::create([
                'name' => $agents[0]->firstname.' '.$agents[0]->lastname,
                'agent' => $this->state['agent'],
                'email' => $this->state['email'],
                'role' => $this->state['role'],
                'password' => Hash::make('password'),
            ]);

            Projet::create([
                'reference' => $ref,
                'name' => $this->state['name'],
                'dateD' => $this->state['dateD'],
                'dateF' => $this->state['dateF'],
                'contex' => $this->state['contexte'],
                'bailleur' => $this->state['bailleur'],
            ]);


            DB::commit();
            $this->reset('state');
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('allUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.pimis.project-form',[
            'bailleurs' => Bailleur::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
