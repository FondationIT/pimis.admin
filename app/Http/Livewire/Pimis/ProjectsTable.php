<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Projet;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ProjectsTable extends LivewireDatatable
{
    public $model = Projet::class;
    public $modelId;

    protected $listeners = [
        'projectUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editProject',$this->modelId );
    }
    public function deleteProject($modelId){
        $this->modelId = $modelId;
        Projet::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreProject($modelId){
        $this->modelId = $modelId;
        Projet::find($this->modelId)->update([
            'active' => 1,
        ]);
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name'),

            Column::name('dateD')
                ->label('Date debut'),
            Column::name('dateF')
                ->label('Date fin'),

            BooleanColumn::name('active')
                ->label('State'),

            Column::callback(['id','active'], function ($id,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteProject(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nProjectModalForms"><i class="icon-pencil"></i></a>';
                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreProject(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),
        ];
    }
}
