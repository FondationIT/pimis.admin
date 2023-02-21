<?php

namespace App\Http\Livewire\Stock;

use Livewire\Component;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CategoriesTable extends LivewireDatatable
{
    public $model = Categorie::class;
    public $modelId;

    protected $listeners = [
        'categorieUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editCategorie',$this->modelId );
    }
    public function deleteCategorie($modelId){
        $this->modelId = $modelId;
        Categorie::find($this->modelId)->update([
            'active' => 0,
        ]);
        Product::where('categorie', $this->modelId)->update([
            'active' => 0,
        ]);
        $this->emit('productUpdated');
    }

    public function restoreCategorie($modelId){
        $this->modelId = $modelId;
        Categorie::find($this->modelId)->update([
            'active' => 1,
        ]);
        Product::where('categorie',$this->modelId)->update([
            'active' => 1,
        ]);
        $this->emit('productUpdated');
    }
    public function columns()
    {
        return [
            Column::name('name')
                ->label('Name'),

            BooleanColumn::name('active')
                ->label('State'),

            Column::callback(['id','active'], function ($id,$active) {

                $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteCategorie(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nCategorieModalForms"><i class="icon-pencil"></i></a>';
                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreCategorie(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                }
                    return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
            })->unsortable(),
        ];
    }
}
