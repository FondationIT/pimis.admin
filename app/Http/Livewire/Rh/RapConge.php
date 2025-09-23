<?php

namespace App\Http\Livewire\Rh;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\ValidConge;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RapConge extends LivewireDatatable
{
    public $modelId;

    protected $listeners = [
        'rapCongeUpdated' => '$refresh'
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
        if (Auth::user()->role == 'R.H' || Auth::user()->role == 'D.A.F' || Auth::user()->role == 'S.E' || Auth::user()->role == 'ADMIN' || Auth::user()->role == 'Sup') {

            return Agent::query()->where('id','!=',3394);
        }
    }

    public function columns()
    {

        return [


            Column::callback(['firstname','lastname','middlename'], function ($x,$y,$z) {
                return $x.' '.$y.' '.$z;
            })->label('Agent')->searchable(),

            Column::callback(['firstname','id'],function ($x,$y) {
                $startDate = Carbon::createFromFormat('Y-m-d', '2025-01-01')->startOfDay();

                $nb = Conge::selectRaw("dure as a")
                ->where("agent", $y)
                ->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '<', $startDate)->get('a')->sum('a');

                return 0 .' jours';
            })->label('Jours cummules'),
            Column::callback('firstname',function () {
                return '25 jours';
            })->label('Jours prevus'),
            Column::callback(['lastname','id'],function ($x,$y) {
                $startDate = Carbon::createFromFormat('Y-m-d', '2025-01-01')->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', '2025-12-31')->endOfDay();

                $nb = Conge::selectRaw("dure as a")
                ->where("agent", $y)->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)->get('a')->sum('a');

                return $nb.' jours';

            })->label('Jours accordes'),

            Column::callback(['middlename','id'],function ($x,$y) {
                $startDate = Carbon::createFromFormat('Y-m-d', '2025-01-01')->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', '2025-12-31')->endOfDay();

                $nb1 = Conge::selectRaw("dure as a")
                ->where("agent", $y)->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)->get('a')->sum('a');

                 $nb2 = Conge::selectRaw("dure as a")
                ->where("agent", $y)
                ->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '<', $startDate)->get('a')->sum('a');

                return 25-$nb1.' jours';

            })->label('solde'),

            Column::callback(['active','id'], function ($active,$y) {

                $startDate = Carbon::createFromFormat('Y-m-d', '2025-01-01')->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', '2025-12-31')->endOfDay();

                $nb1 = Conge::selectRaw("dure as a")
                ->where("agent", $y)->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)->get('a')->sum('a');

                 $nb2 = Conge::selectRaw("dure as a")
                ->where("agent", $y)
                ->where("type", 1)
                ->where("niv2", true)
                ->whereDate('created_at', '<', $startDate)->get('a')->sum('a');

                $b = 25-$nb1;

                if ($b > 0) {
                    $delete = '<span class="badge badge-success">Valide</span>';
                }else {
                    $delete = '<span class="badge badge-danger">Epuiser</span>';
                }
                    return $delete ;
            })->label('Etat'),

            Column::callback(['id','active'], function ($id,$f) {
                return '<a href="#" class="p-1 text-teal-600 hover:bg-teal-600  rounded" wire:click="ref('.$id.')" data-toggle="modal" data-target="">Voir plus</a>';
            })->label('BTN'),
        ];


    }
}
