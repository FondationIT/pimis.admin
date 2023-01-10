<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Bailleur;
use App\Models\Projet;
use App\Models\Product;
use App\Models\ProductOder;
use App\Models\Affectation;
use App\Models\EtBes;
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
        $users = User::where('active', '0')->get();
        $agents = Agent::where('active', '0')->get();
        $bailleurs = Bailleur::where('active', '0')->get();
        $projets = Projet::where('active', '1')->get();
        $products = Product::where('active', '1')->get();
        $productOders = ProductOder::where('active', '0')->get();
        $affectations = Affectation::where('active', '0')->get();
        $etBes = EtBes::where('active', '0')->get();
        $categories = Categorie::where('active', '0')->get();
        return view('home',compact('agents','users', 'bailleurs', 'projets', 'products', 'affectations', 'etBes', 'productOders', 'categories'));
    }
}
