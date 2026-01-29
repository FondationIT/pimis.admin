<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

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

}
