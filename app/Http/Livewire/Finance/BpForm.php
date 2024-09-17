<?php

namespace App\Http\Livewire\Finance;

use App\Models\Agent;
use App\Models\DemAch;
use App\Models\Bc;
use App\Models\Bp;
use App\Models\Contrat;
use App\Models\Et_bes;
use App\Models\Fournisseur;
use App\Models\FournPrice;
use App\Models\ListePaie;
use App\Models\Nd;
use App\Models\NdOder;
use App\Models\PartContrat;
use App\Models\PayementAgent;
use App\Models\prixPv;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\PvAttr;
use App\Models\RCaisse;
use App\Models\StatutAgent;
use App\Models\Taux;
use App\Models\Tr;
use App\Models\TrOder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class BpForm extends Component
{
    public $modelId;

    public $products;
    public $das;
    public $some;
    public $bcs;
    public $ebs;
    public $pvs;
    public $pvAttr;
    public $odrs;
    public $prof;
    public $valid1;
    public $valid2;
    public $fournisseur;

    public $trs;
    public $odrs3;

    public $nds;
    public $paie;
    public $odrs4;

    public $index;
    public $projet;
    public $beneficiaire;
    public $categorie;

    public $i = 1;
    public $state = [];


    protected $listeners = [
        'formBP',
        'formBP3',
        'formBP4',
        'formBP5',
        'formBP6'
    ];

    public function formBP($modelId){
        $this->modelId = $modelId;

        $this->bcs = Bc::where("id", $this->modelId)->get();
        $this->das = DemAch::where("id", $this->bcs[0]->da)->get();
        $this->ebs = Et_bes::where("id", $this->das[0]->eb)->get();
        $this->odrs = ProductOder::where("etatBes", $this->ebs[0]->id)->get();


        if(Pv::where('da', $this->das[0]->id)->exists()){
            $x = $this->bcs[0]->proforma;

            $this->fournisseur = Proforma::find($x)->fournisseur;;
        }else{
            $x = DemAch::where('id', $this->das[0]->id)->get()[0]->eb;
            $x = Et_bes::where('id', $x)->get()[0]->id;
            $x = ProductOder::where('etatBes', $x)->get()[0]->description;
            $x = FournPrice::where('product', $x)->get()[0]->fournisseur;
            $this->fournisseur = Fournisseur::find($x)->id;
        }

        if(Pv::where("da", $this->bcs[0]->da)->exists()){
            $this->pvs = Pv::where("da", $this->bcs[0]->da)->get();

            $this->prof = Proforma::where("id", $this->bcs[0]->proforma)->where("da", $this->pvs[0]->da)->get();
            $this->pvAttr = PvAttr::where("da", $this->bcs[0]->da)->get();
            //$this->products = prixPv::where("pv", $this->pvs[0]->id)->where("proforma", $this->prof[0]->id)->orderBy("id", "DESC")->get();

            

            $this->some  = PrixPv::join('product_oders', 'prix_pvs.produit', '=', 'product_oders.description')
            ->join('select_pvs', 'prix_pvs.produit', '=', 'select_pvs.produit')
            ->selectRaw("prix_pvs.prix * product_oders.quantite as price")
            ->where("select_pvs.pv", $this->pvAttr[0]->id)
            ->where("select_pvs.proforma", $this->prof[0]->id)
            ->where("prix_pvs.pv", $this->pvs[0]->id)
            ->where("prix_pvs.proforma", $this->prof[0]->id)
            ->where("product_oders.etatBes", $this->ebs[0]->id)
            ->get('price')
            ->sum('price');
        }elseif (FournPrice::where("product", $this->odrs[0]->description)->exists()) {
            
            $this->prof = FournPrice::where("product", $this->odrs[0]->description)->get();

            $this->products = ProductOder::join('fourn_prices', 'fourn_prices.product', '=', 'product_oders.description')
                ->selectRaw("product_oders.description as produit,fourn_prices.prix as prix")
                ->where("fourn_prices.product", $this->odrs[0]->description)
                ->where("product_oders.etatBes", $this->ebs[0]->id)
                ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                ->get();


            $this->some  = FournPrice::join('product_oders', 'fourn_prices.product', '=', 'product_oders.description')
                ->selectRaw("fourn_prices.prix * product_oders.quantite as price")
                ->where("fourn_prices.product", $this->odrs[0]->description)
                ->where("product_oders.etatBes", $this->ebs[0]->id)
                ->whereDate('fourn_prices.debut','<=', $this->das[0]->created_at)->whereDate('fourn_prices.fin','>=', $this->das[0]->created_at)
                ->get('price')
                ->sum('price');

        }

        $this->index = $this->modelId;
        $this->beneficiaire = $this->fournisseur;
        $this->projet = $this->ebs[0]->projet;
        $this->categorie = 2;

    }


    //////////////////////////////////////////////////////////////////////
    //////////////// BON DE PAYEMENT TERME DE REFERENCE //////////////////////
    ////////////////////////////////////////////////////////////////////




    public function formBP3($modelId){
        $this->modelId = $modelId;

        $this->trs = Tr::where("id", $this->modelId)->get();
        $this->odrs3 = TrOder::where("tr", $this->modelId)->get();

        $this->index = $this->modelId;
        
        $this->beneficiaire = User::find($this->trs[0]->agent)->id;
        $this->projet = $this->trs[0]->projet;
        $this->categorie = 3;
        $this->some = TrOder::where('tr',$this->modelId)->selectRaw("prix * quantite * frequence as price")->get('price')
        ->sum('price');

    }


    //////////////////////////////////////////////////////////////////////
    //////////////// BON DE PAYEMENT NOTE DE DEBIT //////////////////////
    ////////////////////////////////////////////////////////////////////




    public function formBP4($modelId){
        $this->modelId = $modelId;

        $this->nds = Nd::where("id", $this->modelId)->get();
        $this->odrs4 = NdOder::where("nd", $this->modelId)->get();

        $this->index = $this->modelId;
        $this->beneficiaire = 3;
        $this->projet = $this->nds[0]->projet;
        $this->categorie = 4;
        $this->some = NdOder::where('nd',$this->modelId)->selectRaw("prix * quantite as price")->get('price')
        ->sum('price');

    }



    //////////////////////////////////////////////////////////////////////
    //////////////// BON DE PAYEMENT APPROVISIONNEMEMT CAISSE //////////////////////
    ////////////////////////////////////////////////////////////////////

    public function formBP5($modelId){
        $this->modelId = $modelId;

        $this->nds = RCaisse::where("projet", $this->modelId)->get();

        $this->index = $this->modelId;
        $this->beneficiaire = $this->index;
        $this->projet = $this->index;
        $this->categorie = 5;

    }




    //////////////////////////////////////////////////////////////////////
    //////////////// BON DE PAYEMENT PAYEMENT AGENT //////////////////////
    ////////////////////////////////////////////////////////////////////

    public function formBP6($modelId,$projet){
        $this->modelId = $modelId;

        $this->paie = PayementAgent::where("id", $this->modelId)->get();

        $this->index = $this->modelId;
        $this->beneficiaire = 1;
        $this->projet = $projet; 
        //Contrat::where("id", $this->modelId)->get(); 
        $this->categorie = 6;

        $agents = ListePaie::join('contrats', 'contrats.id', '=', 'liste_paies.contrat')
            ->where("liste_paies.pymt", $this->modelId)
            ->where('contrats.projet', $projet)
            ->orderBy("liste_paies.id", "DESC")->get();
        $ap = 0;
        foreach($agents as $prod){

            $taux = Taux::firstWhere('id', $this->paie[0]->taux)->taux;
            $sb = ((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130;
            $qpo = $sb*5/100;
            $tbi = (sprintf("%.2f", (((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)-((((100*$prod->SB)-(( ($prod->ne*455.62*$prod->jp)/$taux)+((10000*$prod->jp)/$taux))*100)/130)*5/100)));

            $qpp = $sb*13/100;
            $inpp = $sb*1/100;
            $onem = $sb*0.2/100;
            
             $cp = $sb*14.2/100;

             $tbi_fc = $tbi*$taux;
             $ind_t = (10000*$prod->jp)/$taux;
             $all_f = ($prod->ne*455.62*$prod->jp)/$taux;
             $av = $ind_t + $all_f;
             $ipr_max = ($tbi_fc*30/100)/$taux;
             $ipr_form = 0;
             $ipr_cal = 0;
             $ipr_ret = 0;
             
             if($tbi_fc<= 162000){
                $ipr_form = ($tbi_fc*3/100)/$taux;
             }
             if($tbi_fc > 162000 ){
                $i1 = 162000*3/100;
                $a = $tbi_fc-162000;

                if($a <= 1800000){
                    $i2 = $a*15/100;
                    $ipr_form = ($i1+$i2)/$taux;
                }

                if($a > 1800000 ){

                    
                    $b = $a-1638000;

                    if($b <= 3600000){

                        $i1 = 162000*3/100;
                        $i2 = 1638000*15/100;
                        $i3 = $b*30/100;

                        $ipr_form = ($i1+$i2+$i3)/$taux;
                    }

                    if($b > 3600000){

                        $c = $b-1800000;
                        $i1 = 162000*3/100;
                        $i2 = 1638000*15/100;
                        $i3 = 1800000*30/100;
                        $i4 = $c*40/100;

                        $ipr_form = ($i1+$i2+$i3+$i4)/$taux;
                    }

                    
                }
                
             }

             $et_civ = StatutAgent::firstWhere('id', $prod->sAgent)->etatcivil;

             if($et_civ == 'Marie(e)'){
                $pers_ch = $prod->ne+1;
             }else{
                $pers_ch = $prod->ne;
             }

             if($pers_ch > 9){
                $pers_ch = 9;
             }

             if($tbi_fc <= 1159000){
                $ipr_cal = $ipr_form - ($pers_ch*$ipr_form*2/100);
             }else{
                $ipr_cal = $ipr_form;
             }

             if($ipr_cal > $ipr_max){
                $ipr_ret = $ipr_max;
             }else{
                $ipr_ret = $ipr_cal;
             }
             $net_p = ($prod->SB-$ipr_ret-$qpo);
             $brut = $net_p + $cp +$qpo +$ipr_ret;

             

            if($projet == 3){
                $pourc = PartContrat::where('contrat', $prod->contrat)->where('projet',$projet)->get()[0]->pourcentage;
                $app = $brut*$pourc/100;
                $ap +=$app;
            }else{
                $ap +=$brut;
            }
        }
        $this->some = $ap;

    }









    public function submit()
    {
        

        if($this->categorie == 5){
            $validator = Validator::make($this->state, [
                'montantTL' => ['required', 'max:255'],
                'type' => ['required', 'max:255'],
                'date' => ['required', 'max:255'],
                'comment' => ['required', 'max:255'],
                'montant' => ['required', 'max:255'],
            ])->validate();
        }else{
            $validator = Validator::make($this->state, [
                'montantTL' => ['required', 'max:255'],
                'type' => ['required', 'max:255'],
                'date' => ['required', 'max:255'],
                'comment' => ['required', 'max:255'],
            ])->validate();
        }

        DB::beginTransaction();
        try {
            $ref = 'BP-'.$this->categorie.rand(100000,999999).'-FP'.$this->index.rand(100,999);
            if($this->projet == 1){
                $niv1 = true;
            }else{
                $niv1 = false;
            }

            if($this->categorie == 5){
                $montant = $this->state['montant'];

                Bp::create([
                    'reference' => $ref,
                    'signature' => Auth::user()->id,
                    'bc' => $this->index,
                    'type' => $this->state['type'],
                    'beneficiaire' => $this->beneficiaire,
                    'projet' => $this->projet,
                    'montant' => $montant,
                    'montantTL' => $this->state['montantTL'],
                    'categorie' => $this->categorie,
                    'dateP' => $this->state['date'],
                    'comment' => $this->state['comment'],
                    'niv1' => $niv1
                ]);
                
            }else{
                $montant = $this->some;

                Bp::create([
                    'reference' => $ref,
                    'signature' => Auth::user()->id,
                    'bc' => $this->index,
                    'type' => $this->state['type'],
                    'beneficiaire' => $this->beneficiaire,
                    'projet' => $this->projet,
                    'montant' => $montant,
                    'montantTL' => $this->state['montantTL'],
                    'categorie' => $this->categorie,
                    'dateP' => $this->state['date'],
                    'comment' => $this->state['comment'],
                    'niv1' => $niv1
                ]);
            }
            

            

            DB::commit();
            $this->reset('state');
            $this->modelId = null;
            $this->dispatchBrowserEvent('formSuccess');
            $this->emit('bcUpdated');
            $this->emit('rapportCUpdated');
            $this->emit('ndUpdated');
            $this->emit('paieAUpdated');
            $this->emit('trUpdated');
            $this->emit('bcUpdated');

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
    public function render()
    {
        return view('livewire.finance.bp-form');
    }
}
