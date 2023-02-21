<?php

namespace App\Http\Livewire\Agent;

use App\Models\Et_bes;
use App\Models\Projet;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EbTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'ebUpdated' => '$refresh'
    ];

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }

    public function builder()
    {
        return Et_bes::query()->where("agent", Auth::user()->id)->orderBy("id", "DESC");
    }

    public function columns()
    {

        return [
            Column::name('reference')
                ->label('Reference'),

            Column::callback(['projet'], function ($projet) {
                return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
            })->label('Projet'),

            Column::name('created_at')
                ->label('Date'),

            BooleanColumn::name('niv1')
                ->label('Comptable'),

            BooleanColumn::name('niv2')
                ->label('Projet'),

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

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms"><i class="icon-printer txt-danger"></i></a>';

                    return $delete ;
            })->unsortable(),
        ];
    }
}
