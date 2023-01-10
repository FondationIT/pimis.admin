<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function create(Request $data)
    {
        return Affectation::create([
            'agent' => $data['agent'],
            'projet' => $data['projet'],
            'poste' => $data['poste'],
            'lieu' => $data['lieu'],
            'description' => $data['description'],
        ]);
    }
}
