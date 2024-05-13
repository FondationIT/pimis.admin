<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\Proforma;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class PvTable extends LivewireDatatable
{
    public $model = Pv::class;
    public $modelId;

    protected $listeners = [
        'pvUpdated' => '$refresh'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPv',$this->modelId );
    }

    public function columns()
    {
        return [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvModalForms">'.$reference.'</a>';
            })->label('Reference PV'),

            Column::callback(['da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.DemAch::find($da)->id.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::name('titre')
                ->label('Titre'),

            Column::name('created_at')
                ->label('Date'),


            BooleanColumn::name('active')
                ->label('State'),
        ];
    }
}
