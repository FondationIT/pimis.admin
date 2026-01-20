<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\SignaturePVAttr;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\Proforma;
use App\Models\PvAttr;
use App\Models\PvAttrCommissionersConcents;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;
use Templately\Core\Importer\Runners\Finalizer;

class PvAttrTable extends LivewireDatatable
{
    //public $model = PvAttr::class;
    public $modelId;
    public $search = '';

    protected $listeners = [
        'pvAttrUpdated' => '$refresh',
        'validateAttr' => 'validateAttr',
        'searchPVATTR' => 'applySearch'
    ];

    public function applySearch($value)
    {
        $this->search = preg_replace('/\s+/', ' ', trim($value));
        $this->resetPage();
    }

    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPvAttr',$this->modelId );
    }

    public function fetchUserNiv()
    {
        $role = Auth::user()->role;
        $roleMap = [
            'D.O'   => 'niv_1',
            'D.A.F' => 'niv_2',
            'D.P'   => 'niv_3',
        ];
        return $roleMap[$role] ?? null;
    }

    public function validateAttr($pvAttrRef, $action)
    {
        $pvAttr = PvAttr::where('reference', $pvAttrRef)->first();

        $niv = $this->fetchUserNiv();
        if (!$niv) {
            throw new \Exception('Unauthorized role');
        }
        $pvAttrCom = PvAttrCommissionersConcents::where('pv_attr', $pvAttr->id);
        $pvAttrCom->where('agent',Auth::user()->agent)->update([
            'is_approved' => 'approved'
        ]);

        // Finalize the signature and update PV Attr status when all levels are approved to proceed

        $is_complete =$pvAttrCom->where('is_approved','approved')->count() > 2;
        if($is_complete){
            DB::beginTransaction();
            try {
                SignaturePVAttr::where('pv', $pvAttr->id)->update([
                    'status' => 'approved',
                ]);
                DB::commit();
            } catch (\Throwable $th) {

                DB::rollBack();
            }
        }

        // update the user Notification
        $this->emit('notificationRead',$pvAttrRef );

//         correct


// $pvAttr = PvAttr::where('reference', $pvAttrRef)->first();
//         $action = $action == 'approve' ? 1 : 0;

//         $key = Auth::user()->role == 'D.O'?'niv_1':Auth::user()->role == 'D.A.F'?'niv_2':'niv_3';

//         PvAttrCommissionersConcents::where('pv_attr', $pvAttr->id)->update([
//             $key => $action
//         ]);


        // logger('Validate PV Attr', ['Id' =>,'Ref' => $pvAttrRef, 'Action' => $action]);
        $this->emitSelf('$refresh');
    }

    public function builder()
    {
        $query = PvAttr::query();
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('pv_attrs.reference', 'LIKE', '%' . $this->search . '%');
            });
        }

        $query->where("pv_attrs.type", '!=', 1)
        ->whereNotIn("pv_attrs.titre", ['Achat directe','Achat direct'])
        //->whereDate('pv_attrs.created_at', '>=', '2025-08-01')
        ->orderBy("pv_attrs.id", "DESC");

        return $query;

    }

    public function columns()
    {
        $columns = [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvAttrModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.DemAch::find($da)->id.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::name('titre')
                ->label('Titre'),

            
        ];

        if (in_array(Auth::user()->agent, getAdministratorUsers())) {
            $columns[] =
                Column::callback(['id','reference'], function ($id,$pvAttrRef) {
                    $niv = $this->fetchUserNiv();
                    $pvAttrComInstance = PvAttrCommissionersConcents::where('pv_attr', $id)->where('agent',Auth::user()->agent)->first();
                    if ($pvAttrComInstance) {
                        
                        $is_approved = strtolower(trim($pvAttrComInstance->is_approved));

                        if ($is_approved != 'approved' && $is_approved != 'rejected') {
                            return '
                                <div class="d-flex gap-4 align-items-center justify-content-center">
                                    <button
                                        class="btn btn-sm rounded-pill px-2 py-1 fw-semibold confirm-action"
                                        style="background-color:#076d22; color:#ffff"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal"
                                        data-action="approve"
                                        data-ref="'.$pvAttrRef.'"
                                        >
                                        ✔
                                    </button>

                                    <button
                                        class="btn btn-sm rounded-pill px-2 py-1 fw-semibold confirm-action"
                                        style="background-color:#730d09; color:#ffff;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal"
                                        data-action="rejet"
                                        data-ref="'.$pvAttrRef.'"
                                        >
                                        ✖
                                    </button>
                                </div>

                            ';
                        } 

                        if ($is_approved == 'approved') {
                            return '<span class="text-success fw-bold">Approuved</span>';
                        }
                        if ($is_approved == 'rejected') {
                            return '<span class="text-danger fw-bold">Rejeted</span>';
                        }
                    }
                    return '<span class="text-muted fw-bold">En operation</span>';
                })->label('Validation');
        }

        $columns[] = 
            Column::name('created_at')
                ->label('Date');
        $columns[] =
            BooleanColumn::name('active')
                ->label('State');

        return $columns;
    }
}
