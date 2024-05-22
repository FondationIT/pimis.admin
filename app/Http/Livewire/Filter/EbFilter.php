<?php

namespace App\Http\Livewire\Filter;

use App\Models\Affectation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EbFilter extends Component
{
    public $modelId, $ebData, $test;
    public $state = [];

    public function filterEb(){

        $validatedData = Validator::make($this->state, [
            'debut' => ['required','date'],
            'fin' => ['required', 'date', 'after_or_equal:debut'],
            'status' => ['required'],
            'projet' => ['required'],
        ])->validate();
        $this->emit('filterEb',$validatedData);
    }

    public function resetForm(){
        
        $this->reset('state');
        $this->emit('resetFilterEb');
    }

    public function render()
    {
        $this->modelId = Auth::user()->agent;
        return view('livewire.filter.eb-filter', [
            'affectation' => Affectation::where('agent', $this->modelId)->where('active', true)->get(),
            
        ]);
    }
}
