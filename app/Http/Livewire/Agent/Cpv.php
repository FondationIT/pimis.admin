<?php

namespace App\Http\Livewire\Agent;

use App\Models\DemAch;
use App\Models\signaturePv;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Cpv extends LivewireDatatable
{
    public $modelId;

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPv',$this->modelId );
    }

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function signer($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            signaturePv::find($this->modelId)->update([
                'active' => 1,
            ]);
            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function builder()
    {
        return signaturePv::join('pvs', 'pvs.id', '=', 'signature_pvs.pv')
        ->where("signature_pvs.agent", Auth::user()->agent)
        ->where("pvs.type", '!=', 1)
        ->where("pvs.titre", '!=', 'Achat directe')
        ->where("pvs.titre", '!=', 'Achat direct')
        //->whereDate('pvs.created_at', '>=', '2025-08-01')
        ->orderBy("pvs.id", "DESC");

    }

    public function columns()
    {

        return [
            Column::callback(['pvs.reference','pvs.id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['pvs.da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$da.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::name('pvs.titre')
                ->label('Titre'),

            Column::name('pvs.created_at')
                ->label('Date'),

            Column::callback(['signature_pvs.active','signature_pvs.id'], function ($active,$id) {

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
