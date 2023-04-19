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
        $this->state['min1'] = $model->min1;
        $this->state['max1'] = $model->max1;
        $this->state['min2'] = $model->min2;
        $this->state['max2'] = $model->max2;
        $this->state['min3'] = $model->min3;
        $this->state['max3'] = $model->maxx3;
    }

    public function submit()
    {

        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255','unique:bailleurs'],
                'min1' => ['required','numeric'],
                'max1' => ['required','numeric'],
                'min2' => ['required','numeric'],
                'max2' => ['required','numeric'],
                'min3' => ['required','numeric'],
                'max3' => ['required','numeric'],
            ])->validate();

            DB::beginTransaction();
            try {

                Bailleur::find($this->modelId)->update([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'min1' => $this->state['min1'],
                    'max1' => $this->state['max1'],
                    'min2' => $this->state['min2'],
                    'max2' => $this->state['max2'],
                    'min3' => $this->state['min3'],
                    'maxx3' => $this->state['max3'],
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
                'min1' => ['required','numeric'],
                'max1' => ['required','numeric'],
                'min2' => ['required','numeric'],
                'max2' => ['required','numeric'],
                'min3' => ['required','numeric'],
                'max3' => ['required','numeric'],
            ])->validate();

            DB::beginTransaction();
            try {

                $data_create = Bailleur::create([
                    'name' => $this->state['name'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'min1' => (float)$this->state['min1'],
                    'max1' => (float)$this->state['max1'],
                    'min2' => (float)$this->state['min2'],
                    'max2' => (float)$this->state['max2'],
                    'min3' => (float)$this->state['min3'],
                    'maxx3' => (float)$this->state['max3'],
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
