<?php

namespace App\Http\Livewire\Finance;

use App\Models\Affectation;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NoteDebitForm extends Component
{
    protected $listeners = [
        'ndForm'=> '$refresh'
    ];
    public function render()
    {
        return view('livewire.finance.note-debit-form',
        [
            'affectation' => Affectation::where("active", "1")->where("agent", Auth::user()->agent)->orderBy("id", "DESC")->get(),
            'projet' => Projet::where("active", "1")->orderBy("id", "DESC")->get(),

        ]);
    }
}
