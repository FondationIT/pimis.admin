<?php

namespace App\Http\Controllers;

use App\Models\AgentMission;
use App\Models\Br;
use App\Models\BrOder;
use App\Models\Contrat;
use App\Models\Di;
use App\Models\DiOder;
use App\Models\Et_bes;
use App\Models\ListePaie;
use App\Models\Mission;
use App\Models\Nd;
use App\Models\NdOder;
use App\Models\PartContrat;
use App\Models\PayementAgent;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\prixPv;
use App\Models\PvAttr;
use App\Models\SelectPv;
use App\Models\signaturePv;
use App\Models\SignaturePVAttr;
use App\Models\StatutAgent;
use App\Models\Stock;
use App\Models\Tr;
use App\Models\TrOder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EtatBesoinController extends Controller
{
    public $dat;

    public function create(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'EB-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
        Et_bes::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
            'categorie' => $data['categorie'],
            'comment' => $data['comment'],
        ]);
        $etB = Et_bes::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref1 = 'CMD-'.$ref.$count;
            ProductOder::create([
                'reference' => $ref1,
                'product' => $data['product'][$count],
                'etatBes' => $etB,
                'quantite' => $data['quantite'][$count],
                'description' => $data['description'][$count],
            ]);
         }

        DB::commit();

        return true;

    }

    public function approuve(Request $data)
    {
       
        try {
            
            if($data['type'] == 1){
                ProductOder::find($data['id'])->update([
                    'ligne' => $data['ligne'],
                ]);
            }else{
                TrOder::find($data['id'])->update([
                    'ligne' => $data['ligne'],
                ]);
            }

            return true;
        } catch (\Throwable $th) {

            return false;
        }

    }

    public function proforma(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['fournisseur']); $count++)
         {
            
            $ref = 'PROF-'.$this->dat.'-FP'.rand(100,999).$data['da'].$data['fournisseur'][$count].Auth::user()->id;
            //$file = $data->file('reference');
            //echo $file;
            //$file_name = $file->store('doc/proformas','public');
            //$file_name = $data['fournisseur'][$count];
            //$new_name = rand() . '.' . $file_name->getClientOriginalExtension();
            //$file_name->move(public_path('final_doc'), $new_name);
            Proforma::create([
                'reference' => $ref,
                'da' => $data['da'],
                'signature' => Auth::user()->id,
                'fournisseur' => $data['fournisseur'][$count],
                'numero' => $data['fournisseur'][$count],
            ]);
         }

        DB::commit();

        return true;

    }

    public function pv(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        $ref = 'PV-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
        Pv::create([
            'reference' => $ref,
            'da' => $data['daPv'],
            'titre' => $data['titrePv'],
            'dateC' => $data['datePv'],
            'observation' => $data['obsPv'],
            'signature' => Auth::user()->id,

        ]);

        $pv = Pv::firstWhere('reference', $ref )->id;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['agPv']); $count++)
         {
            $ref1 = 'AGPV-'.$ref.$count;
            signaturePv::create([
                'reference' => $ref1,
                'pv' => $pv,
                'agent' => $data['agPv'][$count],
            ]);
         }


         for($count = 0; $count<count($data['prixPv']); $count++)
         {
            $ref2 = 'PRPV-'.$ref.$count;
            prixPv::create([
                'reference' => $ref2,
                'pv' => $pv,
                'signature' => Auth::user()->id,
                'produit' => $data['prodPv'][$count],
                'proforma' => $data['profPv'][$count],
                'prix' => $data['prixPv'][$count],
            ]);
         }

        DB::commit();

        return true;

    }


    public function pvAttr(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        $ref = 'PV-ATTR-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
        PvAttr::create([
            'reference' => $ref,
            'da' => $data['daPv'],
            'titre' => $data['titrePv'],
            'justification' => $data['justPv'],
            'observation' => $data['obsPv'],
            'signature' => Auth::user()->id,

        ]);

        $pv = PvAttr::firstWhere('reference', $ref )->id;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['agPv']); $count++)
         {
            $ref1 = 'AGPV-ATTR-'.$ref.$count;
            SignaturePVAttr::create([
                'reference' => $ref1,
                'pv' => $pv,
                'agent' => $data['agPv'][$count],
            ]);
         }


         for($count = 0; $count<count($data['prodPv']); $count++)
         {
            $ref2 = 'PRPV-ATTR-'.$ref.$count;
            SelectPv::create([
                'reference' => $ref2,
                'pv' => $pv,
                'signature' => Auth::user()->id,
                'produit' => $data['prodPv'][$count],
                'proforma' => $data['fournPv'][$count],
            ]);
         }

        DB::commit();

        return true;

    }




    public function br(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        $ref = 'BR-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
        Br::create([
            'reference' => $ref,
            'bc' => $data['bc'],
            'projet' => $data['projet'],
            'fournisseur' => $data['fournisseur'],
            'personne' => $data['personne'],
            'lieu' => $data['lieu'],
            'bordereau' => $data['bordereau'],
            'etat' => $data['etat'],
            'comment' => $data['comment'],
            'signature' => Auth::user()->id,

        ]);

        $br = Br::firstWhere('reference', $ref )->id;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['prod']); $count++)
         {
            $ref1 = 'ODR-BR-'.$ref.$count;
            BrOder::create([
                'reference' => $ref1,
                'br' => $br,
                'bc' => $data['bc'],
                'produit' => $data['prod'][$count],
                'quantite' => $data['qte'][$count],
                'observation' => $data['observation'][$count],
            ]);

            if(Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])->exists()){

                $qte = Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])->get()[0]->quantite;
                
                Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])
                ->update([
                    'quantite' => $data['qte'][$count] + $qte,
                ]);

            }else{
                $ref1 = 'ST-ART-'.$this->dat.'-FP'.rand(100,999).$data['projet'].$data['prod'][$count].Auth::user()->id;
                Stock::create([
                    'reference' => $ref1,
                    'project' => $data['projet'],
                    'product' => $data['prod'][$count],
                    'quantite' => $data['qte'][$count],
                ]);
            }
         }

        DB::commit();

        return true;

    }

    public function di(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'DI-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
        Di::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
        ]);
        $di = Di::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref1 = 'DI-ODR-'.$ref.$count;
            DiOder::create([
                'reference' => $ref1,
                'product' => $data['product'][$count],
                'di' => $di,
                'quantite' => $data['quantite'][$count],
            ]);

            if(Stock::where('project', $data['projet'],)->where('product', $data['product'][$count])->exists()){

                $qte = Stock::where('project', $data['projet'],)->where('product', $data['product'][$count])->get()[0]->quantite;
                
                Stock::where('project', $data['projet'],)->where('product', $data['product'][$count])
                ->update([
                    'quantite' => $qte - $data['quantite'][$count],
                ]);

            }
         }

        DB::commit();

        return true;

    }



    public function nd(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'ND-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
        Nd::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
        ]);
        $nd = Nd::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref1 = 'ND-ODR-'.$ref.$count;
            NdOder::create([
                'reference' => $ref1,
                'libelle' => $data['product'][$count],
                'nd' => $nd,
                'unite' => $data['unite'][$count],
                'prix' => $data['prix'][$count],
                'quantite' => $data['quantite'][$count],
            ]);

         }

        DB::commit();

        return true;

    }


    public function tr(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'TR-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
        Tr::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
            'type' => $data['type'],
            'titre' => $data['titre'],
        ]);
        $tr = Tr::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref1 = 'TR-ODR-'.$ref.$count;
            TrOder::create([
                'reference' => $ref1,
                'libelle' => $data['product'][$count],
                'tr' => $tr,
                'unite' => $data['unite'][$count],
                'prix' => $data['prix'][$count],
                'quantite' => $data['quantite'][$count],
                'frequence' => $data['frequence'][$count],
            ]);

         }

        DB::commit();

        return true;

    }



    public function miss(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        $ref = 'MS-'.$this->dat.'-FP'.rand(100,999).$data['trMs'].Auth::user()->id;
        Mission::create([
            'reference' => $ref,
            'tr' => $data['trMs'],
            'destination' => $data['destMs'],
            'objectif' => $data['objectifMs'],
            'debut' => $data['dateDMs'],
            'fin' => $data['dateFMs'],
            'dure' => $data['dureMs'],
            'moyen' => $data['moyenMs'],
            'type' => $data['typeMs'],
            'itinéraire' => $data['itMs'],
            'signature' => Auth::user()->id,

        ]);

        $ms = Mission::firstWhere('reference', $ref )->id;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['agMs']); $count++)
         {
            $ref1 = 'AGMS-'.$ref.$count;
            AgentMission::create([
                'reference' => $ref1,
                'ms' => $ms,
                'agent' => $data['agMs'][$count],
            ]);
         }

        DB::commit();

        return true;

    }


    public function ctr(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        $ref = 'CTR-'.$this->dat.'-FP'.rand(100,999).$data['agent'].Auth::user()->id;
        Contrat::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['prots'],
            'type' => $data['type'],
            'salaire' => $data['salaire'],
            'debut' => $data['debut'],
            'fin' => $data['fin'],
            'description' => $data['description'],
            'signature' => Auth::user()->id,

        ]);

        $ctr = Contrat::firstWhere('reference', $ref )->id;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['projet']); $count++)
         {
            $ref1 = 'PRT-CTR-'.$ref.$count;
            PartContrat::create([
                'reference' => $ref1,
                'contrat' => $ctr,
                'projet' => $data['projet'][$count],
                'pourcentage' => $data['part'][$count],
                'debut' => $data['debut'],
                'fin' => $data['fin'],
                'signature' => Auth::user()->id,
            ]);
         }

        DB::commit();

        return true;

    }

    public function jp(Request $data)
    {
        DB::beginTransaction();
        $this->dat = date('Y-m-d');
        //DB::rollback();

        PayementAgent::firstWhere('id', $data['pymt'])->update([
            'statut' => true,
        ]);
        $month = PayementAgent::firstWhere('id', $data['pymt'])->month;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['agent']); $count++)
         {
            $ref = 'AG-PYMNT-'.$this->dat.'-FP'.rand(100,999).$data['agent'][$count].$data['pymt'].Auth::user()->id;
            $sa = StatutAgent::where('agent',$data['agent'][$count])->where('active',true)->get()[0]->id;
            $ne = StatutAgent::where('agent',$data['agent'][$count])->where('active',true)->get()[0]->enfant;
            $sb = Contrat::where('agent',$data['agent'][$count])->where('statut',true)->get()[0]->salaire;
            $contrat = Contrat::where('agent',$data['agent'][$count])->where('statut',true)->get()[0]->id;
            ListePaie::create([
                'reference' => $ref,
                'agent' => $data['agent'][$count],
                'sAgent' => $sa,
                'pymt' => $data['pymt'],
                'contrat' => $contrat,
                'month' => $month,
                'SB' => $sb,
                'jp' => $data['jour'][$count],
                'ne' => $ne,
                'signature' => Auth::user()->id,

            ]);
         }

        DB::commit();

        return true;

    }

}
