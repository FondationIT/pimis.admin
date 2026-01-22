<?php

namespace App\Http\Livewire\Stock;

use App\Models\Categorie;
use App\Models\Fournisseur;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class FournisseurForm extends Component
{
    public $state = [];
    public $modelId;
    protected $listeners = [
        'fournisseurForm',
        'editFournisseur',
    ];

    public function fournisseurForm(){
        $this->reset('state');
        $this->modelId = null;
    }

    public function editFournisseur($modelId){
        $this->modelId = $modelId;

        $model = Fournisseur::find($this->modelId);
        $this->state['name'] = $model->name;
        $this->state['categorie'] = $model->catProduct;
        $this->state['email'] = $model->email;
        $this->state['phone'] = $model->phone;
        $this->state['adress'] = $model->adresse;
        $this->state['secteur'] = $model->sacteur;
        $this->state['type'] = $model->type;
        $this->state['description'] = $model->description;
    }

    public function submit()
    {

        $validator = Validator::make($this->state, [
            'name' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:fournisseurs'],
            'phone' => ['required', 'string', 'max:255', 'unique:fournisseurs'],
            'secteur' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'adress' => ['required', 'string', 'max:255'],
        ])->validate();

        if ($this->modelId != null) {

            DB::beginTransaction();
            try {


                Fournisseur::find($this->modelId)->update([
                    'name' => $this->state['name'],
                    'catProduct' => $this->state['categorie'],
                    'adresse' => $this->state['adress'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'secteur' => $this->state['secteur'],
                    'type' => $this->state['type'],
                    'description' => $this->state['description'],
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('fournisseurUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }

        }else{

            DB::beginTransaction();
            try {

                $reference = 'FRN-'.substr($this->state['name'], 0, 1).''.$this->state['categorie'].''.Auth::user()->id.''.rand(100000,999999).''.substr($this->state['name'], 0, 2);
                $data_create = Fournisseur::create([
                    'reference' => $reference,
                    'name' => $this->state['name'],
                    'catProduct' => $this->state['categorie'],
                    'adresse' => $this->state['adress'],
                    'email' => $this->state['email'],
                    'phone' => $this->state['phone'],
                    'secteur' => $this->state['secteur'],
                    'type' => $this->state['type'],
                    'description' => $this->state['description'],
                    'signature' => Auth::user()->id,
                ]);
                DB::commit();
                $this->reset('state');
                $this->dispatchBrowserEvent('formSuccess');
                $this->emit('fournisseurUpdated');

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }

    }

    public function render()
    {
        $categories=Categorie::where("active", "1")->orderBy("id", "DESC")->get();
        return view('livewire.stock.fournisseur-form',['categories' => $categories]);
    }
}
