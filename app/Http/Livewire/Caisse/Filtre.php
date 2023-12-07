<?php

namespace App\Http\Livewire\Caisse;

use App\Models\LivreCaisse;
use App\Models\Projet;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Filtre extends Component
{

    protected $listeners = [
        'livreCaisseUpdated'=> '$refresh',
    ];

    public $state =[];

    public function change($type)
    {
        $this->emit('lcProjetFilter',$type);
    }
    public function submit()
    {
        Validator::make($this->state, [
            'projet' => ['required', 'max:255'],
        ])->validate();

        $this->emit('lcProjetFilter',$this->state['projet']);
    }
    public function render()
    {
        return view('livewire.caisse.filtre',[
            'projets' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),
            'ent' => LivreCaisse::where('active', true)->get('entree')->sum('entree'),
            'sort' => LivreCaisse::where('active', true)->get('sortie')->sum('sortie'),
        ]);
    }
}
