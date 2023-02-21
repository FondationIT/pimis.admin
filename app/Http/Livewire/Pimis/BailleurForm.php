<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Bailleur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use Livewire\Component;

class BailleurForm extends Component
{
    public $state = [];
    protected $listeners = [
        'bailleurForm',
        'editBailleur',
    ];

    public function bailleurForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editBailleur($modelId){
        $this->modelId = $modelId;

        $model = Bailleur::find($this->modelId);
        $this->state['name'] = $model->name;
        $this->state['email'] = $model->email;
        $this->state['phone'] = $model->phone;
    }

    public function submit()
    {

        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255','unique:bailleurs'],
            ])->validate();

            DB::beginTransaction();
            try {

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
                    'signature' => Auth::user()->id,
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('bailleurUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        return view('livewire.pimis.bailleur-form');
    }
}
