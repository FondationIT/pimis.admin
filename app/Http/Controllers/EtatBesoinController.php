<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
use App\Models\TrEquipe;
use App\Models\TrActivite;
use App\Models\TrDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EtatBesoinController extends Controller
{

    public function create(Request $data)
    {
        DB::beginTransaction();
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'EB-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref = 'CMD-'.rand(10000,99999).''.$count;
            ProductOder::create([
                'reference' => $ref,
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
        //DB::rollback();

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['fournisseur']); $count++)
         {
            
            $ref = 'PROF-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        $ref = 'PV-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref1 = 'AGPV-'.rand(10000,99999).'-FP'.rand(100,999);
            signaturePv::create([
                'reference' => $ref1,
                'pv' => $pv,
                'agent' => $data['agPv'][$count],
            ]);
         }


         for($count = 0; $count<count($data['prixPv']); $count++)
         {
            $ref2 = 'PRPV-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        $ref = 'PV-ATTR-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref1 = 'AGPV-ATTR-'.rand(10000,99999).'-FP'.rand(100,999);
            SignaturePVAttr::create([
                'reference' => $ref1,
                'pv' => $pv,
                'agent' => $data['agPv'][$count],
            ]);
         }


         for($count = 0; $count<count($data['prodPv']); $count++)
         {
            $ref2 = 'PRPV-ATTR-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        $ref = 'BR-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref1 = 'ODR-BR-'.rand(10000,99999).'-FP'.rand(100,999);
            BrOder::create([
                'reference' => $ref1,
                'br' => $br,
                'bc' => $data['bc'],
                'produit' => $data['prod'][$count],
                'quantite' => $data['qte'][$count],
                'observation' => $data['observation'][$count],
            ]);

            if(Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])->exists()){

                $ref1 = 'ODR-BR-'.rand(10000,99999).'-FP'.rand(100,999);
                $qte = Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])->get()[0]->quantite;
                
                Stock::where('project', $data['projet'],)->where('product', $data['prod'][$count])
                ->update([
                    'quantite' => $data['qte'][$count] + $qte,
                ]);

            }else{
                $ref1 = 'ST-ART-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'DI-'.rand(10000,99999).'-FP'.rand(100,999);
        Di::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
        ]);
        $di = Di::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref = 'DI-ODR-'.$di.rand(10000,99999).''.$count;
            DiOder::create([
                'reference' => $ref,
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
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'ND-'.rand(10000,99999).'-FP'.rand(100,999);
        Nd::create([
            'reference' => $ref,
            'agent' => $data['agent'],
            'projet' => $data['projet'],
        ]);
        $nd = Nd::firstWhere('reference', $ref )->id;
        for($count = 0; $count<count($data['product']); $count++)
         {
            $ref = 'ND-ODR-'.$nd.rand(10000,99999).''.$count;
            NdOder::create([
                'reference' => $ref,
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
        try {
            DB::beginTransaction();
            //DB::rollback();
            $details = $data['details'];
    
            //$data = json_decode($data->getBody());
            $ref = 'TR-'.rand(10000,99999).'-FP'.rand(100,999);
            
            Tr::create([
                'reference' => $ref,
                'agent' => $data['agent'],
                'projet' => $data['projet'],
                'type' => $data['type'],
                'titre' => $data['titre'],
            ]);
            $tr = Tr::firstWhere('reference', $ref )->id;
            for($count = 0; $count<count($data['product']); $count++){
                $orderRef = 'TR-ODR-'.$tr.rand(10000,99999).''.$count;
                TrOder::create([
                    'reference' => $orderRef,
                    'libelle' => $data['product'][$count],
                    'tr' => $tr,
                    'unite' => $data['unite'][$count],
                    'prix' => $data['prix'][$count],
                    'quantite' => $data['quantite'][$count],
                ]);
    
            }

            $equipeData = array_filter(array_map('trim', explode(';', $details['equipe'])));
            $activiteData = array_filter(array_map('trim', explode(';', $details['activite'])));

            Log::error("TrEquipe insert data: ".json_encode($equipeData));
            Log::error("TrActivity insert data: ".json_encode($activiteData));

            // Insert equipe
            foreach ($equipeData as $user) {
                try {
                    TrEquipe::create([
                        'tr_ref' => $ref,
                        'user' => $user
                    ]);
                } catch (\Throwable $th) {
                    Log::error("TrEquipe insert failed: ".$th->getMessage());
                }
            }

            // Insert activite
            foreach ($activiteData as $activite) {
                try {
                    TrActivite::create([
                        'tr_ref' => $ref,
                        'activite' => $activite
                    ]);
                } catch (\Throwable $th) {
                    Log::error("TrActivite insert failed: ".$th->getMessage());
                }
            }

            TrDetail::create([
                'tr_ref'=>$ref,
                'objectif'=>$details['objectif'],
                'resultat'=>$details['resultat'] . ' ' . implode(' ', [$details['activite'], $details['equipe']]),
                'de'=>$details['debut'],
                'a'=>$details['fin']
            ]);
    
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack(); // don’t forget to rollback on error

            return response()->json([
                'status'  => 'error',
                'message' => $th->getMessage(),
                'file'    => $th->getFile(),
                'line'    => $th->getLine(),
                'trace'   => $th->getTraceAsString(),
            ], 500);
        }
        


    }



    // public function tr_details(Request $data)
    // {
    // }

    public function miss(Request $data)
    {
        DB::beginTransaction();
        //DB::rollback();

        $ref = 'MS-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref1 = 'AGMS-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        $ref = 'CTR-'.rand(10000,99999).'-FP'.rand(100,999);
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
            $ref1 = 'PRT-CTR-'.rand(10000,99999).'-FP'.rand(100,999);
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
        //DB::rollback();

        PayementAgent::firstWhere('id', $data['pymt'])->update([
            'statut' => true,
        ]);
        $month = PayementAgent::firstWhere('id', $data['pymt'])->month;

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['agent']); $count++)
         {
            $ref = 'AG-PYMNT-'.rand(10000,99999).'-FP'.rand(100,999);
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
