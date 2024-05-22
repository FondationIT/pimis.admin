<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\ValidBc;
use App\Models\Br;
use App\Models\Projet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class BrTable extends LivewireDatatable
{
    public $model = Br::class;
    public $modelId;
    protected $listeners = [
        'brUpdated' => '$refresh'
    ];

    public function printBr($modelId){
        $this->modelId = $modelId;
        $this->emit('printBr',$this->modelId );
    }

    public function columns()
    {

        return [
            Column::name('reference')
                ->label('Reference'),

            Column::callback(['projet'], function ($projet) {
                return Projet::find($projet)->name;
            })->label('Projet'),

            Column::callback(['fournisseur'], function ($fourn) {
                return Fournisseur::find($fourn)->name;
            })->label('Fournisseur'),

            Column::callback(['active'], function ($active) {
                    $delete = '<span class="badge badge-info">En cours</span>';
                    return $delete ;
            })->unsortable(),

            Column::callback(['id'], function ($id) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBr('.$id.')" data-toggle="modal" data-target="#pBrModalForms"><i class="icon-printer txt-danger"></i></a>';

                    return $delete ;
            })->unsortable(),
        ];
    }
}
