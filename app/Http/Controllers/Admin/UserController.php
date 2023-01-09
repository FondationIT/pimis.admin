<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Bailleur;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
            'phone' => ['required', 'string', 'max:255', 'unique:agents'],
            'lieuN' => ['required', 'string', 'max:255'],
            'dateN' => ['required', 'date', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'service' => ['required', 'string', 'max:255'],
            'etatcivil' => ['required', 'string', 'max:255'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $data)
    {
        return Agent::create([
            'firstname' => $data['name'],
            'lastname' => $data['name2'],
            'middlename' => $data['name3'],
            'matricule' => 'FP-44568',
            'gender' => $data['genre'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'lieu' => $data['lieuN'],
            'service' => $data['service'],
            'birthdate' => $data['dateN'],
            'adress' => $data['adresse'],
            'country' => $data['pays'],
            'region' => $data['region'],
            'description' => $data['description'],
            'etatcivil' => $data['etatcivil'],
        ]);
    }



}
