<?php

namespace App\Http\Livewire\Finance;

use App\Models\Affectation;
use App\Models\Bp;
use App\Models\Nd;
use App\Models\NdOder;
use App\Models\Projet;
use App\Models\User;
use App\Models\ValidNd;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class NoteDebitTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'ndUpdated' => '$refresh'
    ];
    
    public function printNd($modelId){
        $this->modelId = $modelId;
        $this->emit('printNd',$this->modelId );
    }

    public function apprNd($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Nd::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidNd::create([
                'user' => Auth::user()->id,
                'nd' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refNd($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Nd::find($this->modelId)->update([
                'active' => 0,
            ]);
            ValidNd::create([
                'user' => Auth::user()->id,
                'nd' => $this->modelId,
                'resp' => false,
                'niv' => 1,
                'motif' => 'Nop a refaire',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function formBP4($modelId){
        $this->modelId = $modelId;
        $this->emit('formBP4',$this->modelId );
    }

    public function builder()
    {

        if (Auth::user()->role == 'S.E') {


            $nds = Nd::query()
            ->where('niv1', true)
            ->orderBy("id", "DESC");
            return $nds;

        }if(Auth::user()->role == 'COMPT2'){

            
            if(Affectation::where('agent', Auth::user()->agent)->where('projet', 3)->exists()){
                return Nd::query()->orderBy("id", "DESC");
            }else{
                return Nd::join('affectations', 'affectations.projet', '=', 'nds.projet')
                ->where('affectations.agent', Auth::user()->agent);
            }

        }else{
            return Nd::query()->orderBy("id", "DESC");
        }
    }




    public function columns()
    {
        if (Auth::user()->role == 'COMPT1') {


            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printNd('.$id.')" data-toggle="modal" data-target="#pNdModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = NdOder::where('nd',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1'], function ($active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1'], function ($id,$active,$niv1) {

                    if ($active == true && $niv1 == true) {

                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprNd('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refNd('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        } if (Auth::user()->role == 'COMPT2') {
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printNd('.$id.')" data-toggle="modal" data-target="#pNdModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = NdOder::where('nd',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1'], function ($active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1'], function ($id,$active,$niv1) {
                    if ($active == true && $niv1 == true) {

                        if (Bp::where("bc", $id)->where('categorie', 4)->exists()){

                            return '<span class="badge badge-success">BP Déjà fait</span>';
                        }else{
                            
                                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBP4('.$id.')" data-toggle="modal" data-target="#bp4ModalForms"><span class="badge badge-info">Faire un BP</span></a>';
                            
                        }
                    }

                })->label('Btn'),
            ];
        }else {

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printNd('.$id.')" data-toggle="modal" data-target="#pNdModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
                })->label('Projet')->filterable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['id'], function ($id) {
                    $some = NdOder::where('nd',$id)->selectRaw("prix * quantite as price")->get('price')
                    ->sum('price');
                    return '$ '.$some;
                })->label('Montant'),

                Column::callback(['active','niv1'], function ($active,$niv1) {

                    if ($active == true && $niv1 == true) {
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
