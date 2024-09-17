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

}
