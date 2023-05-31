<?php

namespace App\Http\Controllers;

use App\Models\Br;
use App\Models\BrOder;
use App\Models\Et_bes;
use App\Models\ProductOder;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\prixPv;
use App\Models\signaturePv;
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

    public function proforma(Request $data)
    {
        DB::beginTransaction();
        //DB::rollback();

        //$data = json_decode($data->getBody());
        for($count = 0; $count<count($data['fournisseur']); $count++)
         {
            $ref = 'PROF-'.rand(10000,99999).'-FP'.rand(100,999);
            Proforma::create([
                'reference' => $ref,
                'da' => $data['da'],
                'signature' => Auth::user()->id,
                'fournisseur' => $data['fournisseur'][$count],
                'numero' => $data['reference'][$count],
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
            'fournisseur' => $data['fournPv'],
            'dateC' => $data['datePv'],
            'observation' => $data['obsPv'],
            'justification' => $data['justPv'],
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
                'signature' => Auth::user()->id,
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
                'signature' => Auth::user()->id,
                'produit' => $data['prod'][$count],
                'quantite' => $data['qte'][$count],
                'observation' => $data['observation'][$count],
            ]);
         }

        DB::commit();

        return true;

    }
}
