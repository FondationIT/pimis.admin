<?php

namespace App\Http\Livewire\Caisse;

use App\Models\Affectation;
use App\Models\Bp;
use App\Models\Cheque;
use App\Models\Compte;
use App\Models\Decharge;
use App\Models\Fournisseur;
use App\Models\Projet;
use App\Models\RCaisse;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RapportTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'rapportCUpdated' => '$refresh'
    ];

    public function printBp($modelId){
        $this->modelId = $modelId;
        $this->emit('printBp',$this->modelId );
    }

    public function formBP5($modelId){
        $this->modelId = $modelId;
        $this->emit('formBP5',$this->modelId );
    }

    public function builder()
    { 
        
 
            
            if(Auth::user()->role == 'COMPT2'){

            
                if(Affectation::where('agent', Auth::user()->agent)->where('projet', 3)->exists()){
                    return Projet::query()->orderBy("id", "DESC");
                }else{
                    return Projet::join('affectations', 'affectations.projet', '=', 'projets.id')
                    ->where('affectations.agent', Auth::user()->agent);
                }
    
            }else{
                return Projet::query()->orderBy("id", "DESC");
            }

      
       
    }

    public function columns()
    {
        if(Auth::user()->role == 'COMPT2'){

            return [
                Column::name('reference')
                ->label('Reference'),

                Column::callback(['name'], function ($name) {
                    return $name;;
                })->label('Projet'),

                Column::callback(['id'], function ($id) {

                    $s = RCaisse::where('projet', $id )->orderBy('created_at', 'desc')->first()->solde;

                    if ($s < 500) {
    
                        $dsa = '<span class="badge badge-danger">$'. $s.'</span>';
                        
                    }else{
                        $dsa = '<span class="badge badge-success">$'. $s.'</span>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';

                })->label('Solde'),

                Column::callback(['id','bailleur'], function ($id,$b){

                    $s = RCaisse::where('projet', $id )->orderBy('created_at', 'desc')->first()->solde;

                    if ($s < 500) {
    
                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBP5('.$id.')" data-toggle="modal" data-target="#bp5ModalForms"><span class="badge badge-info">Approvisionner</span></a>';
                        
                    }else{
                        $dsa = '<span class="badge badge-success">ok</span>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                })->label('Action'),

            ];
        }else{
            return [
                Column::name('reference')
                ->label('Reference'),

                Column::callback(['name'], function ($name) {
                    return $name;;
                })->label('Projet'),

                Column::callback(['id'], function ($id) {

                    $s = RCaisse::where('projet', $id )->orderBy('created_at', 'desc')->first()->solde;

                    if ($s < 500) {
    
                        $dsa = '<span class="badge badge-danger">$'. $s.'</span>';
                        
                    }else{
                        $dsa = '<span class="badge badge-success">$'. $s.'</span>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';

                })->label('Solde'),

            ];
        }
    }
}
