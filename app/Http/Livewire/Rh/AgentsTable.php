<?php

namespace App\Http\Livewire\Rh;
use App\Models\Agent;

use Livewire\Component;

class AgentsTable extends Component
{
  
    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];

    public function render()
    {
        return view('livewire.rh.agents-table',['agents' => Agent::where("active", "1")->orderBy("id", "DESC")->get(),]);
    }
}
