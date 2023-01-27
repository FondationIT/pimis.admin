<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Bailleur;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use Livewire\Component;

class BailleurForm extends Component
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
            'email' => ['required', 'string', 'max:255', 'unique:bailleurs'],
            'phone' => ['required', 'string', 'max:20'],
        ])->validate();

        // Execution doesn't reach here if validation fails.
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
            $this->emit('allUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.pimis.bailleur-form');
    }
}
