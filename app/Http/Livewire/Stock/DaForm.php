<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;

use Illuminate\Support\Facades\DB;
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
            ->where('product_oders.etatBes', $this->modelId)
            ->get('prix','+','quantite');

        $this->eb =Et_bes::where("id", $this->modelId)->get();
    }

    public function render()
    {
        return view('livewire.stock.da-form');
    }
}
