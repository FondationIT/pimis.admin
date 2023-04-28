<?php

namespace App\Http\Livewire\Stock;

use App\Models\Et_bes;
use App\Models\Projet;
use App\Models\DemAch;
use App\Models\ValidDa;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class DaTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'demAchUpdated' => '$refresh'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }

    public function formPV($modelId){
        $this->modelId = $modelId;
        $this->emit('formPV',$this->modelId );
    }

    public function fApprDa($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            DemAch::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidDa::create([
                'user' => Auth::user()->id,
                'da' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }
    public function lApprDa($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            DemAch::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidDa::create([
                'user' => Auth::user()->id,
                'da' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function cApprDa($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            DemAch::find($this->modelId)->update([
                'niv3' => 1,
            ]);
            ValidDa::create([
                'user' => Auth::user()->id,
                'da' => $this->modelId,
                'resp' => true,
                'niv' => 3,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function dfApprDa($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            DemAch::find($this->modelId)->update([
                'niv4' => 1,
            ]);
            ValidDa::create([
                'user' => Auth::user()->id,
                'da' => $this->modelId,
                'resp' => true,
                'niv' => 4,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refDa($modelId){
        $this->modelId = $modelId;
        DemAch::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function builder()
    {

        if(Auth::user()->role == 'LOG2' || Auth::user()->role == 'Sup'|| Auth::user()->role == 'D.A.F'){
            return DemAch::query()->orderBy("id", "DESC");
        }elseif(Auth::user()->role == 'LOG1'){
            return DemAch::query()
            ->orderBy("id", "DESC");
        }elseif (Auth::user()->role == 'C.P') {

            $das = DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
            ->join('affectations', 'affectations.projet', '=', 'et_bes.projet')
            ->where('affectations.agent', Auth::user()->agent)
            ->where('dem_aches.niv1', true)
            ->where('dem_aches.niv2', true)
            ->where('affectations.cath', '1');
            return $das;
        }elseif (Auth::user()->role == 'COMPT2') {

            $das = DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
            ->join('affectations', 'affectations.projet', '=', 'et_bes.projet')
            ->where('affectations.agent', Auth::user()->agent)
            ->where('dem_aches.niv1', true);
            return $das;
        }elseif (Auth::user()->role == 'COMPT1') {

            $das = DemAch::query()
            ->where('dem_aches.niv1', true)
            ->orderBy("id", "DESC");
            return $das;
        }
    }

    public function columns()
    {
        if(Auth::user()->role == 'COMPT1' ||Auth::user()->role == 'COMPT2'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                BooleanColumn::name('niv2')
                    ->label('Comptable'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['id','active','niv2'], function ($id,$active,$niv2) {

                    if ($active == true && $niv2 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="fApprDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),

            ];
        }if(Auth::user()->role == 'LOG2'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                BooleanColumn::name('niv1')
                    ->label('Logistique'),

                BooleanColumn::name('niv2')
                    ->label('Comptable'),

                BooleanColumn::name('niv3')
                    ->label('Chef Projet'),

                BooleanColumn::name('niv4')
                    ->label('D.A.F'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

            ];
        }if(Auth::user()->role == 'LOG1'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                BooleanColumn::name('niv1')
                    ->label('Logistique'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['id','active','niv1','niv2','niv3','niv4'], function ($id,$active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="formPV('.$id.')" data-toggle="modal" data-target="#pvModalForms"><span class="badge badge-info">Faire un P.V</span></a>';

                        if (DemAch::where("eb", $id)->exists()) {
                            $dsa = '<a><span class="badge badge-success">P.V deja faite</span></a>';
                        }
                        $edit = '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                        return $edit;
                    }else if ($active == true && $niv1 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="lApprDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),

            ];
        }if(Auth::user()->role == 'C.P'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                BooleanColumn::name('niv3')
                    ->label('Chef Projet'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['id','active','niv3'], function ($id,$active,$niv3) {

                    if ($active == true && $niv3 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="cApprDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),

            ];
        }
        if(Auth::user()->role == 'D.A.F'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['id','active','niv4'], function ($id,$active,$niv4) {

                    if ($active == true && $niv4 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="dfApprDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),


            ];
        }
//////////////////////////////////////////////////////////////////////
////////////////////////ADMIN AND SUPER //////////////////////////////
//////////////////////////////////////////////////////////////////////

        if(Auth::user()->role == 'Sup'){

            return [

                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref'),

                Column::callback(['eb'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.Et_bes::find($eb)->reference.'</a>';
                })->label('B.R Ref'),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['active','niv1','niv2','niv3','niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable()


            ];
        }
    }
}
