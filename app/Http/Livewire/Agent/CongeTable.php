<?php

namespace App\Http\Livewire\Agent;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\ValidConge;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CongeTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'congeUpdated' => '$refresh'
    ];

    public function print($modelId){
        $this->modelId = $modelId;
        $this->emit('printConge',$this->modelId );
    }

    public function app1($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Conge::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidConge::create([
                'user' => Auth::user()->id,
                'signature' => Auth::user()->id,
                'conge' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function app2($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Conge::find($this->modelId)->update([
                'niv2' => 1,
            ]);
            ValidConge::create([
                'user' => Auth::user()->id,
                'signature' => Auth::user()->id,
                'conge' => $this->modelId,
                'resp' => true,
                'niv' => 2,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function ref($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Conge::find($this->modelId)->update([
                'active' => 0,
            ]);
            ValidConge::create([
                'user' => Auth::user()->id,
                'conge' => $this->modelId,
                'resp' => false,
                'niv' => 3,
                'motif' => 'Nop a refaire',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function builder()
    {
        if(Auth::user()->role == 'R.H'){
           return Conge::query()->where("niv1", true)->orderBy("id", "DESC");
        }else if (Agent::firstWhere('id', Auth::user()->agent)->fonction == 1) {
           return Conge::join('agents', 'agents.id', '=', 'conges.agent')
            ->where('agents.service', Agent::firstWhere('id', Auth::user()->agent)->service);
        }else if(Auth::user()->role == 'Sup'){
            return Conge::query()->orderBy("id", "DESC");
        }else{
            return Conge::query()->where("agent", Auth::user()->agent)->orderBy("id", "DESC");
        }
    }

    public function columns()
    {

        if(Auth::user()->role == 'R.H'){

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pCongeModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['agent'], function ($agent) {
                    return Agent::find($agent)->firstname.' '.Agent::find($agent)->lastname.' '.Agent::find($agent)->middlename;
                })->label('Agent'),

                Column::name('type')
                    ->label('Type de Conge'),

                Column::name('debut')
                    ->label('Date depart'),

                Column::name('fin')
                    ->label('Date retour'),

                BooleanColumn::name('niv1')
                    ->label('C. Service'),

                BooleanColumn::name('niv2')
                    ->label('RH'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->label('Etat'),
    
                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {
    
    
                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $edit = '<span class="badge badge-success">Ok</span>';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  data-toggle="modal" data-target=""  rounded" wire:click="app2('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="ref('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->label('BTN'),
            ];

        }else if(Agent::firstWhere('id', Auth::user()->agent)->fonction == 1){

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pCongeModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['agent'], function ($agent) {
                    return Agent::find($agent)->firstname.' '.Agent::find($agent)->lastname.' '.Agent::find($agent)->middlename;
                })->label('Agent'),

                Column::name('type')
                    ->label('Type de Conge'),

                Column::name('debut')
                    ->label('Date depart'),

                Column::name('fin')
                    ->label('Date retour'),

                BooleanColumn::name('niv1')
                    ->label('C. Service'),

                BooleanColumn::name('niv2')
                    ->label('RH'),

                Column::callback(['active','niv1','niv2'], function ($active,$niv1,$niv2) {

                    if ($active == true && $niv1 == true && $niv2 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->label('Etat'),
    
                Column::callback(['id','active','niv1','niv2'], function ($id,$active,$niv1,$niv2) {


                    if ($active == true && $niv1 == true ) {
                        $edit = '<span class="badge badge-success">Ok</span>';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  data-toggle="modal" data-target=""  rounded" wire:click="app1('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="ref('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->label('BTN'),
            ];

        }else{

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="print('.$id.')" data-toggle="modal" data-target="#pCongeModalForms">'.$reference.'</a>';
                })->label('Reference'),

                Column::callback(['agent'], function ($agent) {
                    return Agent::find($agent)->firstname.' '.Agent::find($agent)->lastname.' '.Agent::find($agent)->middlename;
                })->label('Agent'),

                Column::name('type')
                    ->label('Type de Conge'),

                Column::name('debut')
                    ->label('Date depart'),

                Column::name('fin')
                    ->label('Date retour'),

                BooleanColumn::name('niv1')
                    ->label('C. Service'),

                BooleanColumn::name('niv2')
                    ->label('RH'),

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
}
