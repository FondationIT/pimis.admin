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

        $users = User::where('active', '1')->get();
        $agents = Agent::where('active', '1')->get();
        $bailleurs = Bailleur::where('active', '1')->get();
        $projets = Projet::where('active', '1')->get();
        $products = Product::where('active', '1')->get();
        $productOders = ProductOder::where('active', '1')->get();
        $affectations = Affectation::where('active', '1')->get();
        $affectation = Affectation::where('agent', Auth::user()->agent)->get();


        $etBes = Et_bes::where('active', '1')->get();
        $etBesF = Et_bes::where('projet','2')->get();
        $etBe = Et_bes::where('agent', Auth::user()->id)->get();
        $categories = Categorie::where('active', '1')->get();
        return view('home',compact('agents','users', 'bailleurs', 'projets', 'products', 'affectations','affectation', 'etBes', 'etBe', 'etBesF', 'productOders', 'categories'));
    }

    public function select()
    {

        $users = User::where('active', '1')->get();
        $agents = Agent::where('active', '1')->get();
        $bailleurs = Bailleur::where('active', '1')->get();
        $projets = Projet::where('active', '1')->get();
        $products = Product::where('active', '1')->get();
        $productOders = ProductOder::where('active', '1')->get();
        $affectations = Affectation::where('active', '1')->get();
        $affectation = Affectation::where('agent', Auth::user()->agent)->get();


        $etBes = Et_bes::where('active', '1')->get();
        $etBesF = Et_bes::where('projet','2')->get();
        $etBe = Et_bes::where('agent', Auth::user()->id)->get();
        $categories = Categorie::where('active', '1')->get();

        return '{
            "users":'.$users.',
            "agents":'.json_encode($agents).'
        }';
        //return view('home',compact('agents','users', 'bailleurs', 'projets', 'products', 'affectations','affectation', 'etBes', 'etBe', 'etBesF', 'productOders', 'categories'));
    }
}
