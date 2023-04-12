<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agent;
use App\Models\Bailleur;
use App\Models\Projet;
use App\Models\Product;
use App\Models\ProductOder;
use App\Models\Affectation;
use App\Models\Et_bes;
use App\Models\Categorie;

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

}
