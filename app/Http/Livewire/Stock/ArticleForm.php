<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class ArticleForm extends Component
{
    public $state = [];
    public $modelId;
    protected $listeners = [
        'articleForm',
        'editArticle',
    ];

    public function articleForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editArticle($modelId){
        $this->modelId = $modelId;

        $model = Article::find($this->modelId);
        $this->state['product'] = $model->product;
        $this->state['model'] = $model->model;
        $this->state['unite'] = $model->unite;
        $this->state['marque'] = $model->marque;
        $this->state['description'] = $model->description;
    }


    public function submit()
    {

        $validator = Validator::make($this->state, [
            'product' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'marque' => ['required', 'string', 'max:255'],
            'unite' => ['required', 'string', 'max:255'],
        ])->validate();

        if ($this->modelId != null) {

            DB::beginTransaction();
            try {


                Article::find($this->modelId)->update([
                    'product' => $this->state['product'],
                    'model' => $this->state['model'],
                    'unite' => $this->state['unite'],
                    'marque' => $this->state['marque'],
                    'description' => $this->state['description'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('articleUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            DB::beginTransaction();
            try {

                $reference = 'ART-'.substr($this->state['model'], 0, 1).''.$this->state['product'].''.Auth::user()->id.''.rand(100000,999999).''.substr($this->state['marque'], 0, 1);
                $data_create = Article::create([
                    'reference' => $reference,
                    'product' => $this->state['product'],
                    'model' => $this->state['model'],
                    'unite' => $this->state['unite'],
                    'marque' => $this->state['marque'],
                    'description' => $this->state['description'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('articleUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }
    public function render()
    {
        return view('livewire.stock.article-form',['products' => Product::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
