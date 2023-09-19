<?php

namespace App\Http\Livewire\Finance;


use App\Models\Et_bes;
use App\Models\ProductOder;
use App\Models\Tr;
use App\Models\TrOder;
use App\Models\ValidEb;
use App\Models\ValidTr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ComptLigneForm extends Component
{
  
    public $modelId;
    public $eb;
    public $type;
    public $product =[];

    protected $listeners = [
        'formEbAppr',
        'formTrAppr',
        'formEbApprRef' => '$refresh'
    ];

    public function formEbAppr($modelId){
        $this->modelId = $modelId;
        $this->eb = $modelId;
        $this->type = 1;
        $this->product = ProductOder::where("etatBes", $this->modelId)->get();   

    }

    public function formTrAppr($modelId){
        $this->modelId = $modelId;
        $this->eb = $modelId;
        $this->type = 2;
        $this->product = TrOder::where("tr", $this->modelId)->get();   

    }

    public function ligneArt($modelId){
        
        $this->modelId = $modelId;
        $this->emit('ligneArt',$this->modelId );

    }

    public function ligneTr($modelId){
        
        $this->modelId = $modelId;
        $this->emit('ligneTr',$this->modelId );

    }

    public function submit()
    {
        DB::beginTransaction();
        try {

            if ($this->type == 1) {
            
                Et_bes::find($this->eb)->update([
                    'niv1' => 1,
                ]);
                ValidEb::create([
                    'user' => Auth::user()->id,
                    'signature' => Auth::user()->id,
                    'eb' => $this->eb,
                    'resp' => true,
                    'niv' => 1,
                    'motif' => 'Tout es prevu',
                ]);

                DB::commit();
                $this->emit('bonReqUpdated');
                $this->emit('ebUpdated');
                $this->dispatchBrowserEvent('formSuccess');

            }else if ($this->type == 2){

                Tr::find($this->eb)->update([
                    'niv1' => 1,
                ]);
                ValidTr::create([
                    'user' => Auth::user()->id,
                    'tr' => $this->eb,
                    'resp' => true,
                    'niv' => 1,
                    'motif' => 'Tout es prevu',
                ]);

                DB::commit();
                $this->emit('trUpdated');
                $this->dispatchBrowserEvent('formSuccess');
            }
        } catch (\Throwable $th) {

            DB::rollBack();
        }
        return true;

    }

    public function render()
    {
        return view('livewire.finance.compt-ligne-form');
    }
}
