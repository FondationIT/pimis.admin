<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\Mission;
use App\Models\Tr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OmTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'missionUpdated'=> '$refresh'
    ];


    public function printTr($modelId){
        $this->modelId = $modelId;
        $this->emit('printTr',$this->modelId );
    }

    public function print($modelId){
        $this->modelId = $modelId;
        $this->emit('printMission',$this->modelId );
    }


    public function builder()
    {
        if (Agent::firstWhere('id', Auth::user()->agent)->fonction == 1) {

            $service =  Agent::firstWhere('id', Auth::user()->agent)->service;

            return Mission::query()->orderBy("id", "DESC");
        }else{
            return Mission::query()->orderBy("id", "DESC");
        }
    }


    public function columns()
    {

        return [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pMissionModalForms">'.$reference.'</a>';
            })->label('Reference'),

            Column::callback(['tr'], function ($id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.Tr::query()->where('id', $id)->get()[0]->reference.'</a>';
            })->label('Reference'),

            Column::name('destination')
                ->label('Destination'),

            Column::name('debut')
                ->label('Depart'),

            Column::name('fin')
                ->label('Retour'),
        ];

        
    }
}
