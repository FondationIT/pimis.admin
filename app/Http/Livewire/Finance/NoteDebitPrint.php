<?php

namespace App\Http\Livewire\Finance;

use App\Models\Nd;
use App\Models\NdOder;
use App\Models\ValidNd;
use Livewire\Component;

class NoteDebitPrint extends Component
{
    public $modelId;
    public $products;
    public $nds=[];
    public $valid1=[];
    public $some = 0;
    public $i = 1;

    protected $listeners = [
        'printNd'
    ];

    public function printNd($modelId){
        $this->modelId = $modelId;

        $this->products = NdOder::where("nd", $this->modelId)->orderBy("id", "DESC")->get();
        $this->nds = Nd::where("id", $this->modelId)->get();
        $this->valid1 = ValidNd::where("nd", $this->modelId)->where("niv", 1)->get();
        $this->some = NdOder::where('nd',$modelId)->selectRaw("prix * quantite as price")->get('price')
        ->sum('price');
    }
    public function render()
    {
        return view('livewire.finance.note-debit-print');
    }
}
