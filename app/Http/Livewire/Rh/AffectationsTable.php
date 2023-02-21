<?php

namespace App\Http\Livewire\Rh;

use Livewire\Component;
use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Projet;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AffectationsTable extends LivewireDatatable
{
    public $model = Affectation::class;
    public $modelId;

    protected $listeners = [
        'affectationUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editAffectation',$this->modelId );
    }
    public function deleteAffectation($modelId){
        $this->modelId = $modelId;
        Affectation::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreAffectation($modelId){
        $this->modelId = $modelId;
        Affectation::find($this->modelId)->update([
            'active' => 1,
        ]);
    }
    public function columns()
    {
        return [

            Column::callback(['agent'], function ($agent) {
                return Agent::find($agent)->firstname.' '.Agent::find($agent)->lastname;
            })->label('Agent'),

            Column::name('poste')
                ->label('Poste'),

            Column::callback(['projet'], function ($projet) {
                return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
            })->label('Projet'),

            Column::name('lieu')
                ->label('Lieu d\'affectation'),

            BooleanColumn::name('active')
                ->label('State'),

            Column::callback(['id','active'], function ($id,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteAffectation(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nAffectationModalForms"><i class="icon-pencil"></i></a>';
                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreAffectation(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),
        ];

    }
}
