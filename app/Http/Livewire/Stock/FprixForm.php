<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Product;
use App\Models\Fournisseur;
use App\Models\FournPrice;
use App\Models\Price;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class FprixForm extends Component
{
    public $state = [];
    public $modelId;
    protected $listeners = [
        'fprixForm',
        'editFPrix',
    ];

    public function fprixForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editFPrix($modelId){
        $this->modelId = $modelId;

        $model = FournPrice::find($this->modelId);
        $this->state['fournisseur'] = $model->fournisseur;
        $this->state['product'] = $model->product;
        $this->state['prix'] = $model->prix;
        $this->state['debut'] = $model->debut;
        $this->state['fin'] = $model->fin;
        $this->state['description'] = $model->description;
    }

    public function submit()
    {

        $validator = Validator::make($this->state, [
            'fournisseur' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric',],
            'debut' => ['required', 'date'],
            'fin' => ['required', 'date'],
        ])->validate();

        if ($this->modelId != null) {

            DB::beginTransaction();
            try {


                FournPrice::find($this->modelId)->update([
                    'fournisseur' => $this->state['fournisseur'],
                    'product' => $this->state['product'],
                    'prix' => $this->state['prix'],
                    'debut' => $this->state['debut'],
                    'fin' => $this->state['fin'],
                    'description' => $this->state['description'],
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

                    $reference = 'PRX-'.$this->state['fournisseur'].''.$this->state['product'].''.Auth::user()->id.''.rand(100000,999999);
                    $data_create = FournPrice::create([
                        'reference' => $reference,
                        'fournisseur' => $this->state['fournisseur'],
                        'product' => $this->state['product'],
                        'prix' => $this->state['prix'],
                        'debut' => $this->state['debut'],
                        'fin' => $this->state['fin'],
                        'description' => $this->state['description'],
                        'signature' => Auth::user()->id,
                    ]);
                    DB::commit();
                    $this->reset('state');
                    $this->dispatchBrowserEvent('formSuccess');
                    $this->emit('fprixUpdated');

                }

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        return view('livewire.stock.fprix-form',[
            'products' => Article::where("active", "1")->orderBy("id", "DESC")->get(),
            'fournisseurs' => Fournisseur::where("active", "1")->orderBy("id", "DESC")->get(),

        ]);
    }
}
