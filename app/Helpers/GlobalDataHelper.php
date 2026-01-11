<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

if(!function_exists('getRoles')){
    function getRoles($specificRole = null){
        if($specificRole){
            return Role::where('title', $specificRole)->first();
        }else{
            return Role::all();
        }
    }
}

if(!function_exists('getUserRole')){
    function getUserRole(){
        $fetchedRoles =getRoles(Auth::user()->role);
        $roleLabel = $fetchedRoles->full_title ?? 'UNKNOWN';
        return $roleLabel;
    }
}

if(!function_exists('getAdministratorUsers')){
    function getAdministratorUsers($getInstance = false){
        $administrators = User::whereIn('role', ['D.O','D.A.F','D.P'])->where('active', true)->get();
        if($getInstance){
            return $administrators;
        }else{
            return array_unique($administrators->pluck('agent')->toArray());
        }
    }
}