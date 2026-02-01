<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Models\Agent;
use App\Models\AgentCardDetail;
use App\Models\User;
use App\Models\Affectation;
use App\Models\AgentCardDailyScan;
use App\Models\Service;
use App\Models\Contrat;
use App\Models\ApiKey;


class AccessCardManagement extends Controller
{
    public function FetchAgent(Request $request)
    {
        $agents = Agent::select('id','matricule','firstname','lastname','middlename')->get();
        $services = Service::select('id','reference','name')->get();

        
        foreach ($agents as $agent) {
            $contrat = Contrat::select("debut","fin","type")->where('agent',$agent->id)->first();
            $position = Affectation::where('agent', $agent->id)->first()->poste ?? "Non affecte";
            $agent->debut = $contrat->debut ?? "Non defini";
            $agent->fin = $contrat->fin ?? "Non defini";
            $agent->position = $position;
            unset($agent->id);
            unset($agent->service);
        }

        foreach ($services as $service) {
            $agentsInService = Agent::where('service', $service->id)->pluck('matricule')->toArray();

            // Count and attach
            $service->agents_count = count($agentsInService);
            $service->agent_ids = $agentsInService;
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Agents fetched successfully',
            'service' => $services,
            'data' => $agents,
        ]);
    }
    
    public function FetchAgentImage(Request $request)
    {
        $isApiKey_provided = $request->get("api_key_provided");
        
        if(!$isApiKey_provided){
            return response()->json(['status' => 'success', 'message' => "Vous n'avez pas permission d'acceder a ce contenu "], 400);
        }
        
        $directory = public_path('storage/img/employee_images');
        $files = File::files($directory);
        
        $images = [];
        
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $extension = $file->getExtension();
            $matricule = pathinfo($filename, PATHINFO_FILENAME);
        
            $images[] = [
                'id' => $matricule,
                'extension' => $extension,
                'path' => asset('storage/img/employee_images/' . $filename),
            ];
        }
        
        return response()->json(['status' => 'success', 'message' => 'Le images des agent', 'data' => $images], 200);
    }

    public function CardVerification(Request $request, $id)
    {
        // $id = Hashids::decode($hash)[0] ?? null;
        // $apiKeyHeader = $request->api_key_provided;
        $isApiKey_provided = $request->get("api_key_provided");
        $profilePath = '';
        $extensions = ['jpg', 'jpeg', 'png'];
        $apiKey = null;
        
        if (!$id) {
            if (!$isApiKey_provided) {
                return redirect()->away('https://panzifoundation.org/');
            }else{
                return response()->json(['status' => 'error', 'message' => 'Le numéro de carte est requis'], 400);
            }
        }
        

        // 🧠 If no auth and key is not the admin system key → treat as external
        
        $card_user = Agent::where('matricule',$id)->first();
        
        if (!$card_user) {
            if (!$isApiKey_provided) {
                return redirect()->away('https://panzifoundation.org/');
            }else{
                return response()->json(['status' => 'error', 'message' => 'Utilisateur non trouvé'], 404);
            }
        }
        $dt=[];

        
        foreach ($extensions as $ext) {
            $path = public_path("storage/img/employee_images/{$card_user->matricule}.{$ext}");
            
            $dt[] = [
                'extension' => $ext,
                'path' => $path,
                'exists' => File::exists($path),
            ];
        
            if (File::exists($path)) {
                $profilePath = asset("storage/img/employee_images/{$card_user->matricule}.{$ext}");
                break;
            }
        }
        
        $card_user->profile = $profilePath;

        if (!$isApiKey_provided) {
            $affectation = Affectation::where('agent', $card_user->id)->first()->poste ?? "Non affecté";
            $service = Service::where('id', $card_user->service)->first()->name ?? "Non affecté";
            
            $public_data = (object)[
                'firstname' => $card_user->firstname ?? "",
                'lastname' => $card_user->lastname ?? "",
                'middlename' => $card_user->middlename ?? "",
                'profile' => $card_user->profile ?? "",
                'service' => $service ?? "",
                'phone' => $card_user->phone ?? "",
                'email' => $card_user->email ?? "",
                'adress' => $card_user->adress ?? "",
                'country' => $card_user->country ?? "",
                'region' => $card_user->region ?? "",
                'position' => $affectation,
                'description' => $card_user->description ?? "",
                'created_at' => $card_user->created_at ?? "",
            ];
            return view('public/users_business_cards', ['user' => $public_data]);
            // return redirect()->route('business_card.show', ['id' => $hashedId])->with('data',$card_user);
            // return response()->json(['status' => 'success', 'message' => 'Redirect to ID Value:'.$hashedId], 200);
        }
        
        logger()->info('QR Verification: '.$id);


        return response()->json([
            'status' => 'success',
            'message' => 'Card is valid',
            'DT'=>$dt,
            'data' => $card_user
        ]);
    }

    public function SystemBarCardVerification(Request $request, $id)
    {
        if(strlen($id)<18){
            return response()->json([
                'status' => 'error',
                'message' => 'Le code saisi est invalide. Merci de vérifier et de réessayer.',
            ], 404);
        }
        try {
            $card_user = AgentCardDetail::where('barcode',$id)->first();
            if ($card_user) {
                $authUser = Auth::user()->agent;
                $agentInstance = Agent::where('matricule',$card_user->qr)->first();
                if(!$agentInstance){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User with such code not found',
                    ], 404);
                }
                if($authUser != $agentInstance->id){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Nous vous remercions, '.strtoupper($agentInstance->firstname).', pour le scan de votre carte. Toutefois, seules les cartes des utilisateurs dûment authentifiés sont autorisées à continuer.',
                    ], 404);
                }
                $cardScannedToday = AgentCardDailyScan::where('card', $card_user->id)
                ->whereDate('created_at', now())
                ->exists();
                if(!$cardScannedToday){
                    AgentCardDailyScan::create([
                        'card' => $card_user->id,
                        'scan_type' => 'barcode'
                    ]);
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nous vous souhaitons une belle journée de travail, restez bénis.',
                ]);
            }

            // Optional: handle the "not found" case
            return response()->json([
                'status' => 'error',
                'message' => 'Carte introuvable.',
            ], 404);
        } catch (\Throwable $th) {
            logger('Card Error: For user('.$id.')',[$th]);
            return response()->json([
                'status' => 'error',
                'message' => 'System Error!'
            ]);
        }
    }
    public function SystemCardVerification(Request $request, $id)
    {
        try {
            $agentInstance = Agent::where('matricule',$id)->first();
            if($agentInstance){

                $card_user = AgentCardDetail::where('qr',$id)->first();

                $authUser = Auth::user()->agent;
                if(!$agentInstance){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'User with such code not found',
                    ], 404);
                }
                if($authUser != $agentInstance->id){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Nous vous remercions, '.$agentInstance->firstname.', pour le scan de votre carte. Toutefois, seules les cartes des utilisateurs dûment authentifiés sont autorisées à continuer.',
                    ], 404);
                }

                AgentCardDailyScan::create([
                    'card' => $card_user->id,
                    'scan_type' => 'qrcode'
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Nous vous souhaitons une belle journée de travail, restez bénis.',
                ]);
            }
        } catch (\Throwable $th) {
            logger('Card Error: For user('.$id.')',[$th]);
            return response()->json([
                'status' => 'error',
                'message' => 'System Error!'
            ]);
        }
        
    }

}