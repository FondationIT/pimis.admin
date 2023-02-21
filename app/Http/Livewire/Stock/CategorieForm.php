<?php

namespace App\Http\Livewire\Stock;
use App\Models\Categorie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class CategorieForm extends Component
{


    public $state = [];
    public $modelId;
    protected $listeners = [
        'categorieForm',
        'editCategorie',
    ];

    public function categorieForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editCategorie($modelId){
        $this->modelId = $modelId;

        $model = Categorie::find($this->modelId);
        $this->state['name'] = $model->name;
        $this->state['description'] = $model->description;
    }

    public function submit()
    {


        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'string', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {


                Categorie::find($this->modelId)->update([
                    'name' => $this->state['name'],
                    'description' => $this->state['description'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('categorieUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            $validator = Validator::make($this->state, [
                'name' => ['required', 'string', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {

                $data_create = Categorie::create([
                    'name' => $this->state['name'],
                    'description' => $this->state['description'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('categorieUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }



    public function render()
    {
        return view('livewire.stock.categorie-form');
    }
}
