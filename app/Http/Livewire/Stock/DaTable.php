<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Bailleur;
use App\Models\Et_bes;
use App\Models\Projet;
use App\Models\DemAch;
use App\Models\ValidDa;
use App\Models\Fournisseur;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\Bc;
use App\Models\FournPrice;
use App\Models\ProductOder;
use App\Models\PvAttr;
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
    public $modelId,$data,$pv;

    protected $listeners = [
        'demAchUpdated' => '$refresh',
        'filterDa',
        'resetFilterDa'
    ];

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }

    public function formProforma($modelId){
        $this->modelId = $modelId;
        $this->emit('formProforma',$this->modelId );
        //$this->dispatchBrowserEvent('formProforma');
    }

    public function formPV($modelId){
        $this->modelId = $modelId;
        $this->emit('formPV',$this->modelId );
        //$this->dispatchBrowserEvent('formProforma');
    }

    public function formPVAttr($modelId){
        $this->modelId = $modelId;
        $this->emit('formPVAttr',$this->modelId );
        //$this->dispatchBrowserEvent('formProforma');
    }

    public function formBC($modelId){
        $this->modelId = $modelId;
        $this->emit('formBC',$this->modelId );
        //$this->dispatchBrowserEvent('formProforma');
    }

    public function editBC($modelId){
        $this->modelId = $modelId;
        $this->emit('editBC',$this->modelId );
        //$this->dispatchBrowserEvent('formProforma');
    }

    public function fApprDa($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;

            if(Et_bes::find(DemAch::find($this->modelId)->eb)->projet == 3 || Et_bes::find(DemAch::find($this->modelId)->eb)->projet == 70 || Et_bes::find(DemAch::find($this->modelId)->eb)->projet == 71){

                DemAch::find($this->modelId)->update([
                    'niv2' => 1,
                    'niv3' => 1,
                ]);
            }else{
                DemAch::find($this->modelId)->update([
                    'niv2' => 1,
                ]);
            }



           
            ValidDa::create([
                'user' => Auth::user()->id,
                'signature' => Auth::user()->id,
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
                'signature' => Auth::user()->id,
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
                'signature' => Auth::user()->id,
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
                'signature' => Auth::user()->id,
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

    public function restoreDa($modelId){
        $this->modelId = $modelId;
        DemAch::find($this->modelId)->update([
            'active' => 1,
        ]);
    }




    
    ///////////////////////////////////////////////////////////
    /////////////// FILTER DATA  /////////////////////////////
    ////////////////////////////////////////////////////////

    public function resetFilterDa(){
        $this->data = null;
    }

    public function filterDa($data){
        $this->data = $data;
    }

    public function builder()
    {
        return $this->getBuilder();
    }

    public function logicAlg(){
        if(Auth::user()->role == 'LOG2' || Auth::user()->role == 'Sup'){
            return DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb');
        }elseif(Auth::user()->role == 'LOG1'){
            return DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb');
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

            $das = DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
            ->where('dem_aches.niv1', true);
            return $das;
        }else if(Auth::user()->role == 'D.A.F'){
            return DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
            ->where('dem_aches.niv1', true)
            ->where('dem_aches.niv2', true)
            ->where('dem_aches.niv3', true)
            ->orderBy("dem_aches.id", "DESC");
        }else {
            return DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
            ->where('dem_aches.niv1', true)
            ->where('dem_aches.niv2', true)
            ->where('dem_aches.niv3', true)
            ->where('dem_aches.niv4', true)
            ->orderBy("dem_aches.id", "DESC");
        }
    }

    public function getBuilder(){
        return (is_null($this->data)) ? $this->logicAlg()->orderBy("dem_aches.id", "DESC") : $this->filterData($this->data);
    }

    public function filterData($data){
        
        $query = $this->logicAlg()->whereDate('dem_aches.created_at','>=',$data['debut'])->whereDate('dem_aches.created_at','<=',$data['fin']);
        $query = ($data['projet']== 0) ? $query : $query->where('et_bes.projet', $data['projet']);

        return $this->statusData($data['status'], $query)->orderBy("dem_aches.id", "DESC");
    }

    public function statusData($status, $query){
        if ($status == 1){
            $query = $query->active();
        }elseif($status == 2){
            $query = $query->enCours();
        }elseif($status == 3){
            $query = $query->inactive();
        }
        return $query;
    }


    //////////////////////////////////////////////////////////
    //////////////////////// DATA TABLE /////////////////////
    ////////////////////////////////////////////////////////

    public function columns()
    {
        if(Auth::user()->role == 'COMPT2'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('created_at')
                    ->label('Date'),

                BooleanColumn::name('dem_aches.niv2')
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

                Column::callback(['dem_aches.id','dem_aches.active','dem_aches.niv2'], function ($id,$active,$niv2) {

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
        }else if(Auth::user()->role == 'LOG2'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                BooleanColumn::name('dem_aches.niv1')
                    ->label('Logistique'),

                BooleanColumn::name('dem_aches.niv2')
                    ->label('Comptable'),

                BooleanColumn::name('dem_aches.niv3')
                    ->label('Chef Projet'),

                BooleanColumn::name('dem_aches.niv4')
                    ->label('D.A.F'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

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
        }else if(Auth::user()->role == 'LOG1'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                BooleanColumn::name('dem_aches.niv1')
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

                Column::callback(['dem_aches.id','dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($id,$active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {

                        $das = DemAch::join('et_bes', 'et_bes.id', '=', 'dem_aches.eb')
                        ->where("dem_aches.id", $id)->get();

                        $fournisseurs =Fournisseur::where("catProduct", $das[0]->categorie)->get();
                        $bb = json_encode( $fournisseurs);

                        $article =ProductOder::where("etatBes", $das[0]->eb)->get();

                        $ebs = Et_bes::where("id", $das[0]->eb)->get();
                        $projet = Projet::where("id", $ebs[0]->projet)->get();
                        $bailleur = Bailleur::where("id", $projet[0]->bailleur)->get();
                        

                        //$bb = '{"bad":'.$bb.'}';


                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" onClick="allFournPlus('.$id.')" wire:click="formProforma('.$id.')" data-toggle="modal" data-target="#proformaModalForms"><span class="badge badge-info">Suivant</span></a><input type="text"  id="allFournPlus'.$id.'" value=\'{"bad":'.$bb.'}\' class="form-control" hidden>';

                        $some  = ProductOder::join('prices', 'prices.product', '=', 'product_oders.description')
                        ->selectRaw("prices.prix * product_oders.quantite as price")
                        ->where('product_oders.etatBes', $das[0]->eb)
                        ->whereDate('prices.debut','<=', $das[0]->created_at)->whereDate('prices.fin','>=', $das[0]->created_at)
                        ->get('price')
                        ->sum('price');

                        
                            if (FournPrice::where("product", $article[0]->description)->where("fin",">=", now())->exists()) {
                                $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="formBC('.$id.')" data-toggle="modal" data-target="#bcModalForms"><span class="badge badge-secondary">Faire un BC</span></a>';
                            }else {
                                if (Proforma::where("da", $id)->exists()) {
                                    if($some <= $bailleur[0]->max1){

                                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" onClick="allFournPlus('.$id.')" wire:click="formPV('.$id.')" data-toggle="modal" data-target="#pvModalForms"><span class="badge badge-info">Cotation</span></a><input type="text"  id="allFournPlus'.$id.'" value=\'{"bad":'.$bb.'}\' class="form-control" hidden>';

                                    }else{
                                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" onClick="allFournPlus('.$id.')" wire:click="formPV('.$id.')" data-toggle="modal" data-target="#pvModalForms"><span class="badge badge-info">Analyse</span></a><input type="text"  id="allFournPlus'.$id.'" value=\'{"bad":'.$bb.'}\' class="form-control" hidden>';
                                    }

                                }

                                if (Pv::where("da", $id)->exists()) {
                                    $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" onClick="allFournPlus('.$id.')" wire:click="formPVAttr('.$id.')" data-toggle="modal" data-target="#pvAttrModalForms"><span class="badge badge-info">Attribution</span></a><input type="text"  id="allFournPlus'.$id.'" value=\'{"bad":'.$bb.'}\' class="form-control" hidden>';
                                }
                                
                                
                                if (PvAttr::where("da", $id )->exists()) {
                                    $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="editBC('.$id.')" data-toggle="modal" data-target="#bcEditModalForms"><span class="badge badge-info">Editer BC</span></a>';
                                }
                            }

                           // }
                            if (Bc::where("da", $id)->exists()) {
                                //$dsa = '<span class="badge badge-success">Fini</span>';
                            }
                            


                        $edit = '<div class="flex space-x-1 justify-around">'. $dsa .'</div>';
                        return $edit;
                    }else if ($active == true && $niv1 == true) {
                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit2 ='';
                        if($niv1== false || $niv2== false || $niv3== false || $niv1== false){
                            $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreDa(' . $id . ')"><i class="icon-action-undo txt-danger"></i></a>';
                        }else{
                            $edit = '';
                        }
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="lApprDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDa('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),

            ];
        }else if(Auth::user()->role == 'C.P'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                BooleanColumn::name('dem_aches.niv3')
                    ->label('Chef Projet'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['dem_aches.id','dem_aches.active','dem_aches.niv3'], function ($id,$active,$niv3) {

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
        }else if(Auth::user()->role == 'COMPT1'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                BooleanColumn::name('dem_aches.niv2')
                    ->label('Comptable'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['dem_aches.id','dem_aches.eb','dem_aches.active','dem_aches.niv2','dem_aches.created_at','dem_aches.niv4'], function ($id,$eb,$active,$niv2,$dt,$niv4) {

                    $some  = ProductOder::join('prices', 'prices.product', '=', 'product_oders.description')
                    ->selectRaw("prices.prix * product_oders.quantite as price")
                    ->where('product_oders.etatBes', $eb)
                    ->whereDate('prices.debut','<=', $dt)->whereDate('prices.fin','>=', $dt)
                    ->get('price')
                    ->sum('price');

                    if($some < 500){

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

                    }else{

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
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),

            ];
        }else if(Auth::user()->role == 'D.A.F'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

                    if ($active == true && $niv1 == true && $niv2 == true && $niv3 == true && $niv4 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En cours</span>';
                    }
                        return $delete ;
                })->unsortable(),

                Column::callback(['dem_aches.id','dem_aches.active','dem_aches.niv4'], function ($id,$active,$niv4) {

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

        else if(Auth::user()->role == 'S.E' || Auth::user()->role == 'Sup'){

            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

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
        }else{
            return [

                Column::callback(['dem_aches.reference','dem_aches.id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$id.')" data-toggle="modal" data-target="#pDaModalForms">'.$reference.'</a>';
                })->label('D.A Ref')->searchable(),

                Column::callback(['et_bes.reference'], function ($eb) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$eb.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$eb.'</a>';
                })->label('B.R Ref')->searchable(),

                Column::name('motif')
                    ->label('Motif'),

                Column::name('dem_aches.created_at')
                    ->label('Date'),

                Column::callback(['dem_aches.active','dem_aches.niv1','dem_aches.niv2','dem_aches.niv3','dem_aches.niv4'], function ($active,$niv1,$niv2,$niv3,$niv4) {

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
