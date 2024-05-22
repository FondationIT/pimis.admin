<?php

namespace App\Http\Livewire\Stock;

use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Proforma;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class BcForm extends Component
{

    public $da;
    public $prof;
    public $modelId;
    public $modelProf;
    public $state = [];

    protected $listeners = [
        'formBC'
    ];

    public function formBC($modelId,$modelProf){
        $this->modelId = $modelId;
        $this->modelProf = $modelProf;

        $this->da = DemAch::where("id", $this->modelId)->get();
        $this->prof = Proforma::where("id", $this->modelProf)->get();

    }

    public function submit()
    {
        $validator = Validator::make($this->state, [
            'pers' => ['required', 'max:255'],
            'lieu' => ['required', 'max:255'],
            'delai' => ['required', 'max:255'],
        ])->validate();

        DB::beginTransaction();
        try {
            $ref = 'BC-'.rand(100000,999999).'-FP'.rand(100,999);

            Bc::create([
                'reference' => $ref,
                'signature' => Auth::user()->id,
                'da' => $this->da[0]->id,
                'proforma' => $this->prof[0]->id,
                'personne' => $this->state['pers'],
                'lieu' => $this->state['lieu'],
                'delai' => $this->state['delai'],
                'comment' => $this->state['comment']
            ]);

            DB::commit();
            $this->reset('state');
            $this->modelId = null;
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('demAchUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.stock.bc-form');
    }
}
