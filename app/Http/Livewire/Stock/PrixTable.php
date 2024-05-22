<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use Livewire\Component;
use App\Models\Fournisseur;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PrixTable extends LivewireDatatable
{
    public $model = Price::class;
    public $modelId;

    protected $listeners = [
        'prixUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editPrix',$this->modelId );
    }
    public function deletePrix($modelId){
        $this->modelId = $modelId;
        Price::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restorePrix($modelId){
        $this->modelId = $modelId;
        Price::find($this->modelId)->update([
            'active' => 1,
        ]);
    }
    public function columns()
    {
        return [
            Column::callback(['product'], function ($x) {
                return Product::find(Article::find($x)->product)->name.' '.Article::find($x)->marque.' '.Article::find($x)->model ;
            })->label('Produit'),

            Column::name('debut')
                ->label('Debut'),

            Column::name('fin')
                ->label('Fin'),

            Column::name('prix')
                ->label('Prix'),


            BooleanColumn::name('active')
                ->label('State'),

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
