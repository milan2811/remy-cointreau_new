<?php

use App\Models\Analytics;

if(!function_exists('analytics')) {
    function analytics($request, $id, $type, $bar_id) {

        $last = Analytics::where('object_id', $id)
                // ->where('type', $type)
                // ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 Hour')))                    
                ->where("type", 'LIKE', $type == 'bar' ? "%$type%" : '%%')
                ->orderBy('id', 'desc')
                ->first();

        

        $analytics = Analytics::where('object_id', $id)
                    // ->where('type', $type)
                    // ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 Hour')))
                    ->where('ip_address', $request->ip())   
                    ->where("type", 'LIKE', $type == 'bar' ? "%$type%" : '%%')
                    ->orderBy('id', 'desc')
                    ->first();
        // dd($analytics);
        if($analytics && $analytics->created_at >= date('Y-m-d H:i:s', strtotime('-1 Hour'))) {
            $analytics->update([
                "count" => $analytics->count + 1,
                "total_count" => $last->total_count + 1,
            ]);
        } else {
            Analytics::create([
                "object_id" => $id,
                "count" => 1,
                "page_url" => url()->current(),
                "bar_id" => $bar_id,
                "ip_address" => $request->ip(),
                'device' => $request->userAgent(),            
                "type" => $type,
                "total_count" => $last ? $last->total_count + 1 : 1,
                "created_at" => date('Y-m-d H:00:00'),
            ]);
        } 
    }
}


if(!function_exists('getItemPriceRange')) {
    function getItemPriceRange($item) {
        $prices = json_decode($item->price);
        $min = 0;
        $max = 0;
        if(isset($prices->price) && count($prices->price)) {            
            foreach ($prices->price as $index=>$price) {
                if($prices->price[$index] < $min || $index == 0) {
                    $min = $prices->price[$index];                        
                } 
                if($prices->price[$index] > $max) {
                    $max = $prices->price[$index];
                }
            }
        }
        if($min == $max) {
            return "$ $min";
        }
        return "$ $min - $ $max";
    }
}

/// Get All Roles in Array
if(!function_exists('roles')) {
    function roles() {
        $roles = App\Models\Role::get();
        $res = [];
        foreach($roles as $role) {
            $res[$role->role_name] = $role->role;
        }
        return $res;
    }
}

if(!function_exists("remy_cointreau_brands")) {
    function remy_cointreau_brands() {
        return ['LOUIX XIII', 'Remy martin', 'The Botanist', 'Cointreau', 'Mount gay'];
    }
}