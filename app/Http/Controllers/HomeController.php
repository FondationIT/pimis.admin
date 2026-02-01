<?php

namespace App\Http\Controllers;

use App\Models\AgentCardDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordUpdate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        header("cache-Control:no-store,no-cache, must-revalidate");
        header("cache-Control:post-check=0,pre-check=0",false);
        header("Pragma:no-cache");

        PasswordUpdate::where('last_updated_at', '<=', Carbon::now()->subMonths(3))
        ->update(['is_active' => false]);

        function importAgentCardDetailsFromCSV($filePath)
        {
            // Open the CSV file
            if (!file_exists($filePath) || !is_readable($filePath)) {
                logger('Error CSV:',['file not found']);
            }else{

                $header = null;
                $dataToInsert = [];
    
                if (($handle = fopen($filePath, 'r')) !== false) {
                    while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                        // Get header row
                        if (!$header) {
                            $header = $row;
                            continue;
                        }
    
                        $rowData = array_combine($header, $row);
    
                        // Map CSV columns to DB
                        // {"number":"FP-414-886-905-770","agent":"FP-M9138M","created":"23-10-2025","expiry":"Fin contrat"
                        $qrcodeData = $rowData['agent'] ?? null;
                        $userExists = AgentCardDetail::where('qr',$qrcodeData)->exists();
                        if(!$userExists){
                            $dataToInsert[] = [
                                'barcode'       => $rowData['number'] ?? null,
                                'qr'            =>  $qrcodeData,
                                'printed_on'    => isset($rowData['created']) 
                                                    ? Carbon::createFromFormat('d-m-Y', $rowData['created'])->format('Y-m-d H:i:s') 
                                                    : now(),
                                'expiry_on'     => $rowData['expiry'] ?? 'Fin Contract',
                                'last_scanned'  => now(),
                                'status'        => 'active',
                                'created_at'    => now(),
                                'updated_at'    => now(),
                            ];
                        }
                    }
                    fclose($handle);
                }
    
                // Insert in chunks for large files
                if(!empty($dataToInsert)){
                    foreach ($dataToInsert as $chunk) {
                        AgentCardDetail::create($chunk);
                    }
                    logger('CSV Data',['Successfully added']);
                    return count($dataToInsert) . " rows inserted successfully.";
                }
                logger('CSV Data',['Nothin to insert']);
                return "Nothing to insert";
            }

        }

        try {
            importAgentCardDetailsFromCSV('C:\Users\bzihi\Projects\panzi_access_management_system\membership_card\agetnsBarcode.csv');
        } catch (\Throwable $th) {
            //throw $th;
            logger('CSV Import Error',[$th]);
        }
        // importAgentCardDetailsFromCSV(storage_path('app/agent_cards.csv'));

        return view('home');
    }

    public function tdrOtherAgents(Request $request)
    {
        // Logic to fetch other TDR agents
        $otherAgents = [
            ['id' => 1, 'name' => 'Agent One'],
            ['id' => 2, 'name' => 'Agent Two'],
            // Add more agents as needed
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'TDR Other Agents fetched successfully',
            'service' => [],
            'data' => $otherAgents,
        ]);
    }

    public function tdrNewAgents(Request $request)
    {
        // Logic to fetch other TDR agents
        $otherAgents = [
            ['id' => 1, 'name' => 'Agent One'],
            ['id' => 2, 'name' => 'Agent Two'],
            // Add more agents as needed
        ];

        return response()->json([
            'status' => 'success',
            'data' => $otherAgents,
        ]);
    }

    public function users(Request $data)
    {
        // DB::beginTransaction();
        // //DB::rollback();

        // //$data = json_decode($data->getBody());
        // $ref = 'ND-'.rand(10000,99999).'-FP'.rand(100,999);
        

        // DB::commit();

        return true;

    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user = auth()->user();

        // Check if the new password is the same as the current password
        if (Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Le nouveau mot de passe ne peut pas être identique à l\'ancien.',
            ], 422);
        }

        // Update password
        try {
            User::where('id', $user->id)->update([
                'password' => Hash::make($request->input('password'))
            ]);

            PasswordUpdate::where('user', $user->id)->update([
                'last_updated_at' => Carbon::now(),
                'is_active' => true,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully.',
            ]);
        
        } catch (\Throwable $th) {
            logger()->error('Error updating password for user ID '.$user->id.': '.$th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the password.',
            ], 500);
        }
        
    }

}
