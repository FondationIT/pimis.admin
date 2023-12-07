<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\PartContrat;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ContratTable extends LivewireDatatable
{

    protected $listeners = [
        'contratUpdated'=> '$refresh'
    ];

    public function columns()
    {

        return [
            Column::callback(['agent'], function ($x) {
                return Agent::find($x)->firstname.' '.Agent::find($x)->lastname.' '.Agent::find($x)->middlename ;
            })->label('Produit'),

            Column::name('type')
                ->label('Type'),

            Column::callback(['id'], function ($x) {

                $pr = PartContrat::where('contrat',$x)->get();
                $n = '<ul>';
                    foreach ($pr as $br) {
                        
                      $n .= '<li><a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBr('.$br->id.')" data-toggle="modal" data-target="#pBrModalForms">'.Projet::find($br->projet)->name.'</a><span class="badge badge-success">$'.$br->pourcentage.'%</span></li>';  
                    }
                    
                    return $n ;
            })->label('Projets'),

            Column::name('debut')
                ->label('Debut'),

            Column::name('fin')
                ->label('Fin'),



            BooleanColumn::name('active')
                ->label('statut'),

            Column::callback(['id','active'], function ($id,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deletePrix(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nPrixModalForms"><i class="icon-pencil"></i></a>';
                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restorePrix(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),
        ];

        
    }
}
