<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Projet;

use Livewire\Component;

class ProjectsTable extends Component
{
    protected $listeners = [
        'allUpdated'=> '$refresh'
    ];
    public function render()
    {
        return view('livewire.pimis.projects-table',[
            'projets' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
