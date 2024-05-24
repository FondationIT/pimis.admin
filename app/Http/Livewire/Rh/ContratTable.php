<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\Contrat;
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

    public function builder()
    {
        return Contrat::join('agents','agents.id','=','contrats.agent')
        ->where('agents.id','!=',3394);
    }
    public function columns()
    {

        if (Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup') {
            return [
                Column::callback(['agents.firstname','agents.lastname','agents.middlename'], function ($f,$l,$m) {
                    return $f.' '.$l.' '.$m;
                })->label('Agent')->searchable(),

                Column::name('type')
                    ->label('Type')->searchable(),

                Column::callback(['contrats.id'], function ($x) {

                    $pr = PartContrat::where('contrat',$x)->get();
                    $n = '<ul>';
                        foreach ($pr as $br) {
                            
                        $n .= '<li><a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" >'.Projet::find($br->projet)->name.'</a><span class="badge badge-success">$'.$br->pourcentage.'%</span></li>';  
                        }
                        
                        return $n ;
                })->label('Projets'),

                Column::name('contrats.debut')
                    ->label('Debut'),

                Column::name('contrats.fin')
                    ->label('Fin'),



                BooleanColumn::name('contrats.active')
                    ->label('statut'),

                Column::callback(['contrats.id','contrats.active'], function ($id,$active) {

                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" ><i class="icon-trash txt-danger"></i></a>';
                    $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" ><i class="icon-pencil"></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restorePrix(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
                })->unsortable(),
            ];
        }else{
            return [
                Column::callback(['agents.firstname','agents.lastname','agents.middlename'], function ($f,$l,$m) {
                    return $f.' '.$l.' '.$m;
                })->label('Agent')->searchable(),

                Column::name('type')
                    ->label('Type')->searchable(),

                Column::callback(['contrats.id'], function ($x) {

                    $pr = PartContrat::where('contrat',$x)->get();
                    $n = '<ul>';
                        foreach ($pr as $br) {
                            
                        $n .= '<li><a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" >'.Projet::find($br->projet)->name.'</a><span class="badge badge-success">$'.$br->pourcentage.'%</span></li>';  
                        }
                        
                        return $n ;
                })->label('Projets'),

                Column::name('contrats.debut')
                    ->label('Debut'),

                Column::name('contrats.fin')
                    ->label('Fin'),



                BooleanColumn::name('contrats.active')
                    ->label('statut'),
            ];
        }

        
    }
}
