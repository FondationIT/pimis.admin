<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function create(Request $data)
    {
        return Projet::create([
            'name' => $data['name'],
            'dateD' => $data['dateD'],
            'dateF' => $data['dateF'],
            'contex' => $data['contexte'],
            'bailleur' => $data['bailleur'],
            'domaine' => $data['domaine'],
        ]);
    }
}
