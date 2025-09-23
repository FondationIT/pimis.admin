<?php

namespace App\Http\Livewire\Agent;

use App\Models\DemAch;
use App\Models\signaturePv;
use App\Models\SignaturePVAttr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Cpvattr extends LivewireDatatable
{
    public $modelId;

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPvAttr',$this->modelId );
    }

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function signer($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            SignaturePVAttr::find($this->modelId)->update([
                'active' => 1,
            ]);
            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function builder()
    {
        return SignaturePVAttr::join('pv_attrs', 'pv_attrs.id', '=', 'signature_p_v_attrs.pv')
        ->where("signature_p_v_attrs.agent", Auth::user()->agent)
        ->where("pv_attrs.type", '!=', 1)
        ->where("pv_attrs.titre", '!=', 'Achat directe')
        ->where("pv_attrs.titre", '!=', 'Achat direct')
        //->whereDate('pv_attrs.created_at', '>=', '2025-08-01')
        ->orderBy("pv_attrs.id", "DESC");

    }

    public function columns()
    {

        return [
            Column::callback(['pv_attrs.reference','pv_attrs.id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvAttrModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['pv_attrs.da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$da.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::name('pv_attrs.titre')
                ->label('Titre'),

            Column::name('pv_attrs.created_at')
                ->label('Date'),

            Column::callback(['signature_p_v_attrs.active','signature_p_v_attrs.id'], function ($active,$id) {

                if ($active == false) {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="signer('.$id.')" data-toggle="modal" ><span class="badge badge-info">Signer</span></a>';
                }else{
                    $delete = '<span class="badge badge-success">Deja</span>';
                }


                    return $delete ;
            })->unsortable(),
        ];
    }
}
