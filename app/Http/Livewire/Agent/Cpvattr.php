<?php

namespace App\Http\Livewire\Agent;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\DemAch;
use App\Models\PvAttr;
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
            // $exists = PvAttrCommissionSignatures::where('pv_attr', $pvId)->exists();

            // if (!$exists) {
            //     PvAttrCommissionSignatures::create([
            //         'pv_attr' => $pvId,
            //     ]);

            //     SignaturePVAttr::where('id', $signatureId)
            //         ->update(['status' => 'in_progress']);
            // }

            DB::commit();
            // Notify relevant parties
            // $this->notificationService->sendNotification([
            //     'agent' => getAdministratorUsers(),
            //     'msg_id' => 3,
            //     'task' => ''.$pvRef->reference,
            // ]);
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
        $pvInstance = PVAttr::query()
        ->leftJoin('pv_attr_commissioners_concents as pacc', 'pacc.pv_attr', '=', 'pv_attrs.id')
        ->leftJoin('users as u', 'u.agent', '=', 'pacc.agent')
        ->select([
            'pv_attrs.id',
            'pv_attrs.da',
            'pv_attrs.reference',
            'pv_attrs.created_at',
            'pv_attrs.updated_at',

            DB::raw("MAX(CASE WHEN u.role = 'D.O'  THEN pacc.is_approved END) AS do_is_approved"),
            DB::raw("MAX(CASE WHEN u.role = 'D.O'  THEN pacc.comment END)     AS do_comment"),

            DB::raw("MAX(CASE WHEN u.role = 'D.A.F' THEN pacc.is_approved END) AS daf_is_approved"),
            DB::raw("MAX(CASE WHEN u.role = 'D.A.F' THEN pacc.comment END)     AS daf_comment"),

            DB::raw("MAX(CASE WHEN u.role = 'D.P'  THEN pacc.is_approved END) AS dp_is_approved"),
            DB::raw("MAX(CASE WHEN u.role = 'D.P'  THEN pacc.comment END)     AS dp_comment"),
        ])
        ->groupBy(
            'pv_attrs.id',
            'pv_attrs.da',
            'pv_attrs.reference',
            'pv_attrs.created_at',
            'pv_attrs.updated_at'
        )
        ->orderByDesc('pv_attrs.id');

        return PVAttr::query()->fromSub($pvInstance, 'pv_attrs');

    }

    public function columns()
    {   
        $administrators = getAdministratorUsers(true);
        $columns =[
            Column::callback(['pv_attrs.reference','pv_attrs.id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvAttrModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['pv_attrs.da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.$da.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::callback(['do_is_approved','do_comment'],function($is_approved,$comment){
                logger()->info('DO Approval: ', ['is_approved' => $is_approved, 'comment' => $comment]);
                $text = empty($is_approved) && $is_approved !== 0 ? '-' : $is_approved;
                return '<span class="p-1 text-teal-600 hover:bg-teal-600 rounded">'.$text.'</span>';
            })->label('D.O')->unsortable()->searchable(false),

            Column::callback(['daf_is_approved','daf_comment'],function($is_approved,$comment){
                $text = empty($is_approved) && $is_approved !== 0 ? '-' : $is_approved;
                return '<span class="p-1 text-teal-600 hover:bg-teal-600 rounded">'.$text.'</span>';
            })->label('D.A.F')->unsortable()->searchable(false),

            Column::callback(['dp_is_approved','dp_comment'],function($is_approved,$comment){
                $text = empty($is_approved) && $is_approved !== 0 ? '-' : $is_approved;
                return '<span class="p-1 text-teal-600 hover:bg-teal-600 rounded">'.$text.'</span>';
            })->label('D.P')->unsortable()->searchable(false),
            
            Column::callback(['do_is_approved','daf_is_approved','dp_is_approved'], function ($do,$daf,$dp) {
                $status = '-';
                

                if ((empty($do) && $do !== 0) || (empty($daf) && $daf !== 0) || (empty($dp) && $dp !== 0)) {
                    return '<span class="p-1 text-teal-600 hover:bg-teal-600 rounded">'.$status.'</span>';
                }

                if(strtolower($do) === 'approved' && strtolower($daf) === 'approved' && strtolower($dp) === 'approved'){
                    $status = 'Approuvé';
                }elseif(strtolower($do) === 'rejected' || strtolower($daf) === 'rejected' || strtolower($dp) === 'rejected'){
                    $status = 'Rejeté';
                }else{
                    $status = 'En operation';
                }
                $statusColor = $status == 'Approuvé' ? 'success' : ($status == 'Rejeté' ? 'danger' : 'warning');

                return '<span class="badge badge-'.$statusColor.' p-1 text-teal-600 hover:bg-teal-600  rounded" >'.$status.'</span>';
            })->label('Status')->unsortable()->searchable(false)

        ];
        return $columns;
    }
}
