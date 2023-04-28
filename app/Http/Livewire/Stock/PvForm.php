<?php

namespace App\Http\Livewire\Stock;
use App\Models\ProductOder;
use App\Models\Product;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;

use Livewire\Component;

class PvForm extends Component
{
    public $state = [];
    public $modelId = null;
    public $somme = 0;
    public $da;
    protected $listeners = [
        'formPV',
    ];
    public function formPV($modelId){
        $this->modelId = $modelId;

        $this->da =DemAch::where("id", $this->modelId)->get();

       

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
            $this->emit('demAchUpdated');
            $this->emit('bonReqUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.stock.pv-form');
    }
}
