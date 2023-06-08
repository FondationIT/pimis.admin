<?php

namespace App\Http\Livewire\Finance;

use App\Models\Et_bes;
use App\Models\Ligne;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AppEbForm extends Component
{
    public $eb;
    public $lignes = [];
    public $ribrique = [];
    public $modelId;
    public $state = [];

    protected $listeners = [
        'formEbAppr'
    ];

    public function formEbAppr($modelId){
        $this->modelId = $modelId;

        $this->eb = Et_bes::where("id", $this->modelId)->get();
        $this->lignes = DB::table('lignes')->get();
        $this->ribrique = DB::table('lignes')->where("parent", 0)->get();

    }
    public function render()
    {
        return view('livewire.finance.app-eb-form');
    }
}
