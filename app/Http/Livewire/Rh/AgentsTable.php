<?php

namespace App\Http\Livewire\Rh;

use Livewire\Component;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AgentsTable extends LivewireDatatable
{

    //public $model = Agent::class;
    public $modelId;

    protected $listeners = [
        'agentUpdated'=> '$refresh'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit($modelId){
        $this->modelId = $modelId;
        $this->emit('editAgent',$this->modelId );
    }
    public function vue($modelId){
        $this->modelId = $modelId;
        $this->emit('vueAgent',$this->modelId );
    }
    public function deleteAgent($modelId){
        $this->modelId = $modelId;
        Agent::find($this->modelId)->update([
            'active' => 0,
        ]);
    }

    public function restoreAgent($modelId){
        $this->modelId = $modelId;
        Agent::find($this->modelId)->update([
            'active' => 1,
        ]);
    }


    public function builder()
    {
        if (Auth::user()->role == 'R.H' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'S.E' || Auth::user()->role == 'Sup') {

            return Agent::query()->orderBy("id", "DESC");
        }else{
            if (Agent::firstWhere('id', Auth::user()->agent)->fonction == 1) {

                return Agent::query()->where('service', Agent::firstWhere('id', Auth::user()->agent)->service)->orderBy("id", "DESC");
            }
        }
    }


    public function columns()
    {
        if(Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup'){

            return [
                Column::callback(['firstname','lastname','middlename'], function ($f,$l,$m) {
                    return 
                    '<div class="media align-items-center">
                        <div class="d-flex media-img-wrap mr-15">
                            <div class="avatar avatar-xs">
                                <span class="avatar-text avatar-text-inv-pink rounded-circle"><span class="initial-wrap"><span>'.substr($f, 0, 1).substr($l, 0, 1).'</span></span>
                                </span>
                            </div>
                        </div>
                        <div class="media-body">
                            <span class="d-block text-dark text-capitalize text-truncate mw-150p">'.$f.' '.$l.' '.$m.'</span>
                        </div>
                    </div>';
                })->label('Name'),

                Column::name('matricule')
                    ->label('Matricule'),

                Column::name('phone')
                    ->label('Phone'),

                Column::name('email')
                    ->label('Email'),

                BooleanColumn::name('active')
                    ->label('State'),

                Column::callback(['id','active'], function ($id,$active) {

                    $aff = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="vue(' . $id . ')" data-toggle="modal" data-target="#aAgentModalForms"><i class="icon-eye"></i></a>';

                    $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="deleteAgent(' . $id . ')" text-red-700><i class="icon-trash"></i></a>';

                    $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600 rounded" wire:click="edit(' . $id . ')" data-toggle="modal" data-target="#nAgentModalForms"><i class="icon-pencil"></i></a>';

                    if ($active == false) {
                        $delete = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="restoreAgent(' . $id . ')"><i class="icon-action-undo"></i></a>';
                    }
                        return '<div class="flex space-x-1 justify-around">'.$aff .$edit . $delete .'</div>';
                })->unsortable(),
            ];

        }else{
           
            return [
                Column::callback(['firstname','lastname','middlename'], function ($f,$l,$m) {
                    return $f.' '.$l.' '.$m;
                })->label('Name'),

                Column::name('matricule')
                    ->label('Matricule'),


                Column::name('phone')
                    ->label('Phone'),
                
                Column::callback(['fonction'], function ($f) {
                        if($f==1){
                            return 'Responable de service';
                        }elseif($f==2){
                            return 'Agent senior';
                        }else{
                            return 'Agent';
                        }
                    })->label('Fonction'),


                BooleanColumn::name('active')
                    ->label('State'),
            ];
        }
    }
}
