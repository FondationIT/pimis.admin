<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\Tr;
use Livewire\Component;

class OmForm extends Component
{
    public $da;
    public $modelId = null;
    protected $listeners = [
        'formOM',
    ];

    public function formOM($modelId){
        $this->modelId = $modelId;

        $this->da =Tr::where("id", $this->modelId)->get();

    }
    public function render()
    {
        return view('livewire.rh.om-form',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
