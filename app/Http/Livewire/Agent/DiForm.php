<?php

namespace App\Http\Livewire\Agent;
use App\Models\Et_bes;
use App\Models\Affectation;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class DiForm extends Component
{
    public function render()
    {
        return view('livewire.agent.di-form',
        [
            'affectation' => Affectation::where("active", "1")->where("agent", Auth::user()->agent)->orderBy("id", "DESC")->get(),
            'products' => Product::where("active", "1")->orderBy("id", "DESC")->get(),
            'categories' => Categorie::where("active", true)->orderBy("id", "DESC")->get(),

        ]);
    }
}
