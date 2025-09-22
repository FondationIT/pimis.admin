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
        return view('home');
    }

    public function users(Request $data)
    {
        DB::beginTransaction();
        //DB::rollback();

        //$data = json_decode($data->getBody());
        $ref = 'ND-'.rand(10000,99999).'-FP'.rand(100,999);
        

        DB::commit();

        return true;

    }

}
