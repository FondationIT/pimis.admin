<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock;
use App\Models\Article;
use App\Models\Projet;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class StockTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'fichStUpdated' => '$refresh'
    ];

    public function builder()
    {
        return Stock::query()->orderBy("id", "DESC");
    }


    public function columns()
    {

        return [
            Column::name('reference')
                ->label('Reference'),

            Column::callback(['product'], function ($prod) {
                return Article::find($prod)->marque.' '.Article::find($prod)->model.'<br> '.Article::find($prod)->description;
            })->label('Projet'),

            Column::callback(['project'], function ($projet) {
                return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
            })->label('Projet'),

            Column::name('quantite')
                ->label('Quantité'),

            BooleanColumn::name('active')
                ->label('Etat'),

        ];
    }
}
