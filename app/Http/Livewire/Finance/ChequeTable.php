<?php

namespace App\Http\Livewire\Finance;

use App\Models\Bp;
use App\Models\Cheque;
use App\Models\Compte;
use App\Models\Fournisseur;
use App\Models\LivreCaisse;
use App\Models\Projet;
use App\Models\RCaisse;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use PhpParser\Node\Stmt\TryCatch;

class ChequeTable extends LivewireDatatable
{

    public $modelId;

    protected $listeners = [
        'chequeUpdated' => '$refresh'
    ];

    public function printBp($modelId){
        $this->modelId = $modelId;
        $this->emit('printBp',$this->modelId );
    }

    public function conf($modelId){
        $this->modelId = $modelId;

        DB::beginTransaction();
        try {

            Cheque::find($this->modelId)->update([
                'active' => 1,
            ]);

            $index = Cheque::firstWhere('id', $this->modelId)->get();
            $ref1 = 'LVC-'.$index[0]->rference;
            
            LivreCaisse::create([
                'reference' => $ref1,
                'signature' => Auth::user()->id,
                'projet' => $index[0]->projet,
                'index' => $this->modelId,
                'type' => 11,//Cheque//
                'entree' => $index[0]->montant,
                'libelle' => $index[0]->motif,
            ]);

            $sld = RCaisse::where('projet', $index[0]->projet )->orderBy('created_at', 'desc')->first()->solde;

            $solde = $sld + $index[0]->montant;

            $ref2 = 'RC-'.$index[0]->bp.''.rand(1000,9999);
            RCaisse::create([
                'reference' => $ref2,
                'projet' => $index[0]->projet,
                'solde' => $solde,
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
        
    }

    public function builder()
    { 
        return Cheque::query()->orderBy("id", "DESC");    
    }

    public function columns()
    {
        if(Auth::user()->role == 'CAISS'){

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::name('numero')
                    ->label('Numero'),

                Column::callback(['bp','id'], function ($bp,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$bp.')" data-toggle="modal" data-target="#pBpModalForms">'.Bp::where('id',$bp)->get()[0]->reference.'</a>';
                })->label('Reference BP'),

                Column::callback(['projet','id'], function ($projet,$id) {
                    return 'Projet '.Projet::where('id',$projet)->get()[0]->name;;
                })->label('Donneur'),

                Column::name('beneficiare')
                    ->label('Beneficiaire'),

                Column::callback(['montant'], function ($s) {
                    return '$ '.$s;
                })->label('Montant'),

                Column::callback(['id','active'], function ($id,$active) {

                    if ($active ==true) {

                        $dsa = '<span class="badge badge-success">Cheque encaissé</span>';

                    }else{
                        
                        $dsa = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="conf('.$id.')" data-toggle="modal" data-target=""><span class="badge badge-info">Confirmation</span></a>';
                    }


                        return '<div class="flex space-x-1 justify-around">'. $dsa .'</div>'; ;
                })->label('Action'),

            ];

        }else{

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['bp','id'], function ($bp,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printBp('.$bp.')" data-toggle="modal" data-target="#pBpModalForms">'.Bp::where('id',$bp)->get()[0]->reference.'</a>';
                })->label('Reference BP'),

                Column::callback(['projet','id'], function ($projet,$id) {
                    return 'Projet '.Projet::where('id',$projet)->get()[0]->name;;
                })->label('Donneur'),

                Column::name('beneficiare')
                    ->label('Beneficiaire'),

                Column::callback(['montant'], function ($s) {
                    return '$ '.$s;
                })->label('Montant'),

            ];
        }
    }
}
