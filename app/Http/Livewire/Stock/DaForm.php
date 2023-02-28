<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;
use App\Models\DemAch;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class DaForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $somme = 0;
    public $eb;
    protected $listeners = [
        'formDA',
    ];
    public function formDA($modelId){
        $this->modelId = $modelId;
        $this->somme  = ProductOder::join('products', 'products.id', '=', 'product_oders.product')
            ->selectRaw("products.prix * product_oders.quantite as price")
            ->where('product_oders.etatBes', $this->modelId)
            ->get('price')
            ->sum('price');

        $this->eb =Et_bes::where("id", $this->modelId)->get();
    }

    public function submit()
    {
        $validator = Validator::make($this->state, [
            'motif' => ['required', 'max:255'],
        ])->validate();

        DB::beginTransaction();
        try {
            $ref = 'DA-'.rand(10000,99999).'-FP'.rand(100,999);

            DemAch::create([
                'reference' => $ref,
                'signature' => Auth::user()->id,
                'eb' => $this->eb[0]->id,
                'motif' => $this->state['motif'],
                'comment' => $this->state['comment'],
                'amount' => 1,
            ]);

            DB::commit();
            $this->reset('state');
            $this->modelId = null;
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('daUpdated');
            $this->emit('ebUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.stock.da-form');
    }
}
