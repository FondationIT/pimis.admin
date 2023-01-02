<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;

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
        $users = User::where('active', '0')->get();
        $agents = Agent::where('active', '0')->get();
        return view('home',compact('agents','users'));
    }
}
