<?php

namespace App\Http\Livewire\Stock;

use App\Models\Article;
use App\Models\Pv;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Fournisseur;
use App\Models\ValidBc;
use App\Models\Br;
use App\Models\BrOder;
use App\Models\DiOder;
use App\Models\Projet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\DB;

class InventaireTable extends LivewireDatatable
{
    public $model = Article::class;
    public $modelId;
    protected $listeners = [
        'invUpdated' => '$refresh'
    ];

    public function columns()
    {

        return [
           
            Column::callback(['id','marque','model','description'], function ($id,$marque,$model,$description) {
                return $marque.' '.$model.' '.$description;
            })->label('Article')->searchable(),

            Column::callback(['id','unite'], function ($id,$unite) {

                return BrOder::where('produit', $id)->get('quantite')->sum('quantite').' '.$unite;

            })->label('Entrees'),

            Column::callback(['id','model','unite'], function ($id,$model,$unite) {

                return DiOder::where('product', $id)->get('quantite')->sum('quantite').' '.$unite;

            })->label('Sorties'),

            Column::callback(['id','marque','unite'], function ($id,$marque,$unite) {

                $ent = BrOder::where('produit', $id)->get('quantite')->sum('quantite');
                $sort = DiOder::where('product', $id)->get('quantite')->sum('quantite');
                $solde = $ent-$sort;

                if($solde > 0){
                    return '<span class="badge badge-success">'.$solde.' '.$unite.'</span>';
                }else{

                    return '<span class="badge badge-danger">'.$solde.' '.$unite.'</span>';
                }
                

            })->label('Solde'),

            
        ];
    }
}
