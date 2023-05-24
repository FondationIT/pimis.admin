<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\ValidBc;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class BcTable extends LivewireDatatable
{
    public $model = Bc::class;

    public $modelId;

    public function printBc($modelId){
        $this->modelId = $modelId;
        $this->emit('printBc',$this->modelId );
    }

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPv',$this->modelId );
    }


    public function dApprBc($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Bc::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidBc::create([
                'user' => Auth::user()->id,
                'bc' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function sApprBc($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Bc::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidBc::create([
                'user' => Auth::user()->id,
                'bc' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refBc($modelId){
        $this->modelId = $modelId;
        Bc::find($this->modelId)->update([
            'active' => 0,
        ]);
    }


    public function builder()
    {

        if (Auth::user()->role == 'S.E') {

            $das = Bc::query()
            ->where('niv1', true)
            ->orderBy("id", "DESC");
            return $das;

        }else if (Auth::user()->role == 'MAG') {

            $das = Bc::query()
            ->where('niv1', true)
            ->where('niv2', true)
            ->orderBy("id", "DESC");
            return $das;

        }else{
            return Bc::query()->orderBy("id", "DESC");
        }
    }


    public function columns()
    {
        if(Auth::user()->role == 'D.A.F'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC'),

                Column::callback(['da'], function ($da) {
                    $x = Pv::where('da', $da)->get()[0]->fournisseur;
                    return Fournisseur::find($x)->name;
                })->label('Fournisseur'),

                Column::name('lieu')
                    ->label('Lieu de livraison'),

                Column::name('delai')
                    ->label('Delai de livraison'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->unsortable(),

                Column::callback(['id','active','niv1'], function ($id,$active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="dApprBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];


        }else if(Auth::user()->role == 'S.E'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC'),

                Column::callback(['da'], function ($da) {
                    $x = Pv::where('da', $da)->get()[0]->fournisseur;
                    return Fournisseur::find($x)->name;
                })->label('Fournisseur'),

                Column::name('lieu')
                    ->label('Lieu de livraison'),

                Column::name('delai')
                    ->label('Delai de livraison'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->unsortable(),


                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="sApprBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        }else if(Auth::user()->role == 'MAG'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC'),

                Column::callback(['da'], function ($da) {
                    $x = Pv::where('da', $da)->get()[0]->fournisseur;
                    return Fournisseur::find($x)->name;
                })->label('Fournisseur'),

                Column::name('lieu')
                    ->label('Lieu de livraison'),

                Column::name('delai')
                    ->label('Delai de livraison'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->unsortable(),


                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="sApprBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBc('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        }else{
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC'),

                Column::callback(['da'], function ($da) {
                    $x = Pv::where('da', $da)->get()[0]->fournisseur;
                    return Fournisseur::find($x)->name;
                })->label('Fournisseur'),

                Column::name('lieu')
                    ->label('Lieu de livraison'),

                Column::name('delai')
                    ->label('Delai de livraison'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->unsortable(),


                BooleanColumn::name('active')
                    ->label('State'),
            ];
        }


    }
}
