<?php

namespace App\Http\Livewire\Stock;

use Livewire\Component;
use App\Models\Fournisseur;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class FournisseursTable extends LivewireDatatable
{
    public $model = Fournisseur::class;
    public $modelId;

    protected $listeners = [
        'fournisseurUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editFournisseur',$this->modelId );
    }
    public function deleteFournisseur($modelId){
        $this->modelId = $modelId;
        Fournisseur::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreFournisseur($modelId){
        $this->modelId = $modelId;
        Fournisseur::find($this->modelId)->update([
            'active' => 1,
        ]);
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name'),

            Column::name('email')
                ->label('Adresse mail'),

            Column::name('phone')
                ->label('Numero de Telephone'),
            Column::callback(['catProduct'], function ($x) {
                return Categorie::find($x)->name;
            })->label('Categorie'),

            BooleanColumn::name('active')
                ->label('State'),

            Column::callback(['id','active'], function ($id,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteFournisseur(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nFournisseurModalForms"><i class="icon-pencil"></i></a>';
                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreFournisseur(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),
        ];
    }
}
