<?php

namespace App\Http\Livewire\Agent;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\DemAch;
use App\Models\PvAttr;
use App\Models\PvAttrCommissionSignatures;
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
use App\Services\NotificationService;
class Cpvattr extends LivewireDatatable
{
    public $modelId;
    protected NotificationService $notificationService;
    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPvAttr',$this->modelId );
    }

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }
    public function boot(NotificationService $notificationService){
        $this->notificationService = $notificationService;
    }
    public function signer($signatureId, $pvId){
        $allusers = User::all();
        foreach($allusers as $user){
            $role = Role::where('title',$user->role)->value('id');
            // User::where('id', $user->id)->update(['role' => ]);
            if($role != null){
                UserRole::Create([
                    'user' => $user->id,
                    'role' => $role
                ]);
            }
        }

        DB::beginTransaction();
        $pvRef = PvAttr::where('id', $pvId)->first();

        try {
            $exists = PvAttrCommissionSignatures::where('pv_attr', $pvId)->exists();

            if (!$exists) {
                PvAttrCommissionSignatures::create([
                    'pv_attr' => $pvId,
                ]);

                SignaturePVAttr::where('id', $signatureId)
                    ->update(['status' => 'in_progress']);
            }

            DB::commit();
            // Notify relevant parties
            $this->notificationService->sendNotification([
                'agent' => getAdministratorUsers(),
                'msg_id' => 3,
                'task' => ''.$pvRef->reference,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // DB::beginTransaction();
        // try {
        //     $this->modelId = $modelId;
        //     SignaturePVAttr::find($this->modelId)->update([
        //         'active' => 1,
        //     ]);
        //     DB::commit();
        // } catch (\Throwable $th) {

        //     DB::rollBack();
        // }
        // logger()->info('Signer PV Attr ID: '.$modelId);
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
        $columns =[
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

        ];

        $columns[] = Column::callback(['signature_p_v_attrs.status','signature_p_v_attrs.id', 'pv_attrs.id'], function ($status,$id, $pvId) {
            $badgeClass = match ($status) {
                'in_progress' => 'info',
                'approved' => 'success',
                'rejected' => 'danger',
                default    => 'warning',
            };

            $statusConverter = [
                'pending' => 'En opération',
                'in_progress' => 'En attente',
                'approved' => 'Approuvé',
                'rejected' => 'Rejeté',
            ];
            if(in_array(Auth::user()->role, ['LOG1', 'ADMIN'])) {
                if ($status == 'pending') {
                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded"  wire:click="signer('.$id.','.$pvId.')" data-toggle="modal" >
                    <span class="badge badge-warning">Procéder</span>
                    </a>';
                }else{
                    $delete = "<span class=\"badge badge-{$badgeClass}\">" . $statusConverter[strtolower($status)] . "</span>";
                }
            }else{
                $delete = '<span class="badge badge-light">'.$statusConverter[strtolower($status)].'</span>';
            }
                return $delete ;
        })->unsortable()->label('Statut');
        

        return $columns;
    }
}
