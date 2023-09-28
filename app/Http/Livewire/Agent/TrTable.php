<?php

namespace App\Http\Livewire\Agent;

use App\Models\Affectation;
use App\Models\Bp;
use App\Models\Mission;
use App\Models\Nd;
use App\Models\NdOder;
use App\Models\Projet;
use App\Models\Tr;
use App\Models\TrOder;
use App\Models\User;
use App\Models\ValidNd;
use App\Models\ValidTr;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class TrTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'trUpdated' => '$refresh'
    ];
    
    public function printTr($modelId){
        $this->modelId = $modelId;
        $this->emit('printTr',$this->modelId );
    }

    public function apprTr($modelId){
        $this->modelId = $modelId;
        $this->emit('formTrAppr',$this->modelId );
    }

    public function apprTr2($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Tr::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidTr::create([
                'user' => Auth::user()->id,
                'tr' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }
    public function apprTr3($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Tr::find($this->modelId)->update([
                'niv3' => 1,
            ]);
            ValidTr::create([
                'user' => Auth::user()->id,
                'tr' => $this->modelId,
                'resp' => true,
                'niv' => 3,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refTr($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Tr::find($this->modelId)->update([
                'active' => 0,
            ]);
            ValidTr::create([
                'user' => Auth::user()->id,
                'tr' => $this->modelId,
                'resp' => false,
                'niv' => 1,
                'motif' => 'Nop a refaire',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function formBP3($modelId){
        $this->modelId = $modelId;
        $this->emit('formBP3',$this->modelId );
    }

    public function formOM($modelId){
        $this->modelId = $modelId;
        $this->emit('formOM',$this->modelId );
    }

    public function builder()
    {

        if (Auth::user()->role == 'D.A.F') {


            $trs = Tr::query()
            ->where('niv1', true)
            ->where('niv2', true)
            ->orderBy("id", "DESC");
            return $trs;

        }else if (Auth::user()->role == 'C.P') {


            $trs = Tr::query()
            ->where('niv1', true)
            ->orderBy("id", "DESC");
            return $trs;

        }else if (Auth::user()->role == 'R.H') {


            $trs = Tr::query()
            ->where('niv1', true)
            ->where('niv2', true)
            ->where('niv3', true)
            ->where('type', 1)
            ->orderBy("id", "DESC");
            return $trs;

        }if(Auth::user()->role == 'COMPT2'){
            
            return Tr::join('affectations', 'affectations.projet', '=', 'trs.projet')
            ->where('affectations.agent', Auth::user()->agent);
            

        }else{
            return Tr::query()->orderBy("id", "DESC");
        }
    }




    public function columns()
    {
        if (Auth::user()->role == 'D.A.F') {


            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = TrOder::where('tr',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1','niv2','niv3'], function ($active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2','niv3'], function ($id,$active,$niv1,$niv2,$niv3) {

                    if($active == true){

                        if($niv1 == true && $niv2 == true && $niv3 == true){

                            return '';
                            
                        }else{
                            $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprTr3('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                            $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refTr('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';

                            return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>';
                        }
                    }else if($active == false){

                        return '<span class="badge badge-danger">Refusé</span>';

                    }

                })->label('Btn'),
            ];
        } if (Auth::user()->role == 'COMPT2') {
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = TrOder::where('tr',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1','niv2','niv3'], function ($active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2','niv3'], function ($id,$active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {

                        if (Bp::where("bc", $id)->where('categorie', 3)->exists()){

                            return '<span class="badge badge-success">BP Déjà fait</span>';
                        }else{
                            
                                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBP3('.$id.')" data-toggle="modal" data-target="#bp3ModalForms"><span class="badge badge-info">Faire un BP</span></a>';
                            
                        }
                    }else if($active == true){

                        if($niv1 == true){

                            return '';
                            
                        }else{
                            $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprTr('.$id.')" data-toggle="modal" data-target="#appEtBesModalForms"><i class="icon-like txt-danger"></i></a>';

                            $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refTr('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';

                            return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>';
                        }
                    }else if($active == false){

                        return '<span class="badge badge-danger">Refusé</span>';

                    }

                })->label('Btn'),
            ];
        }if (Auth::user()->role == 'C.P') {
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = TrOder::where('tr',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1','niv2','niv3'], function ($active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2','niv3'], function ($id,$active,$niv1,$niv2,$niv3) {

                    if($active == true){

                        if($niv1 == true && $niv2 == true){

                            return '';
                            
                        }else{
                            $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprTr2('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                            $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refTr('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';

                            return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>';
                        }
                    }else if($active == false){

                        return '<span class="badge badge-danger">Refusé</span>';

                    }

                })->label('Btn'),
            ];
        }if (Auth::user()->role == 'R.H') {
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::name('titre')
                    ->label('Titre'),

                Column::callback(['active','niv1','niv2','niv3'], function ($active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2','niv3'], function ($id,$active,$niv1,$niv2,$niv3) {

                    if (Mission::where("tr", $id)->exists()){

                        $dsa = '<span class="badge badge-success">Mission exixte</span>';

                    }else{
                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formOM('.$id.')" data-toggle="modal" data-target="#omModalForms"><span class="badge badge-info">Faire un OM</span></a>';
                    }
                    return $dsa;

                })->label('Btn'),
            ];
        }else {

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printTr('.$id.')" data-toggle="modal" data-target="#pTrModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = TrOder::where('tr',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1','niv2','niv3'], function ($active,$niv1,$niv2,$niv3) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),
            ];
        }
    }
}
