<?php

namespace App\Http\Livewire\Stock;

use Livewire\Component;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
class ProductsTable extends LivewireDatatable
{
    public $model = Product::class;
    public $modelId;

    protected $listeners = [
        'productUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editProduct',$this->modelId );
    }
    public function deleteProduct($modelId){
        $this->modelId = $modelId;
        Product::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreProduct($modelId){
        $this->modelId = $modelId;
        Product::find($this->modelId)->update([
            'active' => 1,
        ]);
    }

    public function columns()
    {
        if(Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup'){

            return [

                Column::name('designation')
                    ->label('Desination'),

                Column::name('unite')
                    ->label('Unite'),

                Column::callback(['id'], function ($id) {
                    $today = date('Y-m-d');
                    if (Price::where('product', $id)->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->exists()) {
                        $delete = '200';
                    }
                        return '0';
                })->label('Prix'),

                BooleanColumn::name('active')
                    ->label('State'),

                Column::callback(['id','active'], function ($id,$active) {

                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteProduct(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                    $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nProductModalForms"><i class="icon-pencil"></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreProduct(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
                })->unsortable(),
            ];

        }else{

            return [

                Column::name('designation')
                    ->label('Desination'),

                Column::name('unite')
                    ->label('Unite'),

                Column::name('prix')
                    ->label('prix'),
            ];

        }

    }
}
