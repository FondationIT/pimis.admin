<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function create(Request $data)
    {
        $ref = 'PJ-'.substr($data['name'], 0, 1).''.rand(1000,9999);
        return Projet::create([
            'reference' => $ref,
            'name' => $data['name'],
            'dateD' => $data['dateD'],
            'dateF' => $data['dateF'],
            'contex' => $data['contexte'],
            'bailleur' => $data['bailleur'],
            'domaine' => $data['domaine'],
        ]);
    }
}
