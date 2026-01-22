<?php

namespace App\Http\Livewire\Agent;

use App\Models\DemAch;
use App\Models\PvCommissionersConcents;
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

    public function approveCommission($modelId){
        try {
            $commissioner = PvCommissionersConcents::where('id',$modelId);
            if($commissioner->exists()){
                $commissioner->update([
                    'is_approved' => 'approved',
                ]);
            }

        } catch (\Throwable $th) {
            throw $th;
            logger()->info('Error signing PV as commissioner: ', $th->getMessage());
        }
    }

    public function rejectCommission($modelId){
        // DB::beginTransaction();
        // try {
        //     $this->modelId = $modelId;
        //     signaturePv::find($this->modelId)->update([
        //         'active' => 1,
        //     ]);
        //     DB::commit();
        // } catch (\Throwable $th) {

        //     DB::rollBack();
        // }
        try {
            $commissioner = PvCommissionersConcents::where('id',$modelId);
            if($commissioner->exists()){
                $commissioner->update([
                    'is_approved' => 'rejected',
                ]);
            }

        } catch (\Throwable $th) {
            throw $th;
            logger()->info('Error signing PV as commissioner: ', $th->getMessage());
        }
    }

    public function builder()
    {
        // return signaturePv::join('pvs', 'pvs.id', '=', 'signature_pvs.pv')
        // ->where("signature_pvs.agent", Auth::user()->agent)
        // ->where("pvs.type", '!=', 1)
        // ->where("pvs.titre", '!=', 'Achat directe')
        // ->where("pvs.titre", '!=', 'Achat direct')
        // //->whereDate('pvs.created_at', '>=', '2025-08-01')
        // ->orderBy("pvs.id", "DESC");
        $AssignedPvs = PvCommissionersConcents::where('agent', Auth::user()->agent)->join('pvs', 'pvs.id', '=', 'pv_commissioners_concents.pv')->orderBy("pv_commissioners_concents.created_at", "DESC");
        return $AssignedPvs;

    }

    public function columns()
    {

        return [
            Column::callback(['pvs.reference','pvs.id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['pv_commissioners_concents.comment'], function ($comment) {
                return '<span class="text-wrap">'.$comment.'</span>';
            })->label('Commentaire'),

            Column::callback(['pv_commissioners_concents.created_at'], function ($created_at) {
                return '<span class="text-wrap">'.$created_at.'</span>';
            })->label('Date d\'entre'),

            Column::callback(['pv_commissioners_concents.is_approved','pv_commissioners_concents.id'], function ($is_approved,$id) {
                $StatusCellVal = '<span class="badge badge-warning">Disabled Status</span>';
                if (strtolower($is_approved) == 'en attente') {
                    // $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="signer('.$id.')" data-toggle="modal" ><span class="badge badge-info">Signer</span></a>';
                    $StatusCellVal = '
                    <div class="status-wrapper">
                        <button class="status-btn success" title="Approve" wire:click="approveCommission('.$id.')">✓</button>
                        <button class="status-btn error" title="Reject" wire:click="rejectCommission('.$id.')">✕</button>
                    </div>
                    ';
                }else{
                    if (strtolower($is_approved) == 'rejected') {
                        $StatusCellVal = '<span class="badge badge-danger">'.$is_approved.'</span>';
                    }else{
                        $StatusCellVal = '<span class="badge badge-success">'.$is_approved.'</span>';
                    }
                }

                return $StatusCellVal ;
            })->unsortable()->label('Status'),
        ];
    }
}
