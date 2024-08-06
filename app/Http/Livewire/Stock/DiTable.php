<?php

namespace App\Http\Livewire\Stock;

use App\Models\Et_bes;
use App\Models\Projet;
use App\Models\Affectation;
use App\Models\User;
use App\Models\DemAch;
use App\Models\Di;
use App\Models\ValidDi;
use App\Models\ValidEb;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class DiTable extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'diUpdated' => '$refresh'
    ];

    public function printDi($modelId){
        $this->modelId = $modelId;
        $this->emit('printDi',$this->modelId );
    }

    public function apprDi($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Di::find($this->modelId)->update([
                'niv1' => 1,
            ]);
            ValidDi::create([
                'user' => Auth::user()->id,
                'di' => $this->modelId,
                'resp' => true,
                'niv' => 1,
                'motif' => 'Tout es prevu',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }

    public function refDi($modelId){
        DB::beginTransaction();
        try {
            $this->modelId = $modelId;
            Di::find($this->modelId)->update([
                'active' => 0,
            ]);
            ValidDi::create([
                'user' => Auth::user()->id,
                'di' => $this->modelId,
                'resp' => false,
                'niv' => 1,
                'motif' => 'Nop a refaire',
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollBack();
        }
    }


    public function builder()
    {
        if (Auth::user()->role == 'C.P') {

            $dis = Di::join('affectations', 'affectations.projet', '=', 'dis.projet')
            ->where('affectations.agent', Auth::user()->agent)
            ->where('affectations.cath', '1');
            return $dis;
        }elseif (Auth::user()->role == 'MAG') {

            $dis = Di::query()
            ->where('niv1', true)
            ->where('active', true)
            ->orderBy("id", "DESC");
            return $dis;

        }else{
            return Di::query()->where("agent", Auth::user()->id)->orderBy("id", "DESC");
        }
    }



    public function columns()
    {
        if (Auth::user()->role == 'C.P') {


            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDi('.$id.')" data-toggle="modal" data-target="#pDiModalForms">'.$reference.'</a>';
                })->label('Reference')->searchable(),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->searchable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent')->searchable(),

                Column::callback(['active','niv1'], function ($active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),

                Column::callback(['id','active','niv1'], function ($id,$active,$niv1) {

                    if ($active == true && $niv1 == true) {

                        $edit = '';
                        $edit2 = '';
                    }elseif($active == false){
                        $edit = '';
                        $edit2 ='';
                    }else{
                        $edit = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="apprDi('.$id.')" data-toggle="modal" data-target=""><i class="icon-like txt-danger"></i></a>';

                        $edit2 = '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="refDi('.$id.')" data-toggle="modal" data-target=""><i class="icon-dislike txt-danger"></i></a>';
                    }

                        return '<div class="flex space-x-1 justify-around">'. $edit . $edit2 .'</div>'; ;
                })->unsortable(),
            ];
        }else {

            return [
                Column::callback(['reference','id'], function ($reference,$id) {
                    return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="printDi('.$id.')" data-toggle="modal" data-target="#pDiModalForms">'.$reference.'</a>';
                })->label('Reference')->searchable(),

                Column::callback(['projet'], function ($projet) {
                    return Projet::find($projet)->name.' ('.Projet::find($projet)->reference.'';
                })->label('Projet')->searchable(),

                Column::name('created_at')
                    ->label('Date'),

                Column::callback(['agent'], function ($agent) {
                    return User::find($agent)->name;
                })->label('Agent')->searchable(),

                Column::callback(['active','niv1'], function ($active,$niv1) {

                    if ($active == true && $niv1 == true) {
                        $delete = '<span class="badge badge-success">Approuvé</span>';
                    }elseif($active == false){
                        $delete = '<span class="badge badge-danger">Refusé</span>';
                    }else{
                        $delete = '<span class="badge badge-info">En attente</span>';
                    }
                        return $delete ;
                })->unsortable()->label('Etat'),
            ];
        }
    }


}
