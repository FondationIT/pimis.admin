<?php

use Illuminate\Support\Str;

if(!function_exists('sortDaByStatus')){
    function sortDaByStatus($query,$current_status,$cols=[]){

        if ($current_status == 1) {
            $query->where('dem_aches.active', true)
                    ->where('dem_aches.niv1', true)
                    ->where('dem_aches.niv2', true)
                    ->where('dem_aches.niv3', true)
                    ->where('dem_aches.niv4', true);
        } elseif ($current_status == 2) {
            $query->where('dem_aches.active', false);
        } else{
            $query->where('dem_aches.active', true)
                    ->where('dem_aches.niv4', false);
        }

        if (!empty($cols)) {
            foreach ($cols as $column => $value) {
                $query->where($column, $value);
            }
        }

        $query->orderBy("dem_aches.id", "DESC");
        return $query;
    }
    
}