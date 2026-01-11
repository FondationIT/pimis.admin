<?php

namespace App\Http\Livewire\Agent;

use App\Models\Et_bes;
use App\Models\Projet;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EbTable extends LivewireDatatable
{

    public $modelId, $ebData;
    public $eb, $data;

    protected $listeners = [
        'ebUpdated' => '$refresh',
        'filterEb',
        'resetFilterEb',
        'searchEB' => 'applySearch'
    ];

    public function applySearch($value)
    {
        $this->search = preg_replace('/\s+/', ' ', trim($value));
    }

    public function printEb($modelId){
        $this->modelId = $modelId;
        $this->emit('printEb',$this->modelId );
    }
    


    ///////////////////////////////////////////////////////////
    /////////////// FILTER DATA  /////////////////////////////
    ////////////////////////////////////////////////////////

    public function resetFilterEb(){
        $this->data = null;
    }

    public function filterEb($data){
        $this->data = $data;
    }

    public function filterBReq($data){
        $this->data = $data;
    }

    public function builder()
    {
        return $this->getBuilder();
    }

    public function getBuilder()
    {
        $query = is_null($this->data) 
            ? Et_bes::query()->where("agent", Auth::user()->id)
            : $this->filterData($this->data);

        // GLOBAL SEARCH
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('reference', 'LIKE', '%' . $this->search . '%');
            });
        }

        return $query->orderBy("id", "DESC");
    }

    // public function getBuilder(){
        
    //     return (is_null($this->data)) ? Et_bes::query()->where("agent", Auth::user()->id)->orderBy("id", "DESC") : $this->filterData($this->data);
    // }

    public function filterData($data){
        $query = Et_bes::query()->whereDate('created_at','>=',$data['debut'])->whereDate('created_at','<=',$data['fin']);
        $query = ($data['projet']== 0) ? $query : $query->where('projet', $data['projet']);

        return $this->statusData($data['status'], $query)->orderBy("id", "DESC");
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

    public function columns()
    {

        return [
            Column::callback(['reference','id'], function ($reference,$id) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printEb('.$id.')" data-toggle="modal" data-target="#pEtBesModalForms">'.$reference.'</a>';
            })->label('Reference')->searchable(),

            Column::callback(['projet'], function ($projet) {
                return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.')';
            })->label('Projet'),

            Column::name('created_at')
                ->label('Date'),

            BooleanColumn::name('niv1')
                ->label('Comptable'),

            BooleanColumn::name('niv2')
                ->label('Projet'),

            Column::callback(['active','niv1','niv2','id'], function ($active,$niv1,$niv2,$id) {
                $mod = '';
                if ($active != true || $niv1 != true) {
                    $mod = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="ref('.$id.')" data-toggle="modal" data-target=""><i class="icon-pencil txt-danger"></i></a>';
                }
                return $mod ;
            })->unsortable(),

            Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                if ($active == true && $niv1 == true && $niv2 == true) {
                    $delete = '<span class="badge badge-success">Approuvé</span>';
                }elseif($active == false){
                    $delete = '<span class="badge badge-danger">Refusé</span>';
                }else{
                    $delete = '<span class="badge badge-info">En attente</span>';
                }
                    return $delete ;
            })->unsortable(),
        ];
    }
}
