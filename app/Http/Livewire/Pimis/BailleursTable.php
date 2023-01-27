<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Bailleur;

use Livewire\Component;

class BailleursTable extends Component
{
    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];
    public function render()
    {
        return view('livewire.pimis.bailleurs-table',[
            'bailleurs' => Bailleur::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
