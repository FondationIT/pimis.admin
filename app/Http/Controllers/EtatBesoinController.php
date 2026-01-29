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
use App\Models\PrixPv;
use App\Models\PvAttr;
use App\Models\PvCommissionersConcents;
use App\Models\PvAttrCommissionersConcents;
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
use App\Services\NotificationService;

use Illuminate\Validation\ValidationException;

class EtatBesoinController extends Controller
{
    protected NotificationService $notificationService;
    public $dat;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function create(Request $data)
    {
        try {
            DB::beginTransaction();

            $date = now()->format('Y-m-d');

            $ref = 'EB-' . $date . '-FP' . rand(100, 999) . $data->projet . Auth::id();

            $etBes = Et_bes::create([
                'reference' => $ref,
                'agent'     => Auth::id(),
                'projet'    => $data->projet,
                'categorie' => $data->categorie,
                'comment'   => $data->comment,
            ]);

            foreach ($data->product as $index => $product) {
                $ref1 = 'CMD-' . $ref . $index;

                ProductOder::create([
                    'reference'   => $ref1,
                    'product'     => $product,
                    'etatBes'     => $etBes->id,
                    'quantite'    => $data->quantite[$index] ?? null,
                    'description' => $data->description[$index] ?? null,
                ]);
            }

            // Send notification once (using main reference)
            $Jaccountent = getJuniorAccountentUsers();
            foreach ($Jaccountent as $jAccount) {
                $this->notificationService->sendNotification([
                    'agent'        => $jAccount,
                    'msg_id'       => getDefaultNotificationMessage('attention'),
                    'task'         => $ref,
                    'is_delegated' => false,
                    'delegated_by' => null,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'ref'     => $ref,
            ], 201);

        } catch (\Throwable $e) {

            DB::rollBack();

            // Log full error for developers
            Log::error('EB creation failed', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            // Return safe error to frontend
            return response()->json([
                'success' => false,
                'message' => 'Échec de l’enregistrement.',
                'debug'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
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

    public function pv(Request $data){
        $prixPv = collect($data['prixPv'])->map(fn ($prix) => empty($prix) ? 0 : (float) $prix);
            
        if ($prixPv->every(fn ($prix) => $prix == 0)) {
            throw ValidationException::withMessages([
                'prixPv' => 'Tous les prix saisis sont nuls ou égaux à zéro. Cette saisie est interdite. Veuillez vérifier vos entrées.'
            ]);
        }


        if ($data['typePv'] == 1){

            DB::beginTransaction();
            $this->dat = date('Y-m-d');
            //DB::rollback();

            $ref = 'PV-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
            Pv::create([
                'reference' => $ref,
                'da' => $data['daPv'],
                'type' =>$data['typePv'],
                'titre' => $data['titrePv'],
                'dateC' => $this->dat,
                'observation' => '-',
                'signature' => Auth::user()->id,

            ]);
            $pv = Pv::firstWhere('reference', $ref )->id;
            for($count = 0; $count<count($data['prixPv']); $count++)
            {
                $refp = 'PRPV-'.$ref.$count;
                PrixPv::create([
                    'reference' => $refp,
                    'pv' => $pv,
                    'signature' => Auth::user()->id,
                    'produit' => $data['prodPv'][$count],
                    'proforma' => $data['profPv'][$count],
                    'prix' => $data['prixPv'][$count],
                ]);
            }

            $ref1 = 'PV-ATTR-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
            PvAttr::create([
                'reference' => $ref1,
                'da' => $data['daPv'],
                'type' =>$data['typePv'],
                'titre' => $data['titrePv'],
                'justification' => '-',
                'observation' => '-',
                'signature' => Auth::user()->id,

            ]);
            $pv1 = PvAttr::firstWhere('reference', $ref1 )->id;
            
            for($count = 0; $count<count($data['prodPv']); $count++)
            {
                $ref2 = 'PRPV-ATTR-'.$ref1.$count;
                SelectPv::create([
                    'reference' => $ref2,
                    'pv' => $pv1,
                    'signature' => Auth::user()->id,
                    'produit' => $data['prodPv'][$count],
                    'proforma' => $data['profPv'][$count],
                ]);
            }

            DB::commit();

            return true;

        }else{
            if ( !$data['agPv'] || !is_array($data['agPv']) || count($data['agPv'] ) < 3) {
                throw ValidationException::withMessages([
                    'agPv' => 'Au moins 3 membres de la commission doivent être sélectionnés.'
                ]);
            }
            
            DB::beginTransaction();
            $this->dat = date('Y-m-d');
            //DB::rollback();

            $ref = 'PV-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
            $newPVInstance = Pv::create([
                'reference' => $ref,
                'da' => $data['daPv'],
                'type' =>$data['typePv'],
                'titre' => $data['titrePv'],
                'dateC' => $data['datePv'],
                'observation' => $data['obsPv'],
                'signature' => Auth::user()->id,

            ]);

            $pvinstance = Pv::where('reference', $ref );
            $pv = $pvinstance->first()->id;
            
            //$data = json_decode($data->getBody());
            foreach ($data['agPv'] as $index => $agent)
            {
                $cmaRef = 'CMA-'.$this->dat.'-FP'.$index.rand(100,999).'-'.$pv.Auth::user()->id;
                $pvCom = PvCommissionersConcents::create([
                    'reference' => $cmaRef,
                    'pv' => $pv,
                    'agent' => $agent,
                ]);

                if($pvCom){
                    $this->notificationService->sendNotification([
                        'agent'        => $agent,
                        'msg_id'       => 3,
                        'task'         => $cmaRef,
                        'is_delegated' => false,
                        'delegated_by' => null,
                    ]);
                }
            }
            $pvinstance->update([
                'commission_count' => count($data['agPv']),
            ]);
            // for($count = 0; $count<count($data['agPv']); $count++)
            // {
                

            //     // $ref1 = 'AGPV-'.$ref.$count;
            //     // signaturePv::create([
            //     //     'reference' => $ref1,
            //     //     'pv' => $pv,
            //     //     'agent' => $data['agPv'][$count],
            //     // ]);

            // }

            try {
                for($count = 0; $count<count($data['prixPv']); $count++)
                {
                    $ref2 = 'PRPV-'.$ref.$count;
                    PrixPv::create([
                        'reference' => $ref2,
                        'pv' => $pv,
                        'signature' => Auth::user()->id,
                        'produit' => $data['prodPv'][$count],
                        'proforma' => $data['profPv'][$count],
                        'prix' => $data['prixPv'][$count],
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }

            DB::commit();
        }

        return true;

    }


    public function pvAttr(Request $data)
    {
        $this->dat = date('Y-m-d');
        $ref = 'PV-ATTR-'.$this->dat.'-FP'.rand(100,999).$data['daPv'].Auth::user()->id;
        DB::beginTransaction();
        
            PvAttr::create([
                'reference' => $ref,
                'da' => $data['daPv'],
                'type' =>$data['typePv'],
                'titre' => $data['titrePv'],
                'justification' => $data['justPv'],
                'observation' => $data['obsPv'],
                'signature' => Auth::user()->id,

            ]);

        DB::commit();

        DB::afterCommit(function() use ($ref){
            $pvInstance = PvAttr::where('reference', $ref );

            if(!$pvInstance->exists()){
                Log::error("PV Attribution initiation failed: PV with reference ".$ref." not found.");
                return;
            }
            $pv = $pvInstance->first();
            $commissioners = getAdministratorUsers(); // getAdministratorUsers() returns ['774','535','445'] list of agents
            foreach ($commissioners as $adminU)
            {
                $pvAttrCom = PvAttrCommissionersConcents::create([
                    'pv_attr' => $pv->id,
                    'agent' => $adminU,
                ]);

                if($pvAttrCom){
                    $this->notificationService->sendNotification([
                        'agent'        => $adminU,
                        'msg_id'       => 3,
                        'task'         => $ref,
                        'is_delegated' => false,
                        'delegated_by' => null,
                    ]);
                }else{
                    $pvInstance->delete();
                    Log::error("PV Attribution commissioner insert failed for agent ID: ".$adminU." and PV Attr ID: ".$pv->id);
                }
            }
            $insertedInstances = PvAttrCommissionersConcents::where('pv_attr', $pv->id)->count();
            if($insertedInstances === 0){
                Log::error("PV Attribution initiation failed: No commissioners were inserted for PV Attr ID: ".$pv->id);
                return;
            }else{
                // $pvInstance->update([
                //     'commission_count' => $insertedInstances,
                // ]);
                Log::info("PV Attribution initiated for PV Attr ID: ".$pv->id);
                
            }

        //     $rows = collect($commissioners)->map(function($agentId) use ($pv) {
        //         return [
        //             'agent' => $agentId,
        //             'pv_attr' => $pv->id
        //         ];
        //     })->toArray();
        //     if($pv){
        //         PvAttrCommissionersConcents::upsert(
        //             $rows,
        //             ['agent', 'pv_attr'], // unique key columns
        //             ['updated_at']         // columns to update if exists
        //         );
        //         logger("PV Attribution initiated for PV ID: ".$pv->id);
        //     }
        });





        // $pv = PvAttr::firstWhere('reference', $ref );

        //$data = json_decode($data->getBody());
        // for($count = 0; $count<count($data['agPv']); $count++)
        // {
        // $ref1 = 'AGPV-ATTR-'.$ref.$count;
        // SignaturePVAttr::create([
        //     'reference' => $ref1,
        //     'pv' => $pv,
        //     'agent' => $data['agPv'][$count],
        // ]);
        // }
        // $administationUsers = getAdministratorUsers();
        // foreach ($administationUsers as $index => $adminU)
        // {
        //     $pvAttrCom = PvAttrCommissionersConcents::create([
        //         'pv_attr' => $pv,
        //         'agent' => $adminU,
        //     ]);

        //     if($pvAttrCom){
        //         $this->notificationService->sendNotification([
        //             'agent'        => $adminU,
        //             'msg_id'       => 3,
        //             'task'         => $ref,
        //             'is_delegated' => false,
        //             'delegated_by' => null,
        //         ]);
        //     }
        // }


        //  for($count = 0; $count<count($data['prodPv']); $count++)
        //  {
        //     $ref2 = 'PRPV-ATTR-'.$ref.$count;
        //     SelectPv::create([
        //         'reference' => $ref2,
        //         'pv' => $pv->id,
        //         'signature' => Auth::user()->id,
        //         'produit' => $data['prodPv'][$count],
        //         'proforma' => $data['fournPv'][$count],
        //     ]);
        //  }

        // DB::commit();

        // DB::afterCommit(function() use ($pv){
        //     $commissioners = getAdministratorUsers(); // getAdministratorUsers() returns ['774','535','445'] list of agents
        //     $rows = collect($commissioners)->map(function($agentId) use ($pv) {
        //         return [
        //             'agent' => $agentId,
        //             'pv_attr' => $pv->id
        //         ];
        //     })->toArray();
        //     if($pv){
        //         PvAttrCommissionersConcents::upsert(
        //             $rows,
        //             ['agent', 'pv_attr'], // unique key columns
        //             ['updated_at']         // columns to update if exists
        //         );
        //         logger("PV Attribution initiated for PV ID: ".$pv->id);
        //     }
        // });

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


    // public function tr(Request $data)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $this->dat = date('Y-m-d');
    //     //DB::rollback();
    //         $details = $data['details'];
    
    //         //$data = json_decode($data->getBody());
    //         $ref = 'TR-'.$this->dat.'-FP'.rand(100,999).$data['projet'].Auth::user()->id;
            
    //         Tr::create([
    //             'reference' => $ref,
    //             'agent' => $data['agent'],
    //             'projet' => $data['projet'],
    //             'type' => $data['type'],
    //             'titre' => $data['titre'],
    //         ]);
    //         $tr = Tr::firstWhere('reference', $ref )->id;
    //         for($count = 0; $count<count($data['product']); $count++){
    //             $orderRef1 = 'TR-ODR-'.$ref.$count;
    //             TrOder::create([
    //                 'reference' => $orderRef1,
    //                 'libelle' => $data['product'][$count],
    //                 'tr' => $tr,
    //                 'unite' => $data['unite'][$count],
    //                 'prix' => $data['prix'][$count],
    //                 'quantite' => $data['quantite'][$count],
    //                 'frequence' => $data['frequence'][$count],
    //         ]);
    
    //         }

    //         $equipeData = array_filter(array_map('trim', explode(';', $details['equipe'])));

    //         // Insert equipe
    //         foreach ($equipeData as $user) {
    //             try {
    //                 TrEquipe::create([
    //                     'tr' => $tr,
    //                     'agent' => $user
    //                 ]);
    //             } catch (\Throwable $th) {
    //                 Log::error("TrEquipe (".$user.") insert failed: ".$th->getMessage());
    //             }
    //         }

    //         // Insert activite
    //         foreach ($details['activites'] as $activite) {
    //             try {
    //                 TrActivite::create([
    //                     'tr' => $tr,
    //                     'date' => $activite['jour'],
    //                     'activite' => $activite['activite'],
    //                     'observation' => $activite['observation']
    //                 ]);
    //             } catch (\Throwable $th) {
    //                 Log::error("TrActivite (".$activite['jour'].") insert failed: ".$th->getMessage());
    //             }
    //         }
    //         try {
    //             TrDetail::create([
    //                 'tr'=>$tr,
    //                 'objectif'=>$details['objectif'],
    //                 'resultat'=>$details['resultat'],
    //                 'dure'=>$details['dure'],
    //             ]);
    //         } catch (\Throwable $th) {
    //             Log::error("TrDetail (".$tr.") insert failed: ".$th->getMessage());
    //         }
    
    //         DB::commit();
    //         return true;
    //     } catch (\Throwable $th) {
    //         DB::rollBack(); // don’t forget to rollback on error
    //         Log::error($th->getMessage());
    //         return response()->json([
    //             'status'  => 'error',
    //             'message' => $th->getMessage(),
    //             'file'    => $th->getFile(),
    //             'line'    => $th->getLine(),
    //             'trace'   => $th->getTraceAsString(),
    //         ], 500);
    //     }
        


    // }

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
