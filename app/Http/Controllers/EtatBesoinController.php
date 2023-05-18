<?php

namespace App\Http\Controllers;

use App\Models\Et_bes;
use App\Models\ProductOder;
use App\Models\Proforma;
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
}
