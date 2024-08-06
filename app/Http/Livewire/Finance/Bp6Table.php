<?php

namespace App\Http\Livewire\Finance;

use App\Models\Bp;
use App\Models\Cheque;
use App\Models\Decharge;
use App\Models\Op;
use App\Models\PayementAgent;
use App\Models\Tr;
use App\Models\User;
use App\Models\ValidBp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class Bp6Table extends LivewireDatatable
{
    public $modelId;
    public $projet;

    protected $listeners = [
        'bpUpdated' => '$refresh'
    ];

    public function printBp($modelId){
        $this->modelId = $modelId;
        $this->emit('printBp',$this->modelId );
    }

    public function cApprBp($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Bp::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidBp::create([
                'user' => Auth::user()->id,
                'bp' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function printIndex($modelId,$projet){
        $this->modelId = $modelId;
        $this->projet = $projet;
        $this->emit('listePaieAf2',$this->modelId, $this->projet);
    }



    public function dApprBp($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            if(Bp::find($this->modelId)->type == 1){

                Bp::find($this->modelId)->update([
                    'niv2' => 1,
                    'niv3' => 1,
                ]);
            }else{
                Bp::find($this->modelId)->update([
                    'niv2' => 1,
                ]);
            }
            
            ValidBp::create([
                'user' => Auth::user()->id,
                'bp' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function sApprBp($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Bp::find($this->modelId)->update([
                'niv3' => 1,
            ]);
            ValidBp::create([
                'user' => Auth::user()->id,
                'bp' => $this->modelId,
                'resp' => true,
                'niv' => 3,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refBp($modelId){
        $this->modelId = $modelId;
        Bp::find($this->modelId)->update([
            'active' => 0,
        ]);
    }




    public function formOP($modelId){
        $this->modelId = $modelId;
        $this->emit('formOP',$this->modelId );
    }

    public function formCheque($modelId){
        $this->modelId = $modelId;
        $this->emit('formCheque',$this->modelId );
    }

    public function formDecharge($modelId){
        $this->modelId = $modelId;
        $this->emit('formDecharge',$this->modelId );
    }




    public function builder()
    {

        if (Auth::user()->role == 'S.E') {


            $bps = Bp::query()
            ->where('niv2', true)
            ->where('type','!=', 1)
            ->where('categorie', 6)
            ->orderBy("id", "DESC");
            return $bps;

        }else if (Auth::user()->role == 'D.A.F') {

            $bps = Bp::query()
            ->where('niv1', true)
            ->where('type','!=', 1)
            ->where('categorie', 6)
            ->where('montant','>=', 500)
            ->orderBy("id", "DESC");
            return $bps;

        }else if (Auth::user()->role == 'C.P') {

            $bps = Bp::join('affectations', 'affectations.projet', '=', 'bps.projet')
            ->where('affectations.agent', Auth::user()->agent)
            ->where('categorie', 6)
            ->where('affectations.cath', '1');
            
            return $bps;

        }else if (Auth::user()->role == 'COMPT1') {

            $bps = Bp::query()
            ->where('niv1', true)
            ->where('categorie', 6)
            ->orderBy("id", "DESC");
            return $bps;

        }else if (Auth::user()->role == 'CAISS') {

            $bps = Bp::query()
            ->where('niv1', true)
            ->where('niv2', true)
            ->where('niv3', true)
            ->where('type',1)
            ->where('categorie', 6)
            ->orderBy("id", "DESC");
            return $bps;

        }else{
            return Bp::query()->orderBy("id", "DESC")
            ->where('categorie', 6);
        }
    }

    public function columns()
    {
        if(Auth::user()->role == 'D.A.F' || Auth::user()->role == 'COMPT1'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$id.')" data-toggle="modal" data-target="#pBpModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),

                Column::callback(['bc','projet'], function ($id,$projet) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printIndex('.$id.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms">'.PayementAgent::where('id',$id)->get()[0]->reference.'</i></a>';
                    
                })->label('Justif')->searchable(),

                Column::callback(['beneficiaire'], function ($id) {
                    
                    return 'Compte Salaire';
                    
                })->label('Beneficiaire'),

                Column::callback('montant', function ($some) {
                    return '<span class="badge badge-danger">$ '.$some.'</span>';
                })->label('Montant'),
                
                Column::callback('type', function ($type) {

                    if($type == 1){
                        $t = 'Caisse';
                    }else if($type == 2){
                        $t = 'Chèque';
                    }else if($type == 3){
                        $t = 'Transfert bancaire';
                    }
                    return $t;
                })->label('Paiement'),

                Column::name('dateP')
                    ->label('Date'),

                Column::callback(['active','niv3','niv2'], function ($active,$niv3,$niv2) {

                    if ($active == true && $niv2 == true && $niv3 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->label('Statut'),

                Column::callback(['id','active','niv2'], function ($id,$active,$niv2) {

                    if ($active == true && $niv2 == true) {
                        $edit = '<span class="badge badge-success">Ok</span>';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '<span class="badge badge-danger">No</span>';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="dApprBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->label('Action'),

            ];


        }else if(Auth::user()->role == 'S.E'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$id.')" data-toggle="modal" data-target="#pBpModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),


                Column::callback(['bc','projet'], function ($id,$projet) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printIndex('.$id.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms">'.PayementAgent::where('id',$id)->get()[0]->reference.'</i></a>';
                    
                })->label('Justif')->searchable(),

                Column::callback(['beneficiaire'], function ($id) {
                    
                    return 'Compte Salaire';
                    
                })->label('Beneficiaire'),

                Column::callback('montant', function ($some) {
                    return '<span class="badge badge-danger">$ '.$some.'</span>';
                })->label('Montant'),
                
                Column::callback('type', function ($type) {

                    if($type == 1){
                        $t = 'Caisse';
                    }else if($type == 2){
                        $t = 'Chèque';
                    }else if($type == 3){
                        $t = 'Transfert bancaire';
                    }
                    return $t;
                })->label('Paiement'),

                Column::name('dateP')
                    ->label('Date'),

                Column::callback(['active','niv3','niv2'], function ($active,$niv3,$niv2) {

                    if ($active == true && $niv2 == true && $niv3 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->label('Statut'),

                Column::callback(['id','active','niv3'], function ($id,$active,$niv3) {

                    if ($active == true && $niv3 == true) {
                        $edit = '<span class="badge badge-success">Ok</span>';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '<span class="badge badge-danger">No</span>';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="sApprBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->label('Action'),

            ];
        }else if(Auth::user()->role == 'C.P'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$id.')" data-toggle="modal" data-target="#pBpModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),


                Column::callback(['bc','projet'], function ($id,$projet) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printIndex('.$id.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms">'.PayementAgent::where('id',$id)->get()[0]->reference.'</i></a>';
                    
                })->label('Justif')->searchable(),

                Column::callback(['beneficiaire'], function ($id) {
                    
                    return 'Compte Salaire';
                    
                })->label('Beneficiaire'),

                Column::callback('montant', function ($some) {
                    return '<span class="badge badge-danger">$ '.$some.'</span>';
                })->label('Montant'),
                
                Column::callback('type', function ($type) {

                    if($type == 1){
                        $t = 'Caisse';
                    }else if($type == 2){
                        $t = 'Chèque';
                    }else if($type == 3){
                        $t = 'Transfert bancaire';
                    }
                    return $t;
                })->label('Paiement'),

                Column::name('dateP')
                    ->label('Date'),

                Column::callback(['active','niv3','niv2'], function ($active,$niv3,$niv2) {

                    if ($active == true && $niv2 == true && $niv3 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->label('Statut'),

                Column::callback(['id','active','niv1'], function ($id,$active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $edit = '<span class="badge badge-success">Ok</span>';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '<span class="badge badge-danger">No</span>';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="cApprBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refBp('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->label('Action'),

            ];
        }else if(Auth::user()->role == 'CAISS'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$id.')" data-toggle="modal" data-target="#pBpModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),


                Column::callback(['bc','projet'], function ($id,$projet) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printIndex('.$id.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms">'.PayementAgent::where('id',$id)->get()[0]->reference.'</i></a>';
                    
                })->label('Justif')->searchable(),

                Column::callback(['beneficiaire'], function ($id) {
                    
                    return 'Compte Salaire';
                    
                })->label('Beneficiaire'),

                Column::callback('montant', function ($some) {
                    return '<span class="badge badge-danger">$ '.$some.'</span>';
                })->label('Montant'),
                
                Column::callback('type', function ($type) {

                    if($type == 1){
                        $t = 'Caisse';
                    }else if($type == 2){
                        $t = 'Chèque';
                    }else if($type == 3){
                        $t = 'Transfert bancaire';
                    }
                    return $t;
                })->label('Paiement'),

                Column::name('dateP')
                    ->label('Date'),

                Column::callback(['active','niv3','niv2'], function ($active,$niv3,$niv2) {

                    if ($active == true && $niv2 == true && $niv3 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->label('Statut'),

                Column::callback(['id','type','montant'], function ($id,$cat,$s) {

                    if ($cat == 1) {

                        if (Decharge::where("bp", $id)->exists()){

                            $dsa = '<span class="badge badge-success">Payé</span>';

                            $y = Decharge::where('bp', $id)->get('montant')->sum('montant');

                            if ($y==$s) {

                                $dsa = '<span class="badge badge-success">Payé</span>';
                            }else{
                                $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formDecharge('.$id.')" data-toggle="modal" data-target="#dechargeModalForms"><span class="badge badge-info">Faire une autre Decharge</span></a>';
                            }

                        }else{
                            $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formDecharge('.$id.')" data-toggle="modal" data-target="#dechargeModalForms"><span class="badge badge-info">Faire une Decharge</span></a>';
                        }

                    }


                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                })->label('Action'),

            ];
        }else{
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$id.')" data-toggle="modal" data-target="#pBpModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),


                Column::callback(['bc','projet'], function ($id,$projet) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printIndex('.$id.','.$projet.')" data-toggle="modal" data-target="#listePaieModalForms">'.PayementAgent::where('id',$id)->get()[0]->reference.'</i></a>';
                    
                })->label('Justif')->searchable(),

                Column::callback(['beneficiaire'], function ($id) {
                    
                    return 'Compte Salaire';
                    
                })->label('Beneficiaire'),

                Column::callback('montant', function ($some) {
                    return '<span class="badge badge-danger">$ '.$some.'</span>';
                })->label('Montant'),
                
                Column::callback('type', function ($type) {

                    if($type == 1){
                        $t = 'Caisse';
                    }else if($type == 2){
                        $t = 'Chèque';
                    }else if($type == 3){
                        $t = 'Transfert bancaire';
                    }
                    return $t;
                })->label('Paiement'),

                Column::name('dateP')
                    ->label('Date'),

                Column::callback(['active','niv3','niv2'], function ($active,$niv3,$niv2) {

                    if ($active == true && $niv2 == true && $niv3 == true ) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                    })->label('Statut'),

                Column::callback(['id','type','active','niv3','niv2'], function ($id,$cat,$active,$niv3,$niv2) {

                    $dsa = '';

                    if ($active == true && $niv2 == true && $niv3 == true ) {

                        if ($cat == 3) {

                            if (Op::where("bp", $id)->exists()){

                                $dsa = '<span class="badge badge-success">OP Déjà fait</span>';

                            }else{
                                $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formOP('.$id.')" data-toggle="modal" data-target="#opModalForms"><span class="badge badge-info">Faire un OP</span></a>';
                            }
                        }

                        if ($cat == 2) {

                            if (Cheque::where("bp", $id)->exists()){

                                $dsa = '<span class="badge badge-success">Cheque Déjà fait</span>';

                            }else{
                                $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formCheque('.$id.')" data-toggle="modal" data-target="#chequeModalForms"><span class="badge badge-info">Faire un Cheque</span></a>';
                            }
                        }

                        if ($cat == 1) {

                            $dsa = '<span class="badge badge-success">Pret</span>';

                        }
                    }


                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                })->label('Action'),

            ];
        }


    }
}
