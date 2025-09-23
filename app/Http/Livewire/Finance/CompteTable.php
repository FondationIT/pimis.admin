<?php

namespace App\Http\Livewire\Finance;

use App\Models\Agent;
use App\Models\Compte;
use App\Models\Fournisseur;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class CompteTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'CompteUpdated' => '$refresh'
    ];

    public function builder()
    { 
        if (Auth::user()->role == 'R.H') {
 
            return Compte::query()
            ->where('type', 2)
            ->orderBy("id", "DESC");

        }else if (Auth::user()->role == 'LOG1' || Auth::user()->role == 'LOG2') {

            return Compte::query()
            ->where('type', 3)
            ->orderBy("id", "DESC");

        }else if (Auth::user()->role == 'COMPT1' || Auth::user()->role == 'COMPT2' || Auth::user()->role == 'C.P') {

            return Compte::query()
            ->where('type', 1)
            ->orderBy("id", "DESC");

        }else{
            return Compte::query()
            ->orderBy("id", "DESC");
        }
       
    }

    public function columns()
    {

        return [

            Column::name('intitule')
                ->label('Intitulé')->searchable(),

            Column::name('numero')
                ->label('Numero')->searchable(),

            Column::callback(['proprietaire','type'], function ($id,$cat) {
                if($cat == 1){
                    return Projet::where('id',$id)->get()[0]->name;
                }else if($cat == 3){
                    return Fournisseur::where('id',$id)->get()[0]->name;
                }else if($cat == 2){
                    return Agent::where('id',$id)->get()[0]->firstname;
                }
            })->label('Proprietaire')->searchable(),

            Column::name('banque')
                ->label('Banque')->searchable(),

        ];
    }
    
}