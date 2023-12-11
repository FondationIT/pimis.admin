<?php

namespace App\Http\Livewire\Rh;

use App\Models\Affectation;
use App\Models\Bp;
use App\Models\PayementAgent;
use App\Models\Projet;
use App\Models\ValidPaie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PaiementTable extends LivewireDatatable
{
    public $modelId;
    public $projet;

    protected $listeners = [
        'paieAUpdated'=> '$refresh'
    ];

    public function affiche($modelId){
        $this->modelId = $modelId;
        $this->emit('jpA',$this->modelId );
    }
    public function voir($modelId){
        $this->modelId = $modelId;
        $this->emit('listePaieAf',$this->modelId );
    }

    public function voir2($modelId,$projet){
        $this->modelId = $modelId;
        $this->projet = $projet;
        $this->emit('listePaieAf2',$this->modelId, $this->projet);
    }

    public function formBP6($modelId,$projet){
        $this->modelId = $modelId;
        $this->projet = $projet;
        $this->emit('formBP6',$this->modelId, $this->projet);
    }

    public function appC($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            PayementAgent::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidPaie::create([
                'user' => Auth::user()->id,
                'paie' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function appD($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            PayementAgent::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidPaie::create([
                'user' => Auth::user()->id,
                'paie' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function builder()
    {

        if (Auth::user()->role == 'COMPT1') {

            $das = PayementAgent::query()
            ->where('statut', true)
            ->orderBy("id", "DESC");
            return $das;

        }else if (Auth::user()->role == 'D.A.F') {

            $das = PayementAgent::query()
            ->where('statut', true)
            ->where('niv1', true)
            ->orderBy("id", "DESC");
            return $das;

        }else if (Auth::user()->role == 'COMPT2') {

            $das = PayementAgent::query()
            ->where('statut', true)
            ->where('niv1', true)
            ->where('niv2', true)
            ->orderBy("id", "DESC");
            $aff = Affectation::where('agent', Auth::user()->agent);

            return $aff;
            
            

        }else{
            return PayementAgent::query()->orderBy("id", "DESC");
        }
    }

    public function columns()
    {
        if (Auth::user()->role == 'COMPT1') {

            return [

                Column::name('reference')
                    ->label('Reference'),
    
                Column::name('type')
                    ->label('Type'),
    
                Column::name('month')
                    ->label('Mois'),
    
                BooleanColumn::name('niv1')
                    ->label('Chef Contable'),
    
                BooleanColumn::name('niv2')
                    ->label('D.A.F'),
    
                BooleanColumn::name('statut')
                    ->label('State'),

                Column::callback(['id','statut','niv1'], function ($id,$active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $edit = '';
                    }elseif($active == false){
                        $edit = '';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="appC('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit .'</div>'; ;
                })->unsortable(),
    
                Column::callback(['id','statut'], function ($id,$active) {
    
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="voir(' . $id . ')" data-toggle="modal" data-target="#listePaieModalForms"><span class="badge badge-success">Voir</span></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="affiche(' . $id . ')" data-toggle="modal" data-target="#jpAModalForms"><span class="badge badge-primary">Valider</span></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$delete .'</div>';
                })->unsortable(),
            ];

        }else if (Auth::user()->role == 'D.A.F') {

            return [

                Column::name('reference')
                    ->label('Reference'),
    
                Column::name('type')
                    ->label('Type'),
    
                Column::name('month')
                    ->label('Mois'),
    
                BooleanColumn::name('niv1')
                    ->label('Chef Contable'),
    
                BooleanColumn::name('niv2')
                    ->label('D.A.F'),
    
                BooleanColumn::name('statut')
                    ->label('State'),

                Column::callback(['id','statut','niv1','niv2'], function ($id,$active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $edit = '';
                    }elseif($active == false){
                        $edit = '';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="appD('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit .'</div>'; ;
                })->unsortable(),
    
                Column::callback(['id','statut'], function ($id,$active) {
    
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="voir(' . $id . ')" data-toggle="modal" data-target="#listePaieModalForms"><span class="badge badge-success">Voir</span></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="affiche(' . $id . ')" data-toggle="modal" data-target="#jpAModalForms"><span class="badge badge-primary">Valider</span></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$delete .'</div>';
                })->unsortable(),
            ];

        }else if (Auth::user()->role == 'COMPT2') {

            return [

                Column::callback(['projet'], function ($id) {
                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();

                    $projet = Projet::find($id)->name;

                    return $projet;

                })->label('Projet'),

                Column::callback(['agent'], function () {
                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();
					
					
                    return $das[0]->type;
					

                })->label('Type'),

                Column::callback(['cath'], function () {
                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();

                    return $das[0]->month;

                })->label('Mois'),

                BooleanColumn::callback(['active'], function () {
                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();

                    return $das[0]->niv1;

                })->label('Mois'),

                Column::callback(['id','projet'], function ($id,$projet) {

                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();

                    $di = $das[0]->id;

                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="voir2('.$di.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms"><span class="badge badge-success">Voir</span></i></a>';
                })->unsortable(),
    

                Column::callback(['projet','agent'], function ($projet,$agent) {

                    $das = PayementAgent::query()
                    ->where('statut', true)
                    ->where('niv1', true)
                    ->where('niv2', true)
                    ->orderBy("id", "DESC")->get();

                    $di = $das[0]->id;

                    if (Bp::where("bc", $di)->where('categorie', 6)->where('projet',$projet)->exists()){

                        return '<span class="badge badge-success">BP Déjà fait</span>';
                    }else{
                        
                            return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBP6('.$di.','.$projet.')" data-toggle="modal" data-target="#bp6ModalForms"><span class="badge badge-info">Faire un BP</span></a>';
                        
                    }
                    

                })->label('Action'),
            ];

        }else{
            return [

                Column::name('reference')
                    ->label('Reference'),
    
                Column::name('type')
                    ->label('Type'),
    
                Column::name('month')
                    ->label('Mois'),
    
                BooleanColumn::name('niv1')
                    ->label('Chef Contable'),
    
                BooleanColumn::name('niv2')
                    ->label('D.A.F'),
    
                BooleanColumn::name('statut')
                    ->label('State'),
    
                Column::callback(['id','statut'], function ($id,$active) {
    
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="voir(' . $id . ')" data-toggle="modal" data-target="#listePaieModalForms"><span class="badge badge-success">Voir</span></i></a>';
                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="affiche(' . $id . ')" data-toggle="modal" data-target="#jpAModalForms"><span class="badge badge-primary">Valider</span></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$delete .'</div>';
                })->unsortable(),
            ];
        }
        

    }
}
