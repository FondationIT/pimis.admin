<?php

namespace App\Http\Livewire\Agent;
use App\Models\Et_bes;
use App\Models\Affectation;
use App\Models\Article;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class EbForm extends Component
{
    protected $listeners = [
        'ebForm'=> '$refresh'
    ];

    public function render()
    {
        return view('livewire.agent.eb-form',
        [
            'affectation' => Affectation::where("active", true)->where("agent", Auth::user()->agent)->orderBy("id", "DESC")->get(),
            'products' => Product::where("active", true)->orderBy("id", "DESC")->get(),
            'categories' => Categorie::where("active", true)->orderBy("id", "DESC")->get(),
            'articles' => Article::where("active", true)->orderBy("id", "DESC")->get(),

        ]);
    }
}
