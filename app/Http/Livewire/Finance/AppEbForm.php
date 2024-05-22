<?php

namespace App\Http\Livewire\Finance;

use App\Models\Et_bes;
use App\Models\Ligne;
use App\Models\ProductOder;
use App\Models\TrOder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AppEbForm extends Component
{
    public $eb;
    public $type;
    public $lignes = [];
    public $ribrique = [];
    public $modelId;
    public $state = [];

    protected $listeners = [
        'ligneArt',
        'ligneTr'
    ];

    public function ligneArt($modelId){
        $this->modelId = $modelId;

        $this->eb = ProductOder::where("id", $this->modelId)->get();
        $this->type = 1;
        $this->lignes = DB::table('lignes')->get();
        $this->ribrique = DB::table('lignes')->where("parent", 0)->get();

    }
    public function ligneTr($modelId){
        $this->modelId = $modelId;

        $this->eb = TrOder::where("id", $this->modelId)->get();
        $this->type = 2;
        $this->lignes = DB::table('lignes')->get();
        $this->ribrique = DB::table('lignes')->where("parent", 0)->get();

    }
    public function render()
    {
        return view('livewire.finance.app-eb-form');
    }
}
