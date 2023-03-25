<?php

namespace App\Http\Livewire\Stock;

use App\Models\Et_bes;
use App\Models\Projet;
use App\Models\DemAch;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DaTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'ebUpdated' => '$refresh'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }

    public function builder()
    {
        return DemAch::query()->orderBy("id", "DESC");
    }

    public function columns()
    {

        return [
            Column::name('reference')
                ->label('D.A Ref'),

            Column::callback(['eb'], function ($eb) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
            })->label('B.R Ref'),

            Column::name('created_at')
                ->label('Date'),

            BooleanColumn::name('niv1')
                ->label('Logistique'),

            BooleanColumn::name('niv2')
                ->label('Projet'),

            BooleanColumn::name('niv3')
                ->label('Comptable'),

            BooleanColumn::name('niv4')
                ->label('D.A.F'),

            Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                if ($active == true && $niv1 == true && $niv2 == true) {
                    $delete = '<span class="badge badge-success">Approuvé</span>';
                }elseif($active == false){
                    $delete = '<span class="badge badge-danger">Refusé</span>';
                }else{
                    $delete = '<span class="badge badge-info">En cours</span>';
                }
                    return $delete ;
            })->unsortable(),

            Column::callback(['id'], function ($id) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms"><i class="icon-printer txt-danger"></i></a>';

                    return $delete ;
            })->unsortable(),
        ];
    }
}
