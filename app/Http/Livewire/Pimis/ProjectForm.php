<?php

namespace App\Http\Livewire\Pimis;
use App\Models\Bailleur;
use App\Models\Projet;
use App\Models\RCaisse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class ProjectForm extends Component
{
    public $state = [];
    public $modelId;
    protected $listeners = [
        'projectForm',
        'editProject',
    ];


    public function projectForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editProject($modelId){
        $this->modelId = $modelId;

        $model = Projet::find($this->modelId);
        $this->state['name'] = $model->name;
        $this->state['dateD'] = $model->dateD;
        $this->state['dateF'] = $model->dateF;
        $this->state['contexte'] = $model->contex;
        $this->state['bailleur'] = $model->bailleur;
    }


    public function submit()
    {
        if ($this->modelId != null) {

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255'],
                'dateD' => ['required', 'date'],
                'bailleur' => ['required', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {


                Projet::find($this->modelId)->update([
                    'name' => $this->state['name'],
                    'dateD' => $this->state['dateD'],
                    'dateF' => $this->state['dateF'],
                    'contex' => $this->state['contexte'],
                    'bailleur' => $this->state['bailleur'],
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('projectUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            $validator = Validator::make($this->state, [
                'name' => ['required', 'max:255'],
                'dateD' => ['required', 'date'],
                'bailleur' => ['required', 'max:255'],
            ])->validate();

            DB::beginTransaction();
            try {

                $ref = 'PJ-'.substr($this->state['name'], 0, 1).''.rand(1000,9999);


                Projet::create([
                    'reference' => $ref,
                    'name' => $this->state['name'],
                    'dateD' => $this->state['dateD'],
                    'dateF' => $this->state['dateF'],
                    'contex' => $this->state['contexte'],
                    'bailleur' => $this->state['bailleur'],
                    'signature' => Auth::user()->id,
                ]);

                $pr = Projet::firstWhere('reference', $ref )->id;

                $ref2 = 'RC-'.substr($this->state['name'], 0, 1).''.rand(1000,9999);
                RCaisse::create([
                    'reference' => $ref2,
                    'projet' => $pr,
                ]);

                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('projectUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }
    public function render()
    {
        return view('livewire.pimis.project-form',[
            'bailleurs' => Bailleur::where("active", "1")->orderBy("id", "DESC")->get(),
        ]);
    }
}
