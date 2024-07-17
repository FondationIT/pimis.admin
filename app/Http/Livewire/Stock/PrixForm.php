<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Product;
use App\Models\Price;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class PrixForm extends Component
{
    public $state = [];
    public $modelId;
    protected $listeners = [
        'prixForm',
        'editPrix',
    ];

    public function prixForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editPrix($modelId){
        $this->modelId = $modelId;

        $model = Price::find($this->modelId);
        $this->state['product'] = $model->product;
        $this->state['prix'] = $model->prix;
        $this->state['debut'] = $model->debut;
        $this->state['fin'] = $model->fin;
    }

    public function submit()
    {

        $validator = Validator::make($this->state, [
            'product' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric',],
            'debut' => ['required', 'date'],
            'fin' => ['required', 'date'],
        ])->validate();

        if ($this->modelId != null) {

            DB::beginTransaction();
            try {


                Price::find($this->modelId)->update([
                    'product' => $this->state['product'],
                    'prix' => $this->state['prix'],
                    'debut' => $this->state['debut'],
                    'fin' => $this->state['fin'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('fournisseurUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            DB::beginTransaction();
            try {

                $today = date('Y-m-d');

                if (Price::where('product', $this->state['product'])->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->where('active', true)->exists()) {

                    session()->flash('message','Il existe deja un contrat en cours pour ce produit');

                }else{

                    $reference = 'PRX-'.$this->state['product'].''.Auth::user()->id.''.rand(100000,999999);
                    Price::create([
                        'reference' => $reference,
                        'product' => $this->state['product'],
                        'prix' => $this->state['prix'],
                        'debut' => $this->state['debut'],
                        'fin' => $this->state['fin'],
                        'signature' => Auth::user()->id,
                    ]);
                    DB::commit();
                    $this->reset('state');
                    $this->dispatchBrowserEvent('formSuccess');
                    $this->emit('prixUpdated');

                }

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        return view('livewire.stock.prix-form',[
            'products' => Article::where("active", "1")->orderBy("product")->get(),

        ]);
    }
}
