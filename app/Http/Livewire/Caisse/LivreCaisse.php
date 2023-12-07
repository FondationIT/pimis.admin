<?php

namespace App\Http\Livewire\Caisse;

use App\Models\Be;
use App\Models\Bp;
use App\Models\Cheque;
use App\Models\Decharge;
use App\Models\LivreCaisse as ModelsLivreCaisse;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LivreCaisse extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'livreCaisseUpdated'=> '$refresh',
    ];

    public function builder()
    {
        return ModelsLivreCaisse::query();
    }

    public function print($modelId){
        $this->modelId = $modelId;
        $this->emit('print',$this->modelId );
    }

    public function getProjetsProperty()
    {
        return Projet::all();
    }

    public function columns()
    {

        return [

            DateColumn::raw('created_at')
                ->label('Date')
                ->filterable(),
            

            Column::callback(['projet'], function ($s) {
                return Projet::where('id',$s)->get()[0]->name; 
            })
                ->filterable($this->projets)
                ->label('Projet'),

            Column::callback(['index','type'], function ($id,$type) {
                
                if($type == 11){
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pMissionModalForms">'.Cheque::query()->where("id", $id)->get()[0]->reference.'</a>';
                }elseif($type == 12){
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pMissionModalForms">'.Be::query()->where("id", $id)->get()[0]->reference.'</a>';
                }if($type == 21){
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pMissionModalForms">'.Decharge::query()->where("id", $id)->get()[0]->reference.'</a>';
                }
            })->label('Piece'),

            Column::callback(['entree'], function ($s) {
                if($s == 0){
                    return '';
                }else{
                    return '<span class="badge badge-success">$'.$s.'</span>';
                }
                
            })->label('Entree en $'),

            Column::callback(['sortie'], function ($s) {
                if($s == 0){
                    return '';
                }else{
                    return '<span class="badge badge-danger">$'.$s.'</span>';
                }
            })->label('Sortie en $'),

            Column::name('libelle')
                ->label('Linelle'),

            Column::name('type')
                ->label('Solde'),
        ];

        
    }
}
