<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;



class ArticleTable extends LivewireDatatable
{
    public $model = Article::class;
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
        $this->emit('editArticle',$this->modelId );
    }
    public function delete($modelId){
        $this->modelId = $modelId;
        Article::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restore($modelId){
        $this->modelId = $modelId;
        Article::find($this->modelId)->update([
            'active' => 1,
        ]);
    }

    public function columns()
    {
        if(Auth::user()->role == 'LOG1' ||Auth::user()->role == 'LOG2' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup'){

            return [

                Column::callback(['product','marque','model'], function ($designation,$marque,$model) {

                    $designation = Product::where('id', $designation)->get();
                    return $designation[0]->name.' '.$marque.' '.$model;
                })->label('Desination'),

                Column::name('unite')
                    ->label('Unite'),

                Column::callback(['id'], function ($id) {
                    $today = date('Y-m-d');
                    $delete = '<span class="badge badge-danger">Expiré</span>';
                    if (Price::where('product', $id)->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->where('active', true)->exists()) {
                        $delete = Price::where('product', $id)->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->where('active', true)->get();
                        $delete = '<span class="badge badge-success">$'.$delete[0]->prix.'</span>';
                    }
                    return $delete;
                })->label('Prix'),

                BooleanColumn::name('active')
                    ->label('State'),

                Column::callback(['id','active'], function ($id,$active) {

                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="delete(' . $id . ')"><i class="icon-trash txt-danger"></i></a>';
                    $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#articleModalForms"><i class="icon-pencil"></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restore(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$edit . $delete .'</div>';
                })->unsortable(),
            ];

        }else{

            return [

                Column::callback(['product','marque','model'], function ($designation,$marque,$model) {

                    $designation = Product::where('id', $designation)->get();
                    return $designation[0]->name.' '.$marque.' '.$model;
                })->label('Desination'),

                Column::name('unite')
                    ->label('Unite'),
                Column::callback(['id'], function ($id) {
                    $today = date('Y-m-d');
                    $delete = '<span class="badge badge-danger">Expiré</span>';
                    if (Price::where('product', $id)->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->where('active', true)->exists()) {
                        $delete = Price::where('product', $id)->whereDate('debut','<=', $today)->whereDate('fin','>=', $today)->where('active', true)->get();
                        $delete = '<span class="badge badge-success">$'.$delete[0]->prix.'</span>';
                    }
                    return $delete;
                })->label('Prix'),

            ];

        }

    }
}
