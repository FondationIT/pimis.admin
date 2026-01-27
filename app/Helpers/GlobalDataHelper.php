<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\DefaultMsg;

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
            return array_unique($administrators->pluck('agent')->map(fn($item) => (string) $item)->toArray());
        }
    }
}

if(!function_exists('getSeniorAccountentUsers')){
    function getSeniorAccountentUsers($getInstance = false){
        $administrators = User::whereIn('role', ['COMPT1'])->where('active', true)->get();
        if($getInstance){
            return $administrators;
        }else{
            return array_unique($administrators->pluck('agent')->map(fn($item) => (string) $item)->toArray());
        }
    }
}

if(!function_exists('getJuniorAccountentUsers')){
    function getJuniorAccountentUsers($getInstance = false){
        $administrators = User::whereIn('role', ['COMPT2'])->where('active', true)->get();
        if($getInstance){
            return $administrators;
        }else{
            return array_unique($administrators->pluck('agent')->map(fn($item) => (string) $item)->toArray());
        }
    }
}

if(!function_exists('getDefaultNotificationMessage')){
    function getDefaultNotificationMessage($type = 'general'){
        $type = trim(strtolower($type));
        $notificationMsg = DefaultMsg::where('type', $type)->first();
        return $notificationMsg->id;
    }
}