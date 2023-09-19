<?php

namespace App\Http\Livewire\Caisse;

use App\Models\Agent;
use App\Models\Be;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BeTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'beUpdated' => '$refresh'
    ];

    public function builder()
    {        
        return Be::query()->orderBy("id", "DESC");       
    }

    public function columns()
    {

        return [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
            })->label('Reference'),

            Column::callback(['projet','id'], function ($projet,$id) {
                return 'Projet '.Projet::where('id',$projet)->get()[0]->name;;
            })->label('Projet'),

            Column::callback(['agent','id'], function ($agent,$id) {
                return Agent::where('id',$agent)->get()[0]->firstname .' '.Agent::where('id',$agent)->get()[0]->lastname.' '.Agent::where('id',$agent)->get()[0]->lastname;
            })->label('Agent'),

            Column::callback(['montant'], function ($s) {
                return '$ '.$s;
            })->label('Montant'),

        ];
    }
}
