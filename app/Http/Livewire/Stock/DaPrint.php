<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Ligne;
use App\Models\Price;
use App\Models\ValidDa;

use Livewire\Component;

class DaPrint extends Component
{
    public $modelId;
    public $products;
    public $ebs;
    public $das;
    public $some;
    public $bailleur;
    public $i = 1;

    public $valid1;
    public $valid2;
    public $valid3;
    public $valid4;

    public $ligne;

    protected $listeners = [
        'printDa'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;

        $this->das = DemAch::where("id", $this->modelId)->get();
        $this->products = ProductOder::where("etatBes", $this->das[0]->eb)->orderBy("id", "DESC")->get();
        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();
        $this->valid1 = ValidDa::where("da", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidDa::where("da", $this->modelId)->where("niv", 2)->get();
        $this->valid3 = ValidDa::where("da", $this->modelId)->where("niv", 3)->get();
        $this->valid4 = ValidDa::where("da", $this->modelId)->where("niv", 4)->get();
        $this->ligne = Ligne::where("code", $this->ebs[0]->ligne)->get();


        $this->some  = ProductOder::join('prices', 'prices.product', '=', 'product_oders.description')
            ->selectRaw("prices.prix * product_oders.quantite as price")
            ->where('product_oders.etatBes', $this->das[0]->eb)
            ->whereDate('prices.debut','<=', $this->das[0]->created_at)->whereDate('prices.fin','>=', $this->das[0]->created_at)
            ->get('price')
            ->sum('price');
    }

    public function render()
    {
        return view('livewire.stock.da-print');
    }
}
