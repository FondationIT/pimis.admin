<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Bp;
use App\Models\Fournisseur;
use App\Models\ValidBc;
use App\Models\Br;
use App\Models\BrOder;
use App\Models\Et_bes;
use App\Models\FournPrice;
use App\Models\prixPv;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\PvAttr;
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


    public $modelId;
    public $products;
    public $das;
    public $some;
    public $bcs;
    public $ebs;
    public $pvs;
    public $pvAttr;
    public $odrs;
    public $prof;

    protected $listeners = [
        'bcUpdated' => '$refresh'
    ];



    public function printBc($modelId){
        $this->modelId = $modelId;
        $this->emit('printBc',$this->modelId );
    }

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPv',$this->modelId );
    }

    public function printBr($modelId){
        $this->modelId = $modelId;
        $this->emit('printBr',$this->modelId );
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

    public function formBR($modelId){
        $this->modelId = $modelId;
        $this->emit('formBR',$this->modelId );
    }

    public function formBP($modelId){
        $this->modelId = $modelId;
        $this->emit('formBP',$this->modelId );
    }


    public function builder()
    {

        if (Auth::user()->role == 'S.E') {

            $das = Bc::query()
            ->where('niv1', true)
            ->orderBy("id", "DESC");
            return $das;

        }else if (Auth::user()->role == 'MAG' || Auth::user()->role == 'COMPT1' || Auth::user()->role == 'COMPT2') {

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
                })->label('Reference BC')->searchable(),

                Column::callback(['da','proforma'], function ($da,$prof) {
                    if(Pv::where('da', $da)->exists()){
                        //$x = Pv::where('da', $da)->get()[0]->fournisseur;
                        $x = Proforma::find($prof)->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }else{
                        $x = DemAch::where('id', $da)->get()[0]->eb;
                        $x = Et_bes::where('id', $x)->get()[0]->id;
                        $x = ProductOder::where('etatBes', $x)->get()[0]->description;
                        $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }
                    
                    return $x;
                })->label('Fournisseur')->searchable(),

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
                })->label('Reference BC')->searchable(),

                Column::callback(['da','proforma'], function ($da,$prof) {
                    if(Pv::where('da', $da)->exists()){
                        //$x = Pv::where('da', $da)->get()[0]->fournisseur;
                        $x = Proforma::find($prof)->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }else{
                        $x = DemAch::where('id', $da)->get()[0]->eb;
                        $x = Et_bes::where('id', $x)->get()[0]->id;
                        $x = ProductOder::where('etatBes', $x)->get()[0]->description;
                        $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }
                    
                    return $x;
                })->label('Fournisseur')->searchable(),

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
                })->label('Reference BC')->searchable(),

                Column::callback(['da','proforma'], function ($da,$prof) {
                    if(Pv::where('da', $da)->exists()){
                        //$x = Pv::where('da', $da)->get()[0]->fournisseur;
                        $x = Proforma::find($prof)->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }else{
                        $x = DemAch::where('id', $da)->get()[0]->eb;
                        $x = Et_bes::where('id', $x)->get()[0]->id;
                        $x = ProductOder::where('etatBes', $x)->get()[0]->description;
                        $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }
                    
                    return $x;
                })->label('Fournisseur')->searchable(),

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

                    if (Br::where("bc", $id)->exists()) {

                        $bc = Bc::where("id", $id)->get();
                        $da = DemAch::where("id", $bc[0]->da)->get();
                        $eb = Et_bes::where("id", $da[0]->eb)->get();
                        $pvs = Pv::where("da", $bc[0]->da)->get();
                        $pvAttr = PvAttr::where("da", $bc[0]->da)->get();

                        $prof = Proforma::where("id", $bc[0]->proforma)->where("da", $bc[0]->da)->get();
                                    
                       // $z = ProductOder::where('etatBes', $eb[0]->id)->get('quantite')->sum('quantite');

                        $x = prixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.description')
                        ->join('select_pvs', 'prix_pvs.produit', '=', 'select_pvs.produit')
                        ->selectRaw("product_oders.quantite as quantite")
                        ->where("select_pvs.pv", $pvAttr[0]->id)
                        ->where("select_pvs.proforma", $prof[0]->id)
                        ->where("prix_pvs.pv", $pvs[0]->id)
                        ->where("prix_pvs.proforma", $prof[0]->id)
                        ->where("product_oders.etatBes", $eb[0]->id)
                        ->get('quantite')->sum('quantite');

                        $y = BrOder::where('bc', $id)->get('quantite')->sum('quantite');

                        if ($x==$y) {
                            $dsa = '<span class="badge badge-success">Fini</span>';
                        }else{
                            $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBR('.$id.')" data-toggle="modal" data-target="#brModalForms"><span class="badge badge-info">Suite</span></a>';
                        }


                    }else{
                        
                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBR('.$id.')" data-toggle="modal" data-target="#brModalForms"><span class="badge badge-info">Commencer</span></a>';
                    }


                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>'; ;
                })->label('Reception'),
            ];
        }else if(Auth::user()->role == 'COMPT1' || Auth::user()->role == 'COMPT2'){
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),

                Column::callback(['da','proforma'], function ($da,$prof) {
                    if(Pv::where('da', $da)->exists()){
                        //$x = Pv::where('da', $da)->get()[0]->fournisseur;
                        $x = Proforma::find($prof)->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }else{
                        $x = DemAch::where('id', $da)->get()[0]->eb;
                        $x = Et_bes::where('id', $x)->get()[0]->id;
                        $x = ProductOder::where('etatBes', $x)->get()[0]->description;
                        $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }
                    
                    return $x;
                })->label('Fournisseur')->searchable(),

                Column::name('lieu')
                    ->label('Lieu de livraison'),

                Column::callback(['active','id'], function ($active,$id) {

                    $br = Br::where('bc',$id)->get();

                    $n = '<ul>';
                    foreach ($br as $br) {
                        
                      $n .= '<li><a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBr('.$br->id.')" data-toggle="modal" data-target="#pBrModalForms">'.$br->reference.'</a></li>';  
                    }
                    
                    return $n ;
                    
                        
                    })->label('Bons de reception'),


                Column::callback(['id'], function ($id) {

                    $dsa = '';

                    if (Br::where("bc", $id)->exists()) {

                        $bc = Bc::where("id", $id)->get();
                        $da = DemAch::where("id", $bc[0]->da)->get();
                        $eb = Et_bes::where("id", $da[0]->eb)->get();
                        $pvs = Pv::where("da", $bc[0]->da)->get();
                        $pvAttr = PvAttr::where("da", $bc[0]->da)->get();

                        $prof = Proforma::where("id", $bc[0]->proforma)->where("da", $bc[0]->da)->get();
                                    
                       // $z = ProductOder::where('etatBes', $eb[0]->id)->get('quantite')->sum('quantite');

                        $x = prixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.description')
                        ->join('select_pvs', 'prix_pvs.produit', '=', 'select_pvs.produit')
                        ->selectRaw("product_oders.quantite as quantite")
                        ->where("select_pvs.pv", $pvAttr[0]->id)
                        ->where("select_pvs.proforma", $prof[0]->id)
                        ->where("prix_pvs.pv", $pvs[0]->id)
                        ->where("prix_pvs.proforma", $prof[0]->id)
                        ->where("product_oders.etatBes", $eb[0]->id)
                        ->get('quantite')->sum('quantite');
                        $y = BrOder::where('bc', $id)->get('quantite')->sum('quantite');

                        if ($x==$y) {

                            if (Bp::where("bc", $id)->where('categorie',2)->exists()){

                                $dsa = '<span class="badge badge-success">BP Déjà fait</span>';

                            }else{
                                $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="formBP('.$id.')" data-toggle="modal" data-target="#bpModalForms"><span class="badge badge-info">Faire un BP</span></a>';
                            }
                        }


                    }


                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>'; ;
                })->label('Action'),
            ];
        }else{
            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBc('.$id.')" data-toggle="modal" data-target="#pBcModalForms">'.$reference.'</a>';
                })->label('Reference BC')->searchable(),

                Column::callback(['da','proforma'], function ($da,$prof) {
                    if(Pv::where('da', $da)->exists()){
                        //$x = Pv::where('da', $da)->get()[0]->fournisseur;
                        $x = Proforma::find($prof)->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }else{
                        $x = DemAch::where('id', $da)->get()[0]->eb;
                        $x = Et_bes::where('id', $x)->get()[0]->id;
                        $x = ProductOder::where('etatBes', $x)->get()[0]->description;
                        $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
                        $x = Fournisseur::find($x)->name;
                    }
                    
                    return $x;
                })->label('Fournisseur')->searchable(),

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
