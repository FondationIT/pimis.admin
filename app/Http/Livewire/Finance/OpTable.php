<?php

namespace App\Http\Livewire\Finance;

use App\Models\Bp;
use App\Models\Compte;
use App\Models\Fournisseur;
use App\Models\Op;
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

class OpTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'opUpdated' => '$refresh'
    ];

    public function printBp($modelId){
        $this->modelId = $modelId;
        $this->emit('printBp',$this->modelId );
    }

    public function builder()
    { 
        
 
            return Op::query()->orderBy("id", "DESC");

      
       
    }

    public function columns()
    {

        return [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
            })->label('Reference'),

            Column::callback(['bp','id'], function ($bp,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$bp.')" data-toggle="modal" data-target="#pBpModalForms">'.Bp::where('id',$bp)->get()[0]->reference.'</a>';
            })->label('Reference BP'),

            Column::callback(['projet','id'], function ($projet,$id) {
                return 'Projet '.Projet::where('id',$projet)->get()[0]->name;
            })->label('Donneur'),

            Column::name('beneficiare')
                ->label('Beneficiaire'),

            Column::name('banqueB')
                ->label('Banque'),

            Column::callback(['montant'], function ($s) {
                return '$ '.$s;
            })->label('Montant'),

        ];
    }
}
