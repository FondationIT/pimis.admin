<?php

namespace App\Http\Livewire\Stock;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class ProductForm extends Component
{

    public $state = [];
    public $modelId;
    protected $listeners = [
        'productForm',
        'editProduct',
    ];

    public function productForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editProduct($modelId){
        $this->modelId = $modelId;

        $model = Product::find($this->modelId);
        $this->state['designation'] = $model->designation;
        $this->state['categorie'] = $model->categorie;
        $this->state['model'] = $model->model;
        $this->state['unite'] = $model->unite;
        $this->state['marque'] = $model->marque;
        $this->state['description'] = $model->description;
    }


    public function submit()
    {

        $validator = Validator::make($this->state, [
            'designation' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'marque' => ['required', 'string', 'max:255'],
            'unite' => ['required', 'string', 'max:255'],
        ])->validate();

        if ($this->modelId != null) {

            DB::beginTransaction();
            try {


                Product::find($this->modelId)->update([
                    'designation' => $this->state['designation'],
                    'categorie' => $this->state['categorie'],
                    'model' => $this->state['model'],
                    'unite' => $this->state['unite'],
                    'marque' => $this->state['marque'],
                    'description' => $this->state['description'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('productUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            DB::beginTransaction();
            try {

                $reference = 'PRD-'.substr($this->state['designation'], 0, 1).''.$this->state['categorie'].''.Auth::user()->id.''.rand(100000,999999).''.substr($this->state['marque'], 0, 1);
                $data_create = Product::create([
                    'reference' => $reference,
                    'designation' => $this->state['designation'],
                    'categorie' => $this->state['categorie'],
                    'model' => $this->state['model'],
                    'unite' => $this->state['unite'],
                    'marque' => $this->state['marque'],
                    'description' => $this->state['description'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('productUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }


    public function render()
    {
        return view('livewire.stock.product-form',['categories' => Categorie::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
