<?php

namespace App\Http\Livewire\Agent;

use App\Models\Tr;
use App\Models\TrOder;
use App\Models\ValidTr;
use Livewire\Component;

class TrPrint extends Component
{
    public $modelId;
    public $products;
    public $trs=[];
    public $valid1=[];
    public $valid2=[];
    public $valid3=[];
    public $some = 0;
    public $i = 1;

    protected $listeners = [
        'printTr'
    ];

    public function printTr($modelId){
        $this->modelId = $modelId;

        $this->products = TrOder::where("tr", $this->modelId)->orderBy("id", "DESC")->get();
        $this->trs = Tr::where("id", $this->modelId)->get();
        $this->valid1 = ValidTr::where("tr", $this->modelId)->where("niv", 1)->get();
        $this->valid2 = ValidTr::where("tr", $this->modelId)->where("niv", 2)->get();
        $this->valid3 = ValidTr::where("tr", $this->modelId)->where("niv", 3)->get();
        $this->some = trOder::where('tr',$modelId)->selectRaw("prix * quantite * frequence as price")->get('price')
        ->sum('price');
    }
    public function render()
    {
        return view('livewire.agent.tr-print');
    }
}