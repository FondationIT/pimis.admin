<?php

namespace App\Http\Livewire\Agent;

use App\Models\Agent;
use App\Models\TdrExternalAgent;
use App\Models\Affectation;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TrForm extends Component
{
    public $equipe = [];
    protected $listeners = [
        'ndForm'=> '$refresh'
    ];

    public function mount()
    {
        // $this->equipe = Agent::where("active", "1")->union(
        //     TdrExternalAgent::select('id', 'firstname', 'lastname','middlename')
        //     ->where('active', 1)
        // )->orderBy("firstname", "DESC")->get();
        $internalAgents = Agent::where('active', 1)
            ->orderBy('firstname', 'ASC')
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'firstname' => $a->firstname,
                'lastname' => $a->lastname,
                'middlename' => $a->middlename,
            ]);

        $externalAgents = TdrExternalAgent::where('active', 1)
            ->orderBy('firstname', 'ASC')
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'firstname' => $a->firstname,
                'lastname' => $a->lastname,
                'middlename' => $a->middlename,
                'organization' => $a->organization,
                'position' => $a->position,
                'type' => 'external',
            ]);

        // Merge into a single array
        $this->equipe = $internalAgents->merge($externalAgents)->sortBy('firstname')->values();
    }

    public function render()
    {
        return view('livewire.agent.tr-form',
        [
            'affectation' => Affectation::where("active", "1")->where("agent", Auth::user()->agent)->orderBy("id", "DESC")->get(),
            'projet' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),

        ]);
    }
}
