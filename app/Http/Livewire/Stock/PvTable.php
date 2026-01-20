<?php

namespace App\Http\Livewire\Stock;

use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\Proforma;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class PvTable extends LivewireDatatable
{
    public $model = Pv::class;
    public $modelId;

    protected $listeners = [
        'pvUpdated' => '$refresh',
        'searchEB' => 'applySearch'
    ];

    public function applySearch($value)
    {
        $this->search = preg_replace('/\s+/', ' ', trim($value));
    }

    // public function builder()
    // {
    //     $query = Pv::query();

    //     // Global search
    //     if (!empty($this->search)) {
    //         $searchTerm = '%' . $this->search . '%';
    //         $query->where('reference', 'LIKE', $searchTerm);
    //     }

    //     return $query;
    // }


    public function printDa($modelId){
        $this->modelId = $modelId;
        $this->emit('printDa',$this->modelId );
    }

    public function printPv($modelId){
        $this->modelId = $modelId;
        $this->emit('printPv',$this->modelId );
    }

    public function columns()
    {

        $columns = [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printPv('.$id.')" data-toggle="modal" data-target="#pPvModalForms">'.$reference.'</a>';
            })->label('Reference PV')->searchable(),

            Column::callback(['da'], function ($da) {

                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDa('.DemAch::find($da)->id.')" data-toggle="modal" data-target="#pDaModalForms">'.DemAch::find($da)->reference.'</a>';
            })->label('Reference DA'),

            Column::name('titre')
                ->label('Titre'),

            Column::name('created_at')
                ->label('Date')
        ];


        // if (in_array(Auth::user()->agent, getAdministratorUsers())) {
            // $columns[] =
            //     Column::callback(['id','reference'], function ($id,$pvRef) {
            //         $pvAttrComNivInstance = PvCommissionSignatures::where('pv', $id);
            //         if ($pvAttrComNivInstance->exists()) {
            //             return '
            //                 <div class="d-flex gap-4 align-items-center justify-content-center">
            //                     <button
            //                         class="btn btn-sm rounded-pill px-2 py-1 fw-semibold confirm-action"
            //                         style="background-color:#076d22; color:#ffff"
            //                         data-bs-toggle="modal"
            //                         data-bs-target="#confirmModal"
            //                         data-action="approve"
            //                         data-ref="'.$pvRef.'"
            //                         >
            //                         ✔
            //                     </button>

            //                     <button
            //                         class="btn btn-sm rounded-pill px-2 py-1 fw-semibold confirm-action"
            //                         style="background-color:#730d09; color:#ffff;"
            //                         data-bs-toggle="modal"
            //                         data-bs-target="#confirmModal"
            //                         data-action="rejet"
            //                         data-ref="'.$pvRef.'"
            //                         >
            //                         ✖
            //                     </button>
            //                 </div>';
            //         }
            //         return '<span class="text-muted fw-bold">En operation</span>';
            //     })->label('Validation');
        // }

        $columns[] = 
            BooleanColumn::name('active')
                ->label('State');

        return $columns;
    }
}
