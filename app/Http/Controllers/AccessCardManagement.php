<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use App\Models\Agent;
use App\Models\User;
use App\Models\Affectation;
use App\Models\Service;
use App\Models\Contrat;

use Illuminate\Support\Facades\Storage;


class AccessCardManagement extends Controller
{
    public function FetchAgent(Request $request)
    {
        $extensions = ['jpg', 'jpeg', 'png', 'webp'];
        $profilePath = null;

        foreach ($extensions as $ext) {
            $path = "public/img/t3.jpg";
            $img = Storage::exists($path);
            if ($img) {
                $profilePath = asset('storage/app/public/img/t3.jpg');
                break;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profile picture fetched successfully',
            'data' => $profilePath,
        ]);
        // $agents = Agent::select('id','matricule','firstname','lastname','middlename')->get();
        // $services = Service::select('id','reference','name')->get();

        
        // foreach ($agents as $agent) {
        //     $contrat = Contrat::select("debut","fin","type")->where('agent',$agent->id)->first();
        //     $position = Affectation::where('agent', $agent->id)->first()->poste ?? "Non affecte";
        //     $agent->debut = $contrat->debut ?? "Non defini";
        //     $agent->fin = $contrat->fin ?? "Non defini";
        //     $agent->position = $position;
        //     unset($agent->id);
        //     unset($agent->service);
        // }

        // foreach ($services as $service) {
        //     $agentsInService = Agent::where('service', $service->id)->pluck('matricule')->toArray();

        //     // Count and attach
        //     $service->agents_count = count($agentsInService);
        //     $service->agent_ids = $agentsInService;
        // }
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Agents fetched successfully',
        //     'service' => $services,
        //     'data' => $agents,
        // ]);
    }

    public function CardVerification(Request $request, $id)
    {
        // $id = Hashids::decode($hash)[0] ?? null;
        if (!$id) {
            return response()->json(['status' => 'error', 'message' => 'Le numéro de carte est requis'], 400);
        }


        $apiKey = $request->attributes->get('apiKey', null);
        $isApiKey_provided = $request->attributes->get('api_key_valid');
        // $isInternal = \Auth::check();

        // 🧠 If no auth and key is not the admin system key → treat as external
        // $hashedId = Hash::make($id);
        // $card_user = Agent::where('matricule',$id)->first() ?? User::where('reference',$id)->first();
        $card_user = Agent::where('matricule',$id)->first();

        if (!$card_user) {
            return response()->json(['status' => 'error', 'message' => 'Utilisateur non trouvé'], 404);
        }

        if (!$isApiKey_provided || !$apiKey || $apiKey->name !== 'Admin System') {
            
            $affectation = Affectation::where('agent', $card_user->id)->first()->poste ?? "Non affecté";
            $service = Service::where('id', $card_user->service)->first()->name ?? "Non affecté";
            
            $public_data = (object)[
                'firstname' => $card_user->firstname ?? "",
                'lastname' => $card_user->lastname ?? "",
                'middlename' => $card_user->middlename ?? "",
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




        return response()->json([
            'status' => 'success',
            'message' => 'Card is valid',
            'data' => $card_user
        ]);
    }

    public function BusinessCardDisplay(Request $request, $id)
    {
        if (!$id) {
            return redirect()->back()->with('error', "L'identifiant de l'utilisateur est requis");
        }

        // $card_user = Agent::find($id)

        // // Retrieve user data from cache
        // $card_user = Cache::get("business_card_".$id);
        // if (!$card_user) {
        //     return redirect()->back()->with('error', 'Utilisateur non trouvé');
        // }

        // // $checkedId = Hash::check($req->password, $id)

        // // $card_user = Agent::find($id) ?? User::find($id);

        // // if (!$card_user) {
        //     return redirect()->back()->with('error', 'Utilisateur non trouvé: '.$card_user);
        // // }
        // $card_user = $request->session()->get('data');

        return view('public/users_business_cards', ['user' => $card_user]);
    }

    public function scanIndex(Request $request)
    {
        return view('livewire/auth/badge-scan');
    }

    public function storeScanResult(Request $request)
    {
        $request->validate([
            'type' => 'required|string', // 'qr' or 'barcode'
            'code' => 'required|string',
        ]);

        $type = $request->input('type');
        $code = $request->input('code');

        // Example: Save to database or process
        // For demo, we'll save to storage/log or return JSON
        // You can replace this with a model save:
        // \App\Models\Scan::create([...]);

        // Simple log
        \Log::info("Scanned {$type}: {$code}");

        return response()->json([
            'status' => 'ok',
            'message' => 'Scanned value received',
            'data' => ['type' => $type, 'code' => $code],
        ]);
    }

    // Fallback: handle uploaded image (if user wants server-side decode)
    public function uploadQrImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $file = $request->file('image');
        $path = $file->store('uploads', 'public');

        // For demo just return saved path. To decode server-side, see notes below.
        return response()->json([
            'status' => 'ok',
            'message' => 'Image uploaded',
            'path' => Storage::url($path),
        ]);
    }
}
