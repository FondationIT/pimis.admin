<?php

namespace App\Http\Livewire\Finance;
use App\Models\Et_bes;
use App\Models\Projet;
use App\Models\Affectation;
use App\Models\User;
use App\Models\DemAch;
use App\Models\ValidEb;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;


class BonReq extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'ebUpdated' => '$refresh'
    ];

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }

    public function formDA($modelId){
        $this->modelId = $modelId;
        $this->emit('formDA',$this->modelId );
    }

    public function apprEb($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Et_bes::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidEb::create([
                'user' => Auth::user()->id,
                'eb' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }

    }
    public function cApprEb($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Et_bes::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidEb::create([
                'user' => Auth::user()->id,
                'eb' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refEb($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Et_bes::find($this->modelId)->update([
                'active' => 0,
            ]);
            ValidEb::create([
                'user' => Auth::user()->id,
                'eb' => $this->modelId,
                'resp' => false,
                'niv' => 3,
                'motif' => 'Nop a refaire',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function builder()
    {
        if(Auth::user()->role == 'COMPT1'){
            return Et_bes::query()->orderBy("id", "DESC");
        }elseif (Auth::user()->role == 'LOG2' || Auth::user()->role == 'LOG1') {

            $et_bes = Et_bes::query()
            ->where('niv1', true)
            ->where('niv2', true)
            ->where('active', true)
            ->orderBy("id", "DESC");
            return $et_bes;
        }elseif (Auth::user()->role == 'C.P') {

            $et_bes = Et_bes::join('affectations', 'affectations.projet', '=', 'et_bes.projet')
            ->where('affectations.agent', Auth::user()->agent)
            ->where('Et_bes.niv1', true)
            ->where('affectations.cath', '1');
            return $et_bes;
        }elseif (Auth::user()->role == 'COMPT2') {

            $et_bes = Et_bes::join('affectations', 'affectations.projet', '=', 'et_bes.projet')
            ->where('affectations.agent', Auth::user()->agent);
            return $et_bes;
        }else{
            return Et_bes::query()->orderBy("id", "DESC");
        }
    }

    public function columns()
    {
        if(Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2'){
            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {


                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }elseif($niv2 == false && $niv1 == true && $active == true){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprEb('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refEb('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        }elseif (Auth::user()->role == 'C.P') {


            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {

                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="cApprEb('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refEb('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        }elseif (Auth::user()->role == 'LOG2') {


            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent'),

                Column::callback(['id'], function ($id) {


                    $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="formDA('.$id.')" data-toggle="modal" data-target="#daModalForms"><span class="badge badge-info">Faire un D.A</span></a>';
                    if (DemAch::where("eb", $id)->exists()) {
                        $dsa = '<a><span class="badge badge-success">D.A deja faite</span></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                })->unsortable(),
            ];
        }else {

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
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
